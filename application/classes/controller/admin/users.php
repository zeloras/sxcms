<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Users extends Controller_Admin_Widgets {
	public function users_list()
	{
            $data = array();
            
            $filter_sortby = Arr::get($_GET, 'filterSortBy');
            $filter_sortby_exp = explode(":", $filter_sortby);
            $filter_sortby_exp = array(
                'row' => $filter_sortby_exp[0],
                'value' => ($filter_sortby_exp[1] == "asc") ? $filter_sortby_exp[1] : "desc",
            );
            
            $data['sortby'] = ($filter_sortby_exp['value'] == "asc") ? "desc" : "asc";
            
            $users_count = ORM::factory('users')->count_all();
            
            $pagination = Pagination::factory(
                    array(
                            'total_items' => $users_count,
                            'view' => 'pagination/admin',
                            'items_per_page' => 25,
                        )
                );
            
            $users = ORM::factory('users');
            if ($filter_sortby)
                $users->order_by($filter_sortby_exp['row'], $filter_sortby_exp['value']);
            $users = $users->limit($pagination->items_per_page)->offset($pagination->offset)->find_all();
            
            $roles_users = ORM::factory('userroles')->find_all();
            foreach ($roles_users as $urole)
            {
                $roles = ORM::factory('roles')
                        ->where('id', '=', $urole->role_id)
                        ->select('id', 'title')
                        ->find()
                        ->as_array();
                $ret_roles[$urole->user_id] = $roles;
            }
            
            $data['users_roles'] = $ret_roles;
            $data['users'] = $users;
            $data['pagination'] = $pagination;
            $this->display_tpl('users/index', $data);
	}
        
        public function users_add()
        {
            $data = array();
            $data['roles'] = ORM::factory('roles')->select('id', 'title')->find_all();
            if (Arr::get($_POST, 'submit_this_form'))
            {
                $users_model = new Model_Admin_Users();
                $users_insert = $users_model->admin_users_add();
                if (is_array($users_insert))
                {
                    $data['errors'] = $users_insert;
                }
                else
                {
                    $data['success'] = $users_insert;
                }
            }
            $this->display_tpl('users/create', $data);
        }
        
        
        public function users_edit($id = 0)
        {
            $data = array();
            $data['user_id'] = $id;
            $data['user'] = ORM::factory('users')->where('id', '=', $id)->find()->as_array();
            $data['roles'] = ORM::factory('roles')->select('id', 'title')->find_all();
            $role_id = ORM::factory('userroles')->where('user_id', '=', $id)->find();
            $data['user_role'] = $role_id->role_id;
           
            if (Arr::get($_POST, 'submit_this_form'))
            {
                $users_model = new Model_Admin_Users();
                $users_edit = $users_model->admin_users_edit($id);
                if (is_array($users_edit))
                {
                    $data['errors'] = $users_edit;
                }
                else
                {
                    $data['success'] = $users_edit;
                }
            }
            $this->display_tpl('users/edit', $data);
        }
        

} // End Welcome
