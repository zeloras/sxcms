<?php defined('SYSPATH') or die('No direct script access.');
class Model_Libs_Comments 
{
    
    private $_is_login = false,
            $parents  = array(),
            $children = array(),
            $comments_list = false,
            $comments_parrent_list = false,
            $settings,
            $_user_id,
            $captcha;
    
    public $module = 'core',
           $item_id = 0;
        
    function __construct($module, $item_id)
    {
        $get_settings = Helper_Public::get_settings();
        $settings = $get_settings['comments'];
        $settings['template'] = $get_settings['template'];
        $settings['redirect'] = '';
        $this->settings = $settings;
        $this->module = $module;
        $this->item_id = $item_id;
        
        $user_auth = Auth::instance();
        $user_id = $user_auth->get_user()->id;
        
        $this->captcha = new Model_Libs_Captcha;
        
        $this->_user_id = $user_id;
        $this->_is_login = $user_auth->logged_in();
        $this->_format_access($user_auth);
        
    }


    public function show_captcha()
    {
        $get_settings = $this->settings;
        $capthca_width = $get_settings['captcha_width'];
        $capthca_height = $get_settings['captcha_height'];
        $capthca_length = $get_settings['captcha_length'];

        $width = ($capthca_width > 0) ? (int)$capthca_width : 140;
        $height = ($capthca_height > 0) ? (int)$capthca_height : 80;
        $length = ($capthca_length > 0) ? (int)$capthca_length : 2;
        
        $this->captcha->setSizeImage($width, $height); 
        $this->captcha->setColorBackground(255, 255, 255); 
        $this->captcha->setFont(DOCROOT.'/application/fonts/FixSysCTT.ttf', 40, array(90, 90, 90)); 
        $this->captcha->showCaptcha($length);
    }
    
    
    public function check_captcha($captcha)
    {
        if ($this->settings['is_captcha'])
        {
            if (Session::instance()->get('token') == $captcha)
                return true;
            else 
                return false;
        }
        else
        {
            return true;
        }
    }
    
    public function check_form($data)
    {
        if (!$this->check_captcha($data['captcha']))
            $errors['captcha_false'] = true;
        if (Cookie::get('comment_timeout'))
        {
            $errors['timeout'] = true;
            $errors['time'] = $this->settings['timeout'];
        }
        if (!$this->settings['is_comment'])
            $errors['no_comment'] = true;
        if (strlen($data['text']) > $this->settings['length'])
        {
            $errors['length_size'] = true;
            $errors['length'] = $this->settings['length'];
            $errors['yousize'] = strlen($data['text']);
        }
        
        return $errors;
    }
    
    
    public function reply_form($item = 0, $parent = 0, $url = '', $module = 'core')
    {
        $cdata['comments_settings'] = array(
            'item' => $item,
            'parent' => $parent,
            'redirect' => $url,
            'module' => $module,
            'action' => $this->settings['controller'],
            'is_comment' => $this->settings['is_comment'],
            'is_comment_this' => $this->settings['is_comment_this'],
            'is_captcha' => $this->settings['is_captcha'],
            'captcha_width' => ($this->settings['captcha_width'] > 0) ? (int)$this->settings['captcha_width'] : 140,
            'captcha_height' => ($this->settings['captcha_height'] > 0) ? (int)$this->settings['captcha_height'] : 80,
            'is_auth' => $this->_is_login,
            'recaptcha' => '',
        );
        return $this->_fetch_public('comments/ajax_form', $cdata);
    }
    
    public function add($data)
    {
        if ($this->check_captcha($data['captcha']))
        {
            if ($data['item_id'] > 0 && $this->settings['is_comment'] && $this->settings['is_comment_this'] && !Cookie::get('comment_timeout'))
            {
                $user_id = $this->_is_login;

                $user_data = ORM::factory('users')->where('id', '=', $user_id)->find();
                if ($user_data->id > 0)
                {
                    $user_id = $user_data->id;
                    $username = $user_data->username;
                    $email = $user_data->email;
                }
                else
                {
                    $user_id = 0;
                    $username = $data['username'];
                    $email = $data['email'];
                }
                
                if ($this->settings['timeout'] > 0)
                    Cookie::set('comment_timeout', '1', time() + ($this->settings['timeout'] * 60));
                
                $user_agent = Request::$user_agent;
                $user_ip = Request::$client_ip;
                
                if ($this->settings['is_status'])
                    $status = 0;
                else
                    $status = 1;
                
                if ($this->settings['length'] > 0)
                    $text = substr($data['text'], 0, $this->settings['length']);
                else
                    $text = $data['text'];
                
                $model_insert = new Model_Comments;
                
                $model_insert->user_id = $user_id;
                $model_insert->user_name = $username;
                $model_insert->module = $data['module'];
                $model_insert->user_mail = $email;
                $model_insert->user_ip = $user_ip;
                $model_insert->agent = $user_agent;
                $model_insert->rate = 1;
                $model_insert->text = $text;
                $model_insert->item_id = $data['item_id'];
                $model_insert->parent = $data['parrent'];
                $model_insert->status = 1;
                $model_insert->date = time();
                
                $insert = $model_insert->save();

                if ($insert)
                {
                   Request::initial()->redirect($data['redirect']);
                }
            }
        }
        Request::initial()->redirect($data['redirect']);
    }
    
