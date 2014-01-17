<?php defined('SYSPATH') or die('No direct script access.');

class Model_Menus extends ORM
{
    protected $_table_name = 'menus';
    
    public function rules()
    {
        return array(
            'id' => array(
                array('max_length', array(':value', 30)),
            ),
            'title' => array(
                array('not_empty'),
                array('max_length', array(':value', 255)),
            ),
            'name' => array(
                array('not_empty'),
                array('max_length', array(':value', 255)),
                array(array($this, 'check_name'), array(':validation')),
            ),
            'description' => array(
                array('max_length', array(':value', 500)),
            ),
            'template' => array(
                array('max_length', array(':value', 255)),
            ),
        );    
    }
    
    public function check_name($validation)
    {
        $name = $validation['name'];
        $mid = $validation['id'];
        $menu_model = ORM::factory('menus')->where('name', '=', $name);
        if ($mid > 0)
        $menu_model->where('id', '!=', $mid);
        $menu_count = $menu_model->count_all();
        if ($menu_count > 0)
            return FALSE;
        else
            return TRUE;
    }
}
