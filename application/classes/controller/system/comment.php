<?php defined('SYSPATH') or die('No direct script access.');

class Controller_System_Comment extends Base {
    private $comment_lib = false;
    
    function __construct(\Request $request, \Response $response) {
        parent::__construct($request, $response);
    }

    public function post_comment() {
        
        $comment_array = array(
            'item_id' => (int) Arr::get($_POST, 'comment_item_id'),
            'parrent' => (int) Arr::get($_POST, 'comment_parent_id'),
            'module' => Arr::get($_POST, 'comment_module'),
            'username' => Arr::get($_POST, 'comment_username'),
            'email' => Arr::get($_POST, 'comment_email'),
            'text' => Arr::get($_POST, 'comment_text'),
            'redirect' => Arr::get($_POST, 'comment_redirect'),
            'captcha' => Arr::get($_POST, 'captcha'),
        );
        
        $comment_lib = new Model_Libs_Comments($comment_array['module'], $comment_array['item_id']);
        $comment_lib->add($comment_array);
    }
    
    
    public function commentsReply()
    {
        $item_id = Arr::get($_GET, 'item');
        $parent = Arr::get($_GET, 'parent');
        $url = Arr::get($_GET, 'url');
        $module = Arr::get($_GET, 'module');
        $comment_lib = new Model_Libs_Comments($module, $item_id);
        echo $comment_lib->reply_form($item_id, $parent, $url, $module);
    }
    
    public function captchaCheck()
    {
        $comment_lib = new Model_Libs_Comments('core', 0);
        $captcha = Arr::get($_POST, 'captcha');
        if ($comment_lib->check_captcha($captcha))
            echo "Ok";
        else
            echo "Err";
    }
    
    public function commentsCheck()
    {
        $data['captcha'] = Arr::get($_POST, 'captcha');
        $data['text'] = Arr::get($_POST, 'text');
        
        $comment_lib = new Model_Libs_Comments(Arr::get($_POST, 'module'), Arr::get($_POST, 'item_id'));
        
        $errors = $comment_lib->check_form($data);
        echo json_encode($errors);
    }

    public function captcha()
    {
        $comment_lib = new Model_Libs_Comments('core', 0);
        $image = $comment_lib->show_captcha();
        echo $image;
    }

} // End Welcome
