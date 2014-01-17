<?php defined('SYSPATH') or die('No direct script access.');

class Model_Admin_Auth extends ORM
{
    protected $_table_name = 'users';
    
    public function admin_auth()
    {
        $auth = Auth::instance();
        $login = Arr::get($_POST, 'username');
        $password = Arr::get($_POST, 'password');
        $remember = (Arr::get($_POST, 'remember')) ? TRUE : FALSE;

        $auth = $auth->login($login, $password, $remember);
        if ($auth)
        {
            $access = $this->get_access();
            if (in_array(71, $access))
                $end = true;
            else
                $end = false;
        }
        else
        {
            $end = false;
        }
        return $end;
    }
    
    private function get_access()
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
