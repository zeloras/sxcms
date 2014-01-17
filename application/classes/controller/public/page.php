<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Public_Page extends Ropublic {

        public function __construct(Request $request, Response $response) {
            parent::__construct($request, $response);
        }
        
	public function page($data)
	{
            if (sizeof($data['page']) > 0)
            {
                $meta_title = $data['page'][0]->title;
                $meta_keywords = $data['page'][0]->meta_keywords;
                $meta_description = $data['page'][0]->meta_description;
                $template = (strlen($data['page'][0]->template) > 1) ? $data['page'][0]->template : 'page';

                $data_metategs = array(
                    'title' => $meta_title,
                    'keywords' => $meta_keywords,
                    'description' => $meta_description,
                );
                $this->display_tpl($template, $data, $data_metategs);
            }
            else
            {
                $this->display_error('404');
            }
	}
        

} // End Welcome
