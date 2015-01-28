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
    
    public function check_issystem_install($action = 'admin')
    {
        $install_folder = 'application/classes/controller/install';
        if (file_exists($install_folder) && is_dir($install_folder))
        {
            $current_url = stripcslashes(preg_replace('@^install\/|^install@', '', Request::current()->uri()));
            $install_template_dir = preg_match("@\/install\/templates\/*@", $current_url);
            if ($current_url != '' && $current_url != 'step1' && $current_url != 'step2' && !$install_template_dir)
                Request::current()->redirect('/install');
            
            if ($action != 'admin')
            {
                $current_url = ($current_url == '') ? 'index' : $current_url;
                $load_install_model = new Controller_Install_Install();
                if (!$install_template_dir)
                    return $load_install_model->$current_url();
            }
        }
        else
        {
            return array('install' => false);
        }
    }
}