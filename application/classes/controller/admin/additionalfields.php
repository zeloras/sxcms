<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Additionalfields extends Controller_Admin_Auth {
	public function fields_list()
	{
            $data = array();
            $objects_size = ORM::factory('fields')->count_all();
            $category_rows = ORM::factory('categorys')->count_all();
            //if (sizeof($category_rows) < 1) showMessage('У вас нет категорий в магазине, пожалуйста создайте перед началом работы.');

            $properties_list = ORM::factory('fields')->order_by('position')->find_all();
            if (sizeof($properties_list) > 0)
            {
                $data['properties'] = $properties_list;
            }
            else
            {
                $data['no_properties'] = true;
            }

            $this->display_tpl('additional_fields/index', $data);
	}
        
        public function fields_add()
        {
            $data = array();
            $category_model = ORM::factory('admin_categorys');
            $tree = $category_model->buildForAdmin();
            $data['catTreeHTML'] = $category_model->renderCatOptList($tree);
            
            if (Arr::get($_POST, 'submit_this_form'))
            {
                $fields_model = new Model_Admin_Fields();
                $fields_insert = $fields_model->admin_fields_add();
                if (is_array($fields_insert))
                {
                    $data['errors'] = $fields_insert;
                }
                else
                {
                    $data['success'] = $fields_insert;
                }
            }
            
            $this->display_tpl('additional_fields/create', $data);
        }
        
        public function fields_edit($id = 0)
        {
            $data = array();
            $field_model = ORM::factory('fields')->where('id', '=', $id)->find();
            $category_model = ORM::factory('admin_categorys');
            $tree = $category_model->buildForAdmin();
            $cats_list = unserialize($field_model->category);
            $select_cats = array('sel_cat' => (sizeof($cats_list) > 0) ? $cats_list : array());
            $data['catTreeHTML'] = $category_model->renderCatOptList($tree, $select_cats);
            $data['field'] = $field_model;
            if (Arr::get($_POST, 'submit_this_form'))
            {
                $fields_model = new Model_Admin_Fields();
                $fields_edit = $fields_model->admin_fields_edit($id);
                if (is_array($fields_edit))
                {
                    $data['errors'] = $fields_edit;
                }
                else
                {
                    $data['success'] = $fields_edit;
                }
            }
            
            $this->display_tpl('additional_fields/edit', $data);
        }
        

} // End Welcome
