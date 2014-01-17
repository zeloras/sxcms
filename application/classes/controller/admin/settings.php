<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Settings extends Controller_Admin_Special {
	public function settings()
	{
            $data = array();

            $dir = DOCROOT.'uploads/backup';
            $template_dir = 'templates/public';
            $config_file = 'config.xml';
            
            $get_config = file_get_contents($config_file);
            $get_xml_config = new SimpleXMLElement($get_config);
            $xml_template = $get_xml_config->base->template;
            if (Arr::get($_POST, 'change_template_base'))
            {
                $get_xml_config->base->template = Arr::get($_POST, 'templatedir');
                $update_template = file_put_contents($config_file, $get_xml_config->asXML());
                if ($update_template)
                    $data['success_template']= true;
            }
            $data['template_current'] = $xml_template;
            $key = 0;
            
            $backups = false;
            
            if(is_dir($dir)) 
            {
                $files = scandir($dir);
                array_shift($files);
                array_shift($files);
                foreach ($files as $file)
                {
                    $backups_exp = explode("-", $file);

                    switch ($backups_exp[0]) {
                        case 'sql':
                            $backup_name = __('Database');
                        break;

                        case 'files':
                            $backup_name = __('Files');
                        break;

                        case 'sql_and_files':
                            $backup_name = __('Files & database');
                        break;

                    }

                    $backups[] = array(
                        'time' => $backups_exp[2],
                        'link' => $file,
                        'name' => $backup_name,
                    );
                }
            } 
            $data['backup_mysql'] = $backups;
            
            
            
            if (Arr::get($_POST, 'submit_this_backup'))
            {
                switch (Arr::get($_POST, 'select_backup_type')) {
                    case 1:
                        $type_backup = "files";
                    break;

                    case 2:
                        $type_backup = "sql";
                    break;

                    case 3:
                        $type_backup = "sql_files";
                    break;

                    default:
                        $type_backup = "sql_files";
                    break;
                }
                $backup_model = new Model_Admin_Settings();
                $backup_model->admin_backup_create($type_backup);
                $result = $backup_model->_RESULT;
                if ($result)
                {
                    $data['success_backup_create'] = true;
                }
            }
            
            
            if (Arr::get($_POST, 'remove_this_backup'))
            {
                $file_del = Arr::get($_POST, 'backup');
                if (unlink($dir.'/'.$file_del))
                {
                    $data['success_backup_delete'] = true;
                }
            }
            
            
            if ($handle = opendir($template_dir)) 
            { 
                while (false !== ($file = readdir($handle))) 
                {  
                    if ($file != "." && $file != "..") 
                    {  
                        if (is_dir($template_dir.'/'.$file))
                        {
                            $xml_file = $template_dir.'/'.$file.'/template_info.xml';
                            if (file_exists($xml_file))
                            {
                                $xmlStr = file_get_contents($xml_file);
                                $xml = new SimpleXMLElement($xmlStr);
                                $template = $xml->template;
                                $author = $xml->author;
                                $data['templates'][$key]['base']['title'] = $template->title;
                                $data['templates'][$key]['base']['title_rus'] = $template->title_rus;
                                $data['templates'][$key]['base']['dir'] = $template_dir.'/'.$file;
                                $data['templates'][$key]['base']['name'] = $file;
                                $data['templates'][$key]['base']['png'] = '/'.$template_dir.'/'.$file.'/'.$template->png;
                                $data['templates'][$key]['author']['name'] = $author->name;
                                $contacts = '';
                                foreach (get_object_vars($author->contacts) as $keyz => $contact)
                                {
                                     $contacts .= $keyz."::".$contact.",, ";
                                     $data['templates'][$key]['author']['contacts_uns'][$keyz] = $contact;
                                }
                                $data['templates'][$key]['author']['contacts'] = $contacts;
                                $key++;
                            }
                        }
                    }  
                } 
                closedir($handle);  
            }
            
            $settings_show = ORM::factory('settings')->find()->as_array();
            $data['settings'] = array(
                    'general' => unserialize($settings_show['general']),
                    'seo' => unserialize($settings_show['seo']),
            );

            $data['cloud'] = unserialize($settings_show['cloud']);
            $data['comments'] = unserialize($settings_show['comments']);
            if ($data['cloud']['yandex']['active'] == 1)
            {
                $login = $data['cloud']['yandex']['login'];
                $password = $data['cloud']['yandex']['password'];
                $API = new Model_Libs_Api();
                $connect = $API->webdev_connect($login, $password, 'yandex');
                
                if ($connect['type'])
                    $data['cloud_files'] = $API->webdev_list_short();
            }

            if ($data['cloud']['ftp']['active'] == 1)
            {
                $login = $data['cloud']['ftp']['login'];
                $password = $data['cloud']['ftp']['password'];
                $server = $data['cloud']['ftp']['server'];
                $port = $data['cloud']['ftp']['port'];
                $API = new Model_Libs_Api();
                $connect = $API->ftp_connect($login, $password, $server, $port);
                if ($connect['type'])
                    $data['ftp_files'] = $API->ftp_list_short();
            }
            
            if (Arr::get($_POST, 'submit_this_form'))
            {
                $settings_model = new Model_Admin_Settings();
                $settings_insert = $settings_model->admin_settings_update();
                if (is_array($settings_insert))
                {
                    $data['errors'] = $settings_insert;
                }
                else
                {
                    $data['success'] = $settings_insert;
                }
            }
            
            $this->display_tpl('settings/index', $data);
	}
        

} // End Welcome
