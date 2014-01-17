<?php defined('SYSPATH') or die('No direct script access.');

class Model_Categorys extends ORM
{
    protected $_table_name = 'categorys';
    
    public function rules()
    {
        return array(
                'id' => array(
                    array('max_length', array(':value', 255)),
                ),
                'title' => array(
                    array('not_empty'),
                    array('max_length', array(':value', 200)),
                ),
                'url' => array(
                    array('not_empty'),
                    array('max_length', array(':value', 255)),
                    array(array($this, 'check_url'), array(':validation')),
                ),
                'parent_id' => array(
                    array('not_empty'),
                    array('numeric'),
                ),
                'description' => array(
                    array('not_empty'),
                ),
                'meta_keywords' => array(
                    array('max_length', array(':value', 255)),
                ),
                'meta_description' => array(
                    array('max_length', array(':value', 500)),
                ),
        );    
    }
    
    public function check_url($validation)
    {
        $parent_id = $validation['parent_id'];
        $url = $validation['url'];
        $category_id = $validation['id'];
        $check_url = ORM::factory('categorys');
        $check_url->where('parent_id', '=', $parent_id);
        if ((int)$category_id > 0)
        $check_url->where('id', '!=', $category_id);
        $check_url_count = $check_url->where('url', '=', $url)->count_all();
        if ($check_url_count > 0)
            return false;
        else
            return true;
    }
}
