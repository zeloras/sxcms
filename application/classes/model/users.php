<?php defined('SYSPATH') or die('No direct script access.');

class Model_Users extends ORM
{
    protected $_table_name = 'users';
    
    public function rules()
    {
        return array(
                'id' => array(
                    array('max_length', array(':value', 255)),
                ),
                'username' => array(
                    array('not_empty'),
                    array('max_length', array(':value', 200)),
                    array('min_length', array(':value', 3)),
                ),
                'email' => array(
                    array('not_empty'),
                    array('email'),
                    array(array($this, 'check_email'), array(':validation')),
                ),
                'password' => array(
                    array('not_empty'),
                    array('max_length', array(':value', 90)),
                    array('min_length', array(':value', 5)),
                ),
        );    
    }
    
    public function check_email($validation)
    {
        $email = $validation['email'];
        $uid = $validation['id'];
        $check_email = ORM::factory('users');
        $check_email->where('email', '=', $email);
        if ($uid > 0)
        $check_email->where('id', '!=', $uid);
        $check_email_count= $check_email->where('email', '=', $email)->count_all();
        if ($check_email_count > 0)
            return false;
        else
            return true;
    }
}
