<?php
class Helper_Public
 {
    
    public static function get_settings()
    {
        $config_file = DOCROOT.'config.xml';
        $get_config = file_get_contents($config_file);
        $get_xml_config = new SimpleXMLElement($get_config);
        $xml_template = $get_xml_config->base->template;
        
        $settings = ORM::factory('settings')->find()->as_array();
        $general = unserialize($settings['general']);
        $seo = unserialize($settings['seo']);
        $comments = unserialize($settings['comments']);
        $data['general'] = $general;
        $data['seo'] = $seo;
        $data['comments'] = $comments;
        $data['template'] = (string)$xml_template;
        return $data;
    }

    public static function breadcrumbs($type, $data = array())
    {
        $get_settings = Helper_Public::get_settings();
        $template = $get_settings['template'];
        
        $data_type = array(
            'category' => array('title' => 'Категории', 'url' => '', 'uset' => false, 'nolink' => false, 'notype' => true),
            'index' => array('title' => 'Главная', 'url' => '', 'uset' => true, 'nolink' => true, 'notype' => false),
            'nocat' => array('title' => 'Главная', 'url' => '', 'uset' => true, 'nolink' => false, 'notype' => true),
            'page' => array('title' => '', 'url' => '', 'uset' => false, 'nolink' => false, 'notype' => true),
            'category_list' => array('title' => 'Категории', 'url' => '', 'uset' => false, 'nolink' => false, 'notype' => true),
        );
        
        if (isset($data_type[$type]))
        {
            if (sizeof($data) > 0)
            {
                $category_query = ORM::factory('categorys');
                $category_query->select('id', 'title', 'parent_id', 'url');
                $category_query->where('id', '=', $data['cid']);
                $category_first = $category_query->find_all();
                $cat = $category_first[0];
                $url = '';
                $i = (isset($cat->parent_id)) ? $cat->parent_id : 0;
                while ($i != 0)
                {
                    $category_query = ORM::factory('categorys');
                    $category_query->where('id', '=', $i);
                    $res = $category_query->find_all();
                    $end_data['res'][] = array('title' => $res[0]->title, 'url' => $res[0]->url);
                    $i = $res[0]->parent_id;
                }
                $end_data['res'][] = $data_type[$type];
                $end_data['bread'] = array_reverse($end_data['res']);

                foreach ($end_data['bread'] as $key => $br)
                {
                    $end_data['bread'][$key]['url'] = $url.$br['url'];
                    $url .= $br['url'].'/';
                }
                
                if (isset($cat->title))
                $end_data['bread'][] = array('title' => $cat->title, 'url' => $url.$cat->url);
            }
            
            if ($data_type[$type]['uset'])
            {
                if (isset($end_data))
                        unset($end_data['bread']);
                
                if (!$data_type[$type]['nolink'])
                {
                    if (sizeof($data) < 1)
                    {
                        $end_data['bread'][] = $data_type[$type];
                    }
                    else
                    {
                        $type = ($data_type[$type]['notype']) ? '' : $type.'/';
                        $end_data['bread'][] = array('title' => $data['title'], 'url' => $type.$data['url']);
                    }
                }
                else
                {
                    $end_data['no_url'] = true;
                }
            }
            else
            {
                if ($data_type[$type]['notype'])
                    $type = '';
                
                if (sizeof($data) > 1)
                $end_data['bread'][] = array('title' => $data['title'].'', 'url' => $type.'/'.$data['url']);
            }
        }
        else
        {
            $end_data['no_url'] = true;
        }
        return View::factory('public/'.$template.'/system/breadcrumbs', @$end_data);
    }
     
     public static function load_menu($menu_name = 'default')
     {
         $menu_load = ORM::factory('menus')->select('id', 'name')->where('name', '=', $menu_name);
         $menu_load_count = $menu_load->count_all();
         $get_settings = Helper_Public::get_settings();
         $template = $get_settings['template'];
         
         if ($menu_load_count > 0)
         {
             $menu_load_last = $menu_load->where('name', '=', $menu_name)->find();
             $menu_id = $menu_load_last->id;
             
             $links_load = ORM::factory('links')->where('menu_id', '=', $menu_id);
             $links_load_count = $links_load->count_all();
             if ($links_load_count > 0)
             {
                 $menu_conf = $menu_load_last->as_array();
                 $data['links'] = Menu::factory('example', $menu_conf);
             }
             else
             {
                 $data['no_links'] = true;
             }
         }
         else
         {
             $data['no_menu'] = true;
         }
         
         return View::factory('public/'.$template.'/system/menu/menu', $data);
     }
    
     
     public static function Widget($name = '')
     {
         $get_settings = Helper_Public::get_settings();
         $template = $get_settings['template'];
         $widget_file = DOCROOT.'templates/public/'.$template.'/widgets/'.$name.'.php';
         $widget_active = ORM::factory('widgets')->where('name', '=', $name)->where('active', '=', 1)->count_all();
         if (file_exists($widget_file) && $widget_active > 0)
         {
             $data = file_get_contents($widget_file);
         }
         else
         {
             $data = "<h3><strong>".__("Widget couldn't load")."</strong></h3>";
         }
         
         return $data;
     }
 }