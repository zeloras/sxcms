<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Menus extends Controller_Admin_Modules {

    public function menus_list()
    {
        $menu_model = ORM::factory('menus')->find_all();
        foreach ($menu_model as $links)
        {
            $count_links = ORM::factory('links')->where('menu_id', '=', $links->id)->count_all();
            $data['count_links'][$links->id] = $count_links;
        }
        $data['menus'] = $menu_model;
        $this->display_tpl('menus/index', $data);
    }
    
    public function menus_data_list($id = 0)
    {
        $data['menu_id'] = $id;
        
        $links_model = ORM::factory('admin_menus');

        $tree = $links_model->buildLinks($id);
        $cat_tree = $links_model->renderList($tree);
        
        $data['links'] = $cat_tree;
        $this->display_tpl('menus/data/index', $data);
    }
    
    
    public function menus_data_add($id = 0)
    {
        $data = array();
        $category_model = ORM::factory('admin_categorys');
        $tree = $category_model->buildForAdmin();
        $data['catTreeHTML'] = $category_model->renderCatOptList($tree);
        $data['menu_id'] = $id;
        $data['parrents'] = ORM::factory('links')->where('menu_id', '=', $id)->find_all();
        if (Arr::get($_POST, 'submit_this_form'))
        {
            $link_model = new Model_Admin_Menus();
            $link_insert = $link_model->admin_link_add($id);
            if (is_array($link_insert))
            {
                $data['errors'] = $link_insert;
            }
            else
            {
                $data['success'] = $link_insert;
            }
        }
        $this->display_tpl('menus/data/create', $data);
    }
    
    public function menus_data_edit($id = 0, $item = 0)
    {
        $data = array();
        $data['menu_id'] = $id;
        $data['item_id'] = $item;
        $data['parrents'] = ORM::factory('links')->where('menu_id', '=', $id)->find_all();
        $link_query = ORM::factory('links');
        $link_query->where('menu_id', '=', $id);
        $link_query->where('id', '=', $item);
        $mdata = $link_query->find();

        $data['mdata'] = $mdata;
        $data['mdata']->data = unserialize($mdata->data);
        
        switch ($data['mdata']->data['type'])
        {
            case 1:
                $category_model = ORM::factory('admin_categorys');
                $tree = $category_model->buildForAdmin();
                $data['sel']['type'] = 1;
                $data['sel']['first'] = $category_model->renderCatOptList($tree, array('sel_cat' => $data['mdata']->data['first']));
                $data['sel']['second'] = '';
                $data['sel']['threed'] = '';
                
            break;
        
            case 2:
                $category_model = ORM::factory('admin_categorys');
                $tree = $category_model->buildForAdmin();
                
                $pages = ORM::factory('pages')->where('category', '=', $data['mdata']->data['first'])->find_all();
                $data['sel']['sechtml'] = $pages;
                $data['sel']['type'] = 2;
                $data['sel']['first'] = $category_model->renderCatOptList($tree, array('sel_cat' => $data['mdata']->data['first']));
                $data['sel']['second'] = $data['mdata']->data['second'];
                $data['sel']['threed'] = '';
            break;
        
            case 3:
                $data['sel']['type'] = 3;
                $data['sel']['first'] = $data['mdata']->data['first'];
                $data['sel']['second'] = '';
                $data['sel']['threed'] = '';
            break;
        
            case 4:
                $data['sel']['type'] = 4;
                $data['sel']['first'] = $data['mdata']->data['first'];
                $data['sel']['second'] = '';
                $data['sel']['threed'] = $data['mdata']->data['threed'];
            break;
        }
        
        if (Arr::get($_POST, 'submit_this_form'))
        {
            $menu_model = new Model_Admin_Menus();
            $menu_update = $menu_model->admin_link_edit($id, $item);
            if (is_array($menu_update))
            {
                $data['errors'] = $menu_update;
            }
            else
            {
                $data['success'] = $menu_update;
            }
        }
        $this->display_tpl('menus/data/edit', $data);
    }
    
    
    public function menus_add()
    {
        $data = array();

        if (Arr::get($_POST, 'submit_this_form'))
        {
            $menu_model = new Model_Admin_Menus();
            $menu_insert = $menu_model->admin_menus_add();
            if (is_array($menu_insert))
            {
                $data['errors'] = $menu_insert;
            }
            else
            {
                $data['success'] = $menu_insert;
            }
        }
        $this->display_tpl('menus/create', $data);
    }
    
    public function menus_edit($id = 0)
    {
        $data = array();
        $data['menu_id'] = $id;
        $data['menu'] = ORM::factory('menus')->where('id', '=', $id)->find()->as_array();

        if (Arr::get($_POST, 'submit_this_form'))
        {
            $menu_model = new Model_Admin_Menus();
            $menu_update = $menu_model->admin_menus_edit($id);
            if (is_array($menu_update))
            {
                $data['errors'] = $menu_update;
            }
            else
            {
                $data['success'] = $menu_update;
            }
        }
        $this->display_tpl('menus/edit', $data);
    }
} // End Welcome
