<?php defined('SYSPATH') or die('No direct script access.');

class Base extends Controller_Template {
    
    public function __construct(Request $request, Response $response) {
        parent::__construct($request, $response);
    }
    
    public function get_access()
    {
        $auth = Auth::instance();
        $user_id= $auth->get_user();
        
        $user_role_model = ORM::factory('userroles')->where('user_id', '=', $user_id)->find()->as_array();
        $user_role_id = $user_role_model['role_id'];
        
        $user_role = ORM::factory('roles')->where('id', '=', $user_role_id)->find()->as_array();
        $access = unserialize($user_role['access']);
        
        if (is_array($access))
            return $access;
        else
            return array(0);
    }
}