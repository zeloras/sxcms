<?php defined('SYSPATH') or die('No direct script access.');

class Model_Admin_Modules
{    
    
    public function install()
    {
        $module_dir = Arr::get($_POST, 'module');
        $path_modules = DOCROOT.'/application/classes/modules/';
        $xml_file = $path_modules.$module_dir.'/mod_info.xml';
        if (file_exists($xml_file))
        {
            $module_count = ORM::factory('modules')->find('dir', '=', $module_dir)->count_all();
            if ($module_count == 0)
            {
                $get_info = file_get_contents($xml_file);
                $get_xml_info = new SimpleXMLElement($get_info);
                $contacts = (array)$get_xml_info->contacts;
                $module_info = array(
                    'name' => (strlen($get_xml_info->name) > 1) ? $get_xml_info->name : 'No name',
                    'description' => (strlen($get_xml_info->description) > 1) ? $get_xml_info->description : 'No description',
                    'version' => (strlen($get_xml_info->version) > 1) ? $get_xml_info->version : '0.0.1',
                    'author' => (strlen($get_xml_info->author) > 1) ? $get_xml_info->author : 'unknown',
                    'contacts' => (sizeof($contacts) > 0) ? $contacts : false,
                );
                
                $access_module = Helper_Admin::put_modules_access($module_dir);
                
                if (is_array($access_module))
                {
                    $role_id = Helper_Common::get_userinfo();
                    $get_roles = ORM::factory('roles')->where('is_admin', '=', 1)->or_where('id', '=', $role_id['role_id'])->find_all();
                }
                
                $role_id = Helper_Common::get_userinfo();
                $get_roles = ORM::factory('roles')->where('is_admin', '=', 1)->or_where('id', '=', $role_id['role_id'])->find_all();
                foreach ($get_roles as $grol)
                {
                    $new_data = array_unique(array_merge(unserialize($grol->access), $access_module));
                    $req = ORM::factory('roles')->where('id', '=', $grol->id)->find();
                    $req->access = serialize($new_data);
                    $req->update();
                }
                
                $modules_query = new Model_Modules();

                try
                {
                    $modules_query->name = $module_info['name'];
                    $modules_query->description = $module_info['description'];
                    $modules_query->version = $module_info['version'];
                    $modules_query->author = $module_info['author'];
                    $modules_query->author_info = serialize($module_info['contacts']);
                    $modules_query->dir = $module_dir;
                    $modules_query->position = 0;
                    $modules_query->active = 1;
                    $modules_query->menu = 0;
                    $modules_query->site = 0;
                    $modules_query->date = time();
                    
                    return $modules_query->save();
                }
                catch(ORM_Validation_Exception $e)
                {
                        return $e->errors('admin');
                }
            }
            else
            {
                return array('Module already installed');
            }
        }
        else
        {
            return array('Module not isset');
        }
    }
    
}
