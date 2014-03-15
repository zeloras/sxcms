<?php
class Helper_Admin
{
    public static function get_settings()
    {
        $config_file = 'config.xml';
        $get_config = file_get_contents($config_file);
        $get_xml_config = new SimpleXMLElement($get_config);
        $xml_template = $get_xml_config->base->template;
        
        $settings = ORM::factory('settings')->find()->as_array();
        $cloud = unserialize($settings['cloud']);
        $general = unserialize($settings['general']);
        $seo = unserialize($settings['seo']);
        $comments = unserialize($settings['comments']);
        $data['yandex_cloud'] = $cloud['yandex'];
        $data['ftp'] = $cloud['ftp'];
        $data['general'] = $general;
        $data['seo'] = $seo;
        $data['comments'] = $comments;
        $data['template'] = $xml_template;
        return $data;
    }
    
    public static function put_modules_access($module_dir)
    {
        $xml_file = DOCROOT.'application/classes/modules/'.$module_dir.'/mod_info.xml';
        if (file_exists($xml_file))
        {
            $get_info = file_get_contents($xml_file);
            $get_xml_info = new SimpleXMLElement($get_info);
            $access = (array)$get_xml_info->access;
            if (sizeof($access) > 1)
            {
               foreach ($access['admin'] as $tez => $acc)
               {
                   $admin_prev = $module_dir.'_admin_'.$tez;
                   $module[] = $admin_prev;
               }

               foreach ($access['public'] as $tez => $acc)
               {
                   $public_prev = $module_dir.'_public_'.$tez;
                   $module[] = $public_prev;
               }
            }
        }
        
        if (sizeof($module) > 0)
            $modules = $module;
        else
            $modules = array();

        return $modules;
    }
    
    public static function get_modules_access($put_roles = array())
    {
        $key = 0;
        $mod_admin = array();
        $mod_public = array();
        $mod_path = DOCROOT.'application/classes/modules/';
            if ($handle = opendir($mod_path)) 
            {
                while (false !== ($file = readdir($handle))) 
                {
                    if ($file != "." && $file != "..") 
                    {
                        $xml_file = $mod_path.$file.'/mod_info.xml';
                        $count_module = ORM::factory('modules')->where('dir', '=', $file)->count_all();
                        if (file_exists($xml_file) && $count_module > 0)
                        {
                            $get_info = file_get_contents($xml_file);
                            $get_xml_info = new SimpleXMLElement($get_info);
                            $access = (array)$get_xml_info->access;
                            if (sizeof($access) > 1)
                            {
                               foreach ($access['admin'] as $tez => $acc)
                               {
                                   $admin_prev = $file.'_admin_'.$tez;
                                   $checked = (in_array($admin_prev, $put_roles)) ? true : false;
                                   $mod_admin[] = array('value' => $admin_prev, 'title' => Kohana::i18n ('module', 0, 'name', $file, (string)$acc->title), 'checked' => $checked);
                               }
                               
                               foreach ($access['public'] as $tez => $acc)
                               {
                                   $public_prev = $file.'_public_'.$tez;
                                   $checked = (in_array($public_prev, $put_roles)) ? true : false;
                                   $mod_public[] = array('value' => $public_prev, 'title' => Kohana::i18n ('module', 0, 'name', $file, (string)$acc->title), 'checked' => $checked);
                               }
                               $module[$key] = array('title' => Kohana::i18n ('module', 0, 'name', $file, (string)$get_xml_info->name),'data' => array_merge($mod_admin, $mod_public)); 
                            
                               $key++;   
                            }
                        }
                    } 
                }
                closedir($handle);
                if (sizeof($module) > 0)
                    $modules = $module;
                else
                    $modules = array();
            }
            else
            {
                $modules = array();
            }
            return $modules;
    }
    
    
    public static function get_modules_widgets($get_checked = false)
    {
        $key = 0;
        $mod_admin = array();
        $mod_public = array();
        $mod_path = DOCROOT.'application/classes/modules/';
            if ($handle = opendir($mod_path)) 
            {
                while (false !== ($file = readdir($handle))) 
                {
                    if ($file != "." && $file != "..") 
                    {
                        $xml_file = $mod_path.$file.'/widgets.xml';
                        $xml_file_info = $mod_path.$file.'/mod_info.xml';
                        $count_module = ORM::factory('modules')->where('dir', '=', $file)->count_all();
                        if (file_exists($xml_file) && $count_module > 0)
                        {
                            $get_widgets = file_get_contents($xml_file);
                            $get_mod_info = file_get_contents($xml_file_info);
                            $get_widgets_xml = new SimpleXMLElement($get_widgets);
                            $get_mod_xml = new SimpleXMLElement($get_mod_info);
                            $widgets = (array)$get_widgets_xml;

                            if (sizeof($widgets['widget']) > 1)
                            {
                               foreach ($widgets['widget'] as $dkey => $widget_data)
                               {
                                   $value = $file.":".$widget_data->method;
                                   //HARDCORE!!!
                                   $checked = ($get_checked == false) ? 'true_false' : ($get_checked == $value) ? true : false;
                                   $checked = ($checked !== 'true_false') ? $checked : ($dkey == 0 && $key == 0) ? true : false;
                                   $widget_admin[] = array('value' => $value, 'title' => Kohana::i18n ('module', 0, 'name', $file, (string)$widget_data->title), 'checked' => $checked);
                               }

                               $module_widget[$key] = array('title' => Kohana::i18n ('module', 0, 'name', $file, (string)$get_mod_xml->name), 'data' => $widget_admin); 
                            
                               $key++;   
                            }
                        }
                    } 
                }
                closedir($handle);
                if (sizeof($module_widget) > 0)
                    $widgets = $module_widget;
                else
                    $widgets = array();
            }
            else
            {
                $widgets = array();
            }
            return $widgets;
    }
    

    public static function get_system_info()
    {
        $config_file = 'config.xml';
        $get_config = file_get_contents($config_file);
        $get_xml_config = new SimpleXMLElement($get_config);
        $data['current_version'] = $get_xml_config->base->current_version;
        $data['last_version'] = $get_xml_config->base->latest_version;
        $data['last_update'] = (int)$get_xml_config->base->last_connect;
        return $data;
    }

    public static function get_categories_sidebar()
    {
        $cat_model = new Model_Admin_Categorys();
        $tree = $cat_model->buildForAdmin();
        $cat_tree = $cat_model->renderCatList($tree, 'sidebar-list');
        return $cat_tree;
    }
    
    public static function get_comment_url($id = 0, $mod = 'core')
    {
        switch ($mod) {
            case 'page':
                $model_connect = ORM::factory('pages')->where('id', '=', $id)->find();
                $end_data = array(
                        'title' => $model_connect->title,
                        'url' => $model_connect->cat_url.$model_connect->url,
                    );
            break;

            default:
            break;
        }
        return $end_data;
    }
    
    public static function get_icon_class($action = 0, $module = 'core')
    {
        switch ($module)
        {
            case 'comments':
                switch ($action) 
                {
                    case 0:
                        $return_data = array('color' => 'badge', 'icon' => 'icon-time');
                    break;
                
                    case 1:
                        $return_data = array('color' => 'badge badge-success', 'icon' => 'icon-ok');
                    break;
                
                    case 2:
                        $return_data = array('color' => 'badge badge-warning', 'icon' => 'icon-warning-sign');
                    break;
                }
            break;
        }
        return $return_data;
    }
 }