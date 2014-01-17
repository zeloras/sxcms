<?php defined('SYSPATH') or die('No direct script access.');

class Model_Modules extends ORM
{
    protected $_table_name = 'modules';
    
    public function rules()
    {
        return array(
                'id' => array(
                    array('max_length', array(':value', 40)),
                ),
                'name' => array(
                    array('not_empty'),
                    array('max_length', array(':value', 200)),
                ),
                'description' => array(
                    array('not_empty'),
                    array('max_length', array(':value', 400)),
                ),
                'version' => array(
                    array('not_empty'),
                    array('max_length', array(':value', 30)),
                ),
                'author_info' => array(
                    array('max_length', array(':value', 1000)),
                ),
                'dir' => array(
                    array('not_empty'),
                    array(array($this, 'check_dir'), array(':validation')),
                    array('max_length', array(':value', 255)),
                ),
                'position' => array(
                    array('not_empty'),
                    array('numeric'),
                    array('max_length', array(':value', 40)),
                ),
                'active' => array(
                    array('max_length', array(':value', 1)),
                    array('numeric'),
                    array('not_empty'),
                ),
                'menu' => array(
                    array('max_length', array(':value', 1)),
                    array('numeric'),
                    array('not_empty'),
                ),
                'site' => array(
                    array('max_length', array(':value', 1)),
                    array('numeric'),
                    array('not_empty'),
                ),
                'date' => array(
                    array('max_length', array(':value', 13)),
                    array('not_empty'),
                    array('numeric'),
                ),
        );    
    }
    
    public function check_dir($validation)
    {
        $dir = $validation['dir'];
        $mid = $validation['id'];
        $check_dir = ORM::factory('modules');
        $check_dir->where('dir', '=', $dir);
        if ($mid > 0)
        $check_dir->where('id', '!=', $mid);
        $check_dir_count = $check_dir->count_all();
        if ($check_dir_count > 0)
            return false;
        else
            return true;
    }
}
