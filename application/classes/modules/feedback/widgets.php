<?php defined('SYSPATH') or die('No direct script access.');

class Modules_Feedback_Widgets {
    public function test2()
    {
        return $this->fetch_tpl('feedback', 'test_tpl', array('title' => 'Hello test'));
    }
    
    private function fetch_tpl($module, $template, $data = array())
    {
        return View::factory('module_widget/'.$module.'/template/widgets/'.$template, $data);
    }
    
} // End Welcome
