<?php defined('SYSPATH') or die('No direct script access.');

class Modules_Feedback_Admin {
    public function index()
    {
        $settings = ORM::factory('modules')->select('settings')->where('dir', '=', 'feedback')->find()->as_array();
        $data['settings'] = unserialize($settings['settings']);
        if (Arr::get($_POST, 'submit_this_form'))
        {
            $settings_data = array(
                'email' => Arr::get($_POST, 'email'),
                'message_length' => Arr::get($_POST, 'message_length'),
                'message_format' => Arr::get($_POST, 'message_format'),
            );
            
            $settings_update = ORM::factory('modules')->where('dir', '=', 'feedback')->find();
            $settings_update->settings = serialize($settings_data);
            $settings_update->update();
            $data['success'] = true;
        }
        return $this->display_tpl('admin/index', $data);
    }
    
    private function display_tpl($template, $data = array(), $metategs = array())
    {
        return array(
            'template' => ($template) ? $template : "index",
            'data' => $data,
            'metatages' => array(),
        );
    }
} // End Welcome
