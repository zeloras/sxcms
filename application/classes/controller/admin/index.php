<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Index extends Controller_Admin_Language {
    
    
    public function index_admin()
    {
        $last_pages = ORM::factory('pages')->order_by('update')->limit(5)->find_all();
        foreach ($last_pages as $key => $pg)
            $category[$key] = Helper_Common::get_category_info($pg->category);
        
        $data['count_pages'] = ORM::factory('pages')->count_all();
        $data['count_categorys'] = ORM::factory('categorys')->count_all();
        $data['count_modules'] = ORM::factory('modules')->count_all();
        $data['count_widgets'] = ORM::factory('widgets')->count_all();
        $data['sysinfo'] = Helper_Admin::get_system_info();
        //$data['count_comments'] = ORM::factory('comments')->count_all();
        $data['pages'] = $last_pages;
        $data['category'] = $category;
        $this->display_tpl('index/home', $data);
    }
}