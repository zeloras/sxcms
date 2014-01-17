<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Auth extends Controller_Admin_Categorys {
	public function admin_auth()
	{
            $data = array();
            $url_segment = $this->request->param('route');
            $auth = Auth::instance();
            $access = $this->get_access();
            if (!$auth->logged_in() && !in_array(71, $access))
            {
                if ($url_segment != 'auth')
                {
                    Request::initial()->redirect('/admin/auth');
                }
            }
            else
            {
                if ($url_segment == 'auth/logout')
                {
                    $auth->logout();
                    Request::initial()->redirect('/admin/auth');
                }
                
                if ($url_segment == 'auth')
                    Request::initial()->redirect('/admin');
                
            }

            if (Arr::get($_POST, 'submit_this_form'))
            {
                $auth_try = ORM::factory('admin_auth')->admin_auth();
                if ($auth_try)
                {
                    Request::initial()->redirect('/admin');
                }
                else
                {
                    $data['Errors'] = true;
                }
            }
            
            $this->display_tpl('auth/auth', $data);
	}
        

} // End Welcome
