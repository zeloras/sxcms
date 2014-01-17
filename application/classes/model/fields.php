<?php defined('SYSPATH') or die('No direct script access.');

class Model_Fields extends ORM
{
    protected $_table_name = 'additional_fields';
    
    public function rules()
    {
        return array(
            'id' => array(
                array('max_length', array(':value', 11)),
            ),
            'title' => array(
                array('not_empty'),
                array('max_length', array(':value', 255)),
            ),
            'csv' => array(
                array('not_empty'),
                array('max_length', array(':value', 255)),
                array(array($this, 'check_name'), array(':validation')),
            ),
            'category' => array(
                array('not_empty'),
                array('max_length', array(':value', 1000)),
            ),
            'active' => array(
                array('not_empty'),
                array('max_length', array(':value', 1)),
            ),
        );    
    }
    
    public function check_name($validation)
    {
        $csv = $validation['csv'];
        $fid = $validation['id'];
        $fields_model = ORM::factory('fields')->where('csv', '=', $csv);
        if ($fid > 0)
        $fields_model->where('id', '!=', $fid);
        $fields_count = $fields_model->count_all();
        if ($fields_count > 0)
            return FALSE;
        else
            return TRUE;
    }
}
