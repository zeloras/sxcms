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
            $this->display_tpl('languages/create', $data);
        }
        
        public function languages_edit($id = 0)
        {
            $data = array();
            $this->display_tpl('modules/edit', $data);
        }
        

} // End Welcome
