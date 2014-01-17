<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Modules extends Controller_Admin_Pages {
	public function modules_list()
	{
            $data = array();
            $module_model = ORM::factory('modules')->order_by('position')->find_all();
            foreach ($module_model as $key => $mod)
            {
                $data['sitename'] = URL::base(true);
                $data['ifdir'][$key] = (file_exists(DOCROOT.'application/classes/modules/'.$mod->dir.'/admin.php') && $mod->active);
                $data['onsite'][$key] = (file_exists(DOCROOT.'application/classes/modules/'.$mod->dir.'/index.php') && $mod->site);
            }
            
            $data['modules'] = $module_model;
            $this->display_tpl('modules/index', $data);
	}
        
	public function modules_install()
	{
            $data = array();
            $path_modules = DOCROOT.'/application/classes/modules/';
            if ($handle = opendir($path_modules)) {
                while (false !== ($file = readdir($handle))) { 
                    if ($file != "." && $file != "..") { 
                        $xml_file = $path_modules.$file.'/mod_info.xml';
                        if (file_exists($xml_file))
                        {
                            $modules_count = ORM::factory('modules')->where('dir', '=', $file)->count_all();
                            if ($modules_count > 0)
                                break;
                            $get_info = file_get_contents($xml_file);
                            $get_xml_info = new SimpleXMLElement($get_info);
                            $contacts = (array)$get_xml_info->contacts;

                            $module[] = array(
                                'dir' => $file,
                                'name' => $get_xml_info->name,
                                'description' => $get_xml_info->description,
                                'version' => $get_xml_info->version,
                                'author' => $get_xml_info->author,
                                'contacts' => (sizeof($contacts) > 0) ? $contacts : false,
                            );
                            
                        }
                    } 
                }
                closedir($handle);
                if (sizeof($module) > 0)
                    $modules = $module;
                else
                    $modules = false;
            }
            else
            {
                $modules = false;
            }
            
            if (Arr::get($_POST, 'install_this_module'))
            {
                $model_module = new Model_Admin_Modules;
                $module_install = $model_module->install();
                if (is_array($module_install))
                {
                    $data['errors'] = $module_install;
                }
                else
                {
                    $data['success'] = $module_install;
                }
            }
            
            $data['modules'] = $modules;
            $this->display_tpl('modules/install', $data);
	}
        
        
        public function modules_edit($id = 0)
        {
            $data = array();
            $this->display_tpl('modules/edit', $data);
        }
        

} // End Welcome
