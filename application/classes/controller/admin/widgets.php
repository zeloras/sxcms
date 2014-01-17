<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Widgets extends Roadmin {
	public function widgets_list()
	{
            $data = array();
            $widget_model = ORM::factory('widgets')->order_by('position')->find_all();
            
            $data['widgets'] = $widget_model;
            $this->display_tpl('widgets/index', $data);
	}
        
        public function widgets_add()
        {
            $data = array();
                        
            if (Arr::get($_POST, 'submit_this_form'))
            {
                $widget_model = new Model_Admin_Widgets();
                $widget_insert = $widget_model->admin_widgets_add();
                if (is_array($widget_insert))
                {
                    $data['errors'] = $widget_insert;
                }
                else
                {
                    $data['success'] = $widget_insert;
                }
            }
            $this->display_tpl('widgets/create', $data);
        }
        
        
        public function widgets_edit($id = 0)
        {
            $data = array();
            $widget_orm = ORM::factory('widgets')->where('id', '=', $id)->find();
            $settings_template = Helper_Admin::get_settings();
            $template = $settings_template['template'];
            $widget_file = DOCROOT.'templates/public/'.$template.'/widgets/'.$widget_orm->name.'.php';
            $widget_orm->data = file_get_contents($widget_file);
            if (Arr::get($_POST, 'submit_this_form'))
            {
                $widget_model = new Model_Admin_Widgets();
                $widget_update = $widget_model->admin_widgets_edit($id);
                if (is_array($widget_update))
                {
                    $data['errors'] = $widget_update;
                }
                else
                {
                    $data['success'] = $widget_update;
                }
            }
            $data['widget'] = $widget_orm;
            $this->display_tpl('widgets/edit', $data);
        }
        

} // End Welcome
