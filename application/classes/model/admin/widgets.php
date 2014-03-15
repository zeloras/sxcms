<?php defined('SYSPATH') or die('No direct script access.');

class Model_Admin_Widgets
{    
    
    public function admin_widgets_add()
    {
        $title = Arr::get($_POST, 'title');
        $name = Arr::get($_POST, 'name');
        $description = Arr::get($_POST, 'description');
        $type = Arr::get($_POST, 'type');
        $module_data = Arr::get($_POST, 'widget_module');
        $data = Arr::get($_POST, 'data');
        $widgets_query = new Model_Widgets();
        
        try		
        {
            $widgets_query->title = $title;
            $widgets_query->name = $name;
            $widgets_query->description = $description;
            $widgets_query->type = $type;
            if ($type == "html")
            {
                $get_template = Helper_Admin::get_settings();
                $template = $get_template['template'];
                $widget_file = DOCROOT.'templates/public/'.$template.'/widgets/'.$name.'.php';
                file_put_contents($widget_file, $data);
            }
            else
            {
                $mod_exp = explode(':', $module_data);
                $widgets_query->module = $mod_exp[0];
                $widgets_query->method = $mod_exp[1];
            }
            $widgets_query->settings = '';
            $widgets_query->position = 0;
            $widgets_query->active = 1;
            $widgets_query->date = time();
            
            return $widgets_query->save();
        }
        catch(ORM_Validation_Exception $e)
        {
                return $e->errors('admin');
        }
    }
    
    
    public function admin_widgets_edit($id = 0)
    {
        $wid = Arr::get($_POST, 'widget_id');
        $title = Arr::get($_POST, 'title');
        $name = Arr::get($_POST, 'name');
        $description = Arr::get($_POST, 'description');
        $type = Arr::get($_POST, 'type');
        $module = Arr::get($_POST, 'module');
        $data = Arr::get($_POST, 'data');
        $widgets_query = ORM::factory('widgets');
        $widgets_query->where('id', '=', $id);
        $widget_query_count = $widgets_query->count_all();
        
        if ($widget_query_count > 0 && $wid == $id)
        {
            $widgets_query->where('id', '=', $id);
            $widgets_query = $widgets_query->find();
            $name_old = $widgets_query->name;
            try		
            {
                $widgets_query->id = $wid;
                $widgets_query->title = $title;
                $widgets_query->name = $name;
                $widgets_query->description = $description;
                $widgets_query->type = $type;
                if ($type == "html")
                {
                    $get_template = Helper_Admin::get_settings();
                    $template = $get_template['template'];
                    $widget_path = DOCROOT.'templates/public/'.$template.'/widgets/';
                    $widget_file_new = $name.'.php';
                    $widget_file_old = $name_old.'.php';
                    if (file_exists($widget_path.$widget_file_old))
                        unlink($widget_path.$widget_file_old);
                    file_put_contents($widget_path.$widget_file_new, $data);
                }
                else
                {
                    $widgets_query->module = $module;
                }
                
                $widgets_query->update();
                return $wid;
            }
            catch(ORM_Validation_Exception $e)
            {
                    return $e->errors('admin');
            }
        }
        else
        {
            if ($wid !== $id)
                return array(0 => 'Widget wrong');
            else
                return array(0 => "Widget not isset");
        }
    }
}
