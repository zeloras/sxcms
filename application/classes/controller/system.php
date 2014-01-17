<?php defined('SYSPATH') or die('No direct script access.');

class Controller_System extends Controller_System_Comment {
        public $template = 'system/blank';
        
	public function action_route()
	{
            $url_segment = $this->request->param('route');
            $url_explode = explode('/', $url_segment);
            switch ($url_explode[0])
            {
                case 'showfile':
                    $this->showFile($url_segment);
                break;
            
                case 'captcha':
                    $this->captcha();
                break;
            
                case 'comment_reply':
                    $this->commentsReply();
                break;
            
                case 'comment_check':
                    $this->commentsCheck();
                break;
            
                case 'captcha_check':
                    $this->captchaCheck();
                break;
            
                case 'post_comment':
                    $this->post_comment();
                break;
            }
	}
        
        private function showFile($data)
        {
            $explode = explode('/', $data);
            array_shift($explode);
            if (sizeof($explode) != 3)
            {
                $this->template->content = 'Error! Wrong path.';
                return false;
            }
            $tempdir_array = array(
                'admin' => 'templates/admin',
                'public' => 'templates/public',
            );
        
            $dir_array = array(
                'font' => '/css/font/',
                'scripts' => '/js/',
                'images' => '/css/img/',
            );
            
            $file_path = $_SERVER['DOCUMENT_ROOT'].'/'.$tempdir_array[$explode[0]].$dir_array[$explode[1]].$explode[2];
            if (file_exists($file_path))
            {
                $this->template->content = file_get_contents($file_path);
            }
            else
            {
                var_dump($file_path);
                $this->template->content = 'Error! Wrong file.';
            }
        }

} // End Welcome
