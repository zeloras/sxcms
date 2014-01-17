<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Pages extends Controller_Admin_Roles {
	public function page_list()
	{
            $data = array();
            $data['sidebar_categories'] = Helper_Admin::get_categories_sidebar();
            
            $filter_sortby = Arr::get($_GET, 'filterSortBy');
            $filter_category = Arr::get($_GET, 'filterCat');
            $filter_sortby_exp = explode(":", $filter_sortby);
            $filter_sortby_exp = array(
                'row' => $filter_sortby_exp[0],
                'value' => ($filter_sortby_exp[1] == "asc") ? $filter_sortby_exp[1] : "desc",
            );
            
            $data['sortby'] = ($filter_sortby_exp['value'] == "asc") ? "desc" : "asc";
            
            $pages_count = ORM::factory('pages');
            if ($filter_category)
                $pages_count->where('category', '=', $filter_category);
            $pages_count = $pages_count->count_all();
            
             $pagination = Pagination::factory(
                        array(
                                'total_items' => $pages_count,
                                'view' => 'pagination/admin',
                                'items_per_page' => 25,
                            )
                    );
            
            $pages = ORM::factory('pages');
            if ($filter_sortby)
                $pages->order_by($filter_sortby_exp['row'], $filter_sortby_exp['value']);
            if ($filter_category)
                $pages->where('category', '=', $filter_category);
            $pages = $pages->limit($pagination->items_per_page)->offset($pagination->offset)->find_all();
            
            foreach ($pages as $key => $page)
            {
                $category_info[$key] = Helper_Common::get_category_info($page->category);
            }

            $data['pagination'] = $pagination;
            $data['pages'] = $pages;
            $data['category_info'] = $category_info;
            $this->display_tpl('pages/index', $data);
	}
        
        public function page_add()
        {
            $data = array();
            
            $category_model = ORM::factory('admin_categorys');
            $tree = $category_model->buildForAdmin();
            $cats = $category_model->sub_cats($tree); 
            $data['tree'] = $cats;
            $data['catTreeHTML'] = $category_model->renderCatOptList($tree);
            $data['additional_fields'] = $this->get_properties(0, 0, 'fetch');

            if (Arr::get($_POST, 'submit_this_form'))
            {
                $category_id = Arr::get($_POST, 'category');
                
                $page_model = new Model_Admin_Pages;
                $page_insert = $page_model->admin_page_add();
                
                $model_additional_fields_data = new Model_Admin_Fieldsdata;
                $model_additional_fields_data->create_additional_data($category_id, $page_insert);
                if (is_array($page_insert))
                {
                    $data['errors'] = $page_insert;
                }
                else
                {
                    $data['success'] = $page_insert;
                }
            }
            $this->display_tpl('pages/create', $data);
        }
        
        
        public function page_edit($id = 0)
        {
            $data = array();
            $data['page_id'] = $id;
            $data['page'] = ORM::factory('pages')->where('id', '=', $id)->find()->as_array();
            
            $category_model = ORM::factory('admin_categorys');
            $tree = $category_model->buildForAdmin();
            $cats = $category_model->sub_cats($tree); 
            $data['tree'] = $cats;
            $data['catTreeHTML'] = $category_model->renderCatOptList($tree, array('sel_cat' => $data['page']['category']));
            $data['additional_fields'] = $this->get_properties($data['page']['category'], $id, 'fetch');

            
            if (Arr::get($_POST, 'submit_this_form'))
            {
                $page_model = new Model_Admin_Pages();
                $page_edit = $page_model->admin_page_edit($id);
                
                $model_additional_fields_data = new Model_Admin_Fieldsdata;
                $model_additional_fields_data->create_additional_data(0, $id);

                
                if (is_array($page_edit))
                {
                    $data['errors'] = $page_edit;
                }
                else
                {
                    $data['success'] = $page_edit;
                }
            }
            $this->display_tpl('pages/edit', $data);
        }
        

} // End Welcome
