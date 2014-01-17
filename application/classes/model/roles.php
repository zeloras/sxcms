<?php defined('SYSPATH') or die('No direct script access.');

class Model_Roles extends ORM
{
    protected $_table_name = 'roles';
    
  public function rules()
    {
        return array(
                'id' => array(
                    array('max_length', array(':value', 11)),
                ),
                'title' => array(
                    array('not_empty'),
                    array('max_length', array(':value', 100)),
                    array('min_length', array(':value', 2)),
                    array(array($this, 'check_title'), array(':validation')),
                ),
                'name' => array(
                    array('not_empty'),
                    array('max_length', array(':value', 32)),
                    array('min_length', array(':value', 2)),
                    array(array($this, 'check_name'), array(':validation')),
                ),
        );    
    }
    
    public function check_name($validation)
    {
        $name = $validation['name'];
        $rid = $validation['id'];
        $check_name = ORM::factory('roles');
        $check_name->where('name', '=', $name);
        if ($rid > 0)
        $check_name->where('id', '!=', $rid);
        $check_name_count= $check_name->where('name', '=', $name)->count_all();
        if ($check_name_count > 0)
            return false;
        else
            return true;
    }
    
    public function check_title($validation)
    {
        $title = $validation['title'];
        $rid = $validation['id'];
        $check_title = ORM::factory('roles');
        $check_title->where('title', '=', $title);
        if ($rid > 0)
        $check_title->where('id', '!=', $rid);
        $check_title_count= $check_title->where('title', '=', $title)->count_all();
        if ($check_title_count > 0)
            return false;
        else
            return true;
    }
}
