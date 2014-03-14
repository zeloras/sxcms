<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Language extends Controller_Admin_Menus {
	public function languages_list()
	{
            $data = array();
            $languages_model = ORM::factory('langs')->find_all();

            $data['languages'] = $languages_model;
            $this->display_tpl('languages/index', $data);
	}
        
        public function languages_add()
        {
            $data = array();
            if (Arr::get($_POST, 'submit_this_form'))
            {
                $lang_model = new Model_Admin_Languages();
                $lang_model_insert = $lang_model->admin_languages_add();
                if (is_array($lang_model_insert))
                {
                    $data['errors'] = $lang_model_insert;
                }
                else
                {
                    $data['success'] = $lang_model_insert;
                }
            }
            $this->display_tpl('languages/create', $data);
        }
        
        public function languages_edit($id = 0)
        {
            $data = array();
            $lang_model = ORM::factory('langs')->where('id', '=', $id)->find();
            $data['language_edit'] = $lang_model;
            
            if (Arr::get($_POST, 'submit_this_form'))
            {
                $lang_model = new Model_Admin_Languages();
                $lang_model_update = $lang_model->admin_languages_edit($id);
                if (is_array($lang_model_update))
                {
                    $data['errors'] = $lang_model_update;
                }
                else
                {
                    $data['success'] = $lang_model_update;
                }
            }
            $this->display_tpl('languages/edit', $data);
        }
        

} // End Welcome
