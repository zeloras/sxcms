<?php defined('SYSPATH') or die('No direct script access.');

class Modules_Auth_Index {
    public function index()
    {
        return Request::initial()->redirect('/auth/login');
    }
    
    public function login()
    {
        $model_auth = Auth::instance();
        if (!$model_auth->logged_in())
        {
            if (Arr::get($_POST, 'submit_this_login'))
            {
                $auth_try = ORM::factory('sxmodule_auth_auth')->auth_login();
                if ($auth_try)
                {
                    Request::initial()->redirect('/');
                }
                else
                {
                    $data['Errors'] = true;
                }
            }
        }
        else
            return Request::initial()->redirect('/');
        return $this->display_tpl('public/index', $data, $metategs);
    }
    
    public function registration()
    {
        $model_auth = Auth::instance();
    }

    public function logout()
    {
        Auth::instance()->logout();
        return Request::initial()->redirect('/');
    }

    private function display_tpl($template, $data = array(), $metategs = array())
    {
        return array(
            'template' => ($template) ? $template : "index",
            'data' => $data,
            'metategs' => $metategs,
        );
    }
} // End Welcome
