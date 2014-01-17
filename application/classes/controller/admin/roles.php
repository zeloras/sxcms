<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Roles extends Controller_Admin_Settings {
	public function roles_list()
	{
            $data = array();
            $roles = ORM::factory('roles')->find_all();
            
            $data['roles'] = $roles;
            $this->display_tpl('roles/index', $data);
	}
        
        public function roles_add()
        {
            $data = array();
            $data['mod_access'] = Helper_Admin::get_modules_access();

            if (Arr::get($_POST, 'submit_this_form'))
            {
                $roles_model = new Model_Admin_Roles();
                $roles_insert = $roles_model->admin_roles_add();
                if (is_array($roles_insert))
                {
                    $data['errors'] = $roles_insert;
                }
                else
                {
                    $data['success'] = $roles_insert;
                }
            }
            $this->display_tpl('roles/create', $data);
        }
        
        
        public function roles_edit($id = 0)
        {
            $data = array();
            $data['role_id'] = $id;
            $data['role'] = ORM::factory('roles')->where('id', '=', $id)->find()->as_array();
            $access = unserialize($data['role']['access']);
            $data['mod_access'] = Helper_Admin::get_modules_access($access);
            $data['access'] = (is_array($access)) ? $access : array();
            
            if (Arr::get($_POST, 'submit_this_form'))
            {
                $roles_model = new Model_Admin_Roles();
                $roles_edit = $roles_model->admin_roles_edit($id);
                if (is_array($roles_edit))
                {
                    $data['errors'] = $roles_edit;
                }
                else
                {
                    $data['success'] = $roles_edit;
                }
            }
            $this->display_tpl('roles/edit', $data);
        }
        

} // End Welcome
