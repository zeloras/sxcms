<?php defined('SYSPATH') or die('No direct script access.');

class Model_Pages extends ORM
{
    protected $_table_name = 'pages';
    
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
                'category' => array(
                    array('not_empty'),
                    array('numeric'),
                ),
                'url' => array(
                    array('not_empty'),
                    array('max_length', array(':value', 200)),
                    array(array($this, 'check_url'), array(':validation')),
                ),
                'short_text' => array(
                    array('not_empty'),
                    array('max_length', array(':value', 1000)),
                ),
                'text' => array(
                    array('not_empty'),
                ),
                'meta_keywords' => array(
                    array('max_length', array(':value', 255)),
                ),
                'meta_description' => array(
                    array('max_length', array(':value', 500)),
                ),
                'template' => array(
                    array('max_length', array(':value', 255)),
                ),
                //'site_template' => array(
                //    array('max_length', array(':value', 255)),
                //),
                'status' => array(
                    array('not_empty'),
                    array('numeric'),
                ),
        );    
    }
    
    public function check_url($validation)
    {
        $category = $validation['category'];
        $url = $validation['url'];
        $pid = $validation['id'];
        $check_url = ORM::factory('pages');
        $check_url->where('category', '=', $category);
        if ($pid > 0)
        $check_url->where('id', '!=', $pid);
        $check_url_count= $check_url->where('url', '=', $url)->count_all();
        if ($check_url_count > 0)
            return false;
        else
            return true;
    }
}
