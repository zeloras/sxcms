<?php defined('SYSPATH') or die('No direct script access.');

class Modules_Auth_Widgets 
{
    
    public function auth_block()
    {
        return $this->fetch_tpl('auth', 'block_auth', array('title' => 'Hello test'));
    }
    
    private function fetch_tpl($module, $template, $data = array())
    {
        return View::factory('module_widget/'.$module.'/template/widgets/'.$template, $data);
    }
    
} // End Welcome
