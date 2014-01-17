<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Public_Category extends Controller_Public_Page {

        public function __construct(Request $request, Response $response) {
            parent::__construct($request, $response);
        }
        
        
	public function category($data)
	{
            if (sizeof($data['cats']) > 0 || isset($data['cat_data']))
            {
                $meta_title = $data['cat_data']->title;
                $meta_keywords = $data['cat_data']->meta_keywords;
                $meta_description = $data['cat_data']->meta_description;
                $template = (strlen($data['cat_data']->template) > 1) ? $data['cat_data']->template : 'category';
                
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
            //$this->template->content = 123;
	}
        

} // End Welcome
