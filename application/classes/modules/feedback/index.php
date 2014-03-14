<?php defined('SYSPATH') or die('No direct script access.');

class Modules_Feedback_Index {
    public function index()
    {
        $load_settings = ORM::factory('modules')->where('dir', '=', 'feedback')->where('site', '=', 1)->where('active', '=', 1)->find();
        $data['settings'] = unserialize($load_settings->settings);
        $metategs = array('title' => $load_settings->name);
        if (Arr::get($_POST, 'submit_this_form'))
        {
            $config = Kohana::$config->load('email');
            Email::connect($config);
            $post = Validation::factory($_POST)
                    ->rule('email', 'email')
                    ->rule('title', 'not_empty')
                    ->rule('message', 'not_empty')
                    ->rule('message', 'min_length', array(':value', '10'))
                    ->rule('message', 'max_length', array(':value', $data['settings']['message_length']));
            $data['process_send'] = true;
            if ($post->check())
            {
                $to = $data['settings']['email'];
                $subject = Arr::get($_POST, 'title');
                $from = Arr::get($_POST, 'email');
                $message = Arr::get($_POST, 'message');
                $html = ($data['settings']['message_format'] == 'html') ? true : false;
                
                $data['message_send'] = Email::send($to, $from, $subject, $message, $html);
            }
            else
            {
                $data['errors'] = $post->errors();
            }
        }
        return $this->display_tpl('public/index', $data, $metategs);
    }
    
    private function display_tpl($template, $data = array(), $metategs = array())
    {
        return array(
            'template' => ($template) ? $template : "index",
            'data' => $data,
            'metategs' => $metategs,
        );
    }
} // End Welcome
