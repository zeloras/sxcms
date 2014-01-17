<?php defined('SYSPATH') or die('No direct script access.');

class Model_Widgets extends ORM
{
    protected $_table_name = 'widgets';
    
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
            'type' => array(
                array('not_empty'),
                array('max_length', array(':value', 70)),
            ),
            'module' => array(
                array('max_length', array(':value', 500)),
            ),
            'position' => array(
                array('not_empty'),
                array('max_length', array(':value', 20)),
            ),
            'active' => array(
                array('not_empty'),
                array('max_length', array(':value', 1)),
            ),
            'date' => array(
                array('not_empty'),
                array('max_length', array(':value', 13)),
                array('min_length', array(':value', 10)),
            ),
        );    
    }
    
    public function check_name($validation)
    {
        $name = $validation['name'];
        $mid = $validation['id'];
        $widget_model = ORM::factory('widgets')->where('name', '=', $name);
        if ($mid > 0)
        $widget_model->where('id', '!=', $mid);
        $widget_count = $widget_model->count_all();
        if ($widget_count > 0)
            return FALSE;
        else
            return TRUE;
    }
}