    public function build()
    {
        $comments = ORM::factory('comments')
                ->where('item_id', '=', $this->item_id)
                ->where('status', '=', 1)
                ->where('module', '=', $this->module)
                ->find_all();
        $this->_reach($comments);
        $data['comment_list'] = $this->comments_list;
        $settings['recaptcha'] = '';
        $data['comments_settings'] = $this->settings;
        $data['comments_settings']['module'] = $this->module;
        $data['comments_settings']['item_id'] = $this->item_id;
        
        return $this->_fetch_public('comments/view', $data);
    }
    
    
    private function _reach($comments)
    {
        foreach ($comments as $comment)
        {
         
            if ($comment->parent == 0)
            {
                $this->parents[$comment->id][] = $comment;
            }
            else
            {
                $this->children[$comment->parent][] = $comment;
            }
        }
        return $this->print_comments();
    }
    
    
    
    private function format_comment($comment, $depth)
    {
    $this->comments_parrent_list = '';
        $data_array = array(
            'id' => $comment->id,
            'username' => $comment->user_name,
            'rate' => $comment->rate,
            'module' => $comment->module,
            'text' => $comment->text,
            'item_id' => $comment->item_id,
            'parent_id' => $comment->parent,
            'date' => $comment->date,
            'avatar' => md5(strtolower(trim($comment->user_mail))),
            'margin' => $depth * 10,
            'is_comment' => $this->settings['is_comment'],
            'is_comment_this' => $this->settings['is_comment_this'],
            'is_captcha' => $this->settings['is_captcha'],
        );
        
        $this->comments_list .= $this->_fetch_public('comments/item', $data_array);
        
    }
    
    private function print_parent($comment, $depth = 0)
    {
        foreach ($comment as $c)
        {
            $this->format_comment($c, $depth);

            if (isset($this->children[$c->id]))
            {
                $this->print_parent($this->children[$c->id], $depth + 1);
            }
        }
    }

    private function print_comments()
    {
        foreach ($this->parents as $c)
        {
            $this->print_parent($c);
        }
    }
    
    private function _format_access($user_auth = false)
    {
        switch ($this->settings['user']) {
            case 0:
                $this->settings['is_comment'] = false;
            break;
        
            case 1:
                if ($user_auth)
                    $this->settings['is_comment'] = true;
                else
                    $this->settings['is_comment'] = false;
            break;
        
            case 2:
                if (!$user_auth)
                    $this->settings['is_comment'] = true;
                else
                    $this->settings['is_comment'] = false;
            break;
        
            case 3:
                $this->settings['is_comment'] = true;
            break;

            default:
                $this->settings['is_comment'] = true;
            break;
        }
        
        switch ($this->settings['captcha']) {
            case 0:
                $this->settings['is_captcha'] = false;
            break;
        
            case 1:
                if ($user_auth)
                    $this->settings['is_captcha'] = true;
                else
                    $this->settings['is_captcha'] = false;
            break;
        
            case 2:
                if (!$user_auth)
                    $this->settings['is_captcha'] = true;
                else
                    $this->settings['is_captcha'] = false;
            break;
        
            case 3:
                $this->settings['is_captcha'] = true;
            break;

            default:
                $this->settings['is_captcha'] = true;
            break;
        }
        
        switch ($this->settings['status']) {
            case 0:
                $this->settings['is_status'] = false;
            break;
        
            case 1:
                if ($user_auth)
                    $this->settings['is_status'] = true;
                else
                    $this->settings['is_status'] = false;
            break;
        
            case 2:
                if (!$user_auth)
                    $this->settings['is_status'] = true;
                else
                    $this->settings['is_status'] = false;
            break;
        
            case 3:
                $this->settings['is_status'] = true;
            break;

            default:
                $this->settings['is_status'] = true;
            break;
        }
        switch ($this->module) {
            case 'page':
                $model = ORM::factory('pages')->where('id', '=', $this->item_id)->select('comment')->find();
                $this->settings['is_comment_this'] = ($model->comment) ? true : false;
            break;
        
            default:
                $this->settings['is_comment_this'] = true;
            break;
        }
    }
    
    
    private function _fetch_public($file = '', $array = array()) {
        return View::factory('public/'.$this->settings['template'].'/'.$file, $array);
    }
    
}
