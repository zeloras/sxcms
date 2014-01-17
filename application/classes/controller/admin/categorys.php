<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Categorys extends Controller_Admin_Comments {
	public function category_list()
	{
            $data = array();
            $category_model = ORM::factory('admin_categorys');
            
            $tree = $category_model->buildForAdmin();
            //$cats = $category_model->sub_cats($tree);
            $cat_tree = $category_model->renderCatList($tree);
            
            $data['categorys'] = $cat_tree;
            $this->display_tpl('categorys/index', $data);
	}
        
        
        public function category_add()
        {
            $data = array();
            $category_model = ORM::factory('admin_categorys');
            $tree = $category_model->buildForAdmin();
            $cats = $category_model->sub_cats($tree); 
            $data['tree'] = $cats;
            $data['catTreeHTML'] = $category_model->renderCatOptList($tree);
            
            if (Arr::get($_POST, 'submit_this_form'))
            {
                $category_model = new Model_Admin_Categorys();
                $category_insert = $category_model->admin_category_add();
                if (is_array($category_insert))
                {
                    $data['errors'] = $category_insert;
                }
                else
                {
                    $data['success'] = $category_insert;
                }
            }
            $this->display_tpl('categorys/create', $data);
        }
        
        
        
        public function category_edit($id = 0)
        {
            $data = array();
            $data['category_id'] = $id;
            $data['category'] = ORM::factory('categorys')->where('id', '=', $id)->find()->as_array();

            $category_model = ORM::factory('admin_categorys');
            $tree = $category_model->buildForAdmin();
            $cats = $category_model->sub_cats($tree); 
            $data['tree'] = $cats;
            $data['catTreeHTML'] = $category_model->renderCatOptList($tree, array('sel_cat' => $data['category']['parent_id'], 'no_sel' => $id));
            
            if (Arr::get($_POST, 'submit_this_form'))
            {
                $category_model = new Model_Admin_Categorys();
                $category_update = $category_model->admin_category_edit($id);
                if (is_array($category_update))
                {
                    $data['errors'] = $category_update;
                }
                else
                {
                    $data['success'] = $category_update;
                }
            }
            $this->display_tpl('categorys/edit', $data);
        }

} // End Welcome
