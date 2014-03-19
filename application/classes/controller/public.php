<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Public extends Controller_Public_Category {
    
    public $template_in = 'default',
           $language_system = "en";
    
    public function __construct(Request $request, Response $response) {
            parent::__construct($request, $response);
            if (ISINSTALL)
            {
                $settings = ORM::factory('settings')->find()->as_array();
                $settings_global = unserialize($settings['general']);
            }
            I18n::lang($settings_global['language']);
            $this->language_system = I18n::$lang;
        }
        
	public function action_route()
	{
            $url_segment_url = $this->request->param('route');
            $url_segment = explode('/', $this->request->param('route'));
            $size = (sizeof($url_segment) > 0 && $url_segment_url != '') ? sizeof($url_segment) : 0;
            
            if (!ISINSTALL)
            {
                $install_system = $this->check_issystem_install('index');
                if (!is_object($install_system))
                    return $install_system;
            }
            
            $offset = $size;
            if ($size > 0)
                $cat_check = ORM::factory('categorys')->where('url', '=', $url_segment[0])->where('parent_id', '=', 0)->count_all();
            else
                $cat_check = 0;
            if ($offset > 0 && $cat_check > 0)
            {
                $cat_item_id = array(0);
                for ($i = 0; $i < $size; $i++)
                {
                    $id = $cat_item_id[sizeof($cat_item_id)-1];

                    if (strlen($url_segment[$i]) > 1)
                    {
                        $categorys_query = ORM::factory('categorys');
                        if ($url_segment[$i] === 'page_num')
                        {
                            $offset = $i;
                            break;
                        }

                        if ($id > 0)
                        {
                            $categorys_query->where('parent_id', '=', $id);
                        }
                        else
                        {
                            $categorys_query->where('parent_id', '=', 0);
                        }
                        $categorys_query->where('url', '=', $url_segment[$i]);
                        $categorys_query->select('id');
                        $ct = $categorys_query->find_all();
                        
                        if (@sizeof($ct[0]->id) > 0)
                        {
                            $cat_item_id[] = $ct[0]->id;
                            $page_segment = '/'.$url_segment[$i];
                        }
                        else
                        {
                            $cat_path = Helper_Common::get_category_path($id);
                            $page_query = ORM::factory('pages')->
                                    where('cat_url', '=', $cat_path)->
                                    where('url', '=', $url_segment[$i])->
                                    where('category', '=', $id)->
                                    find_all();
                            if (@sizeof($page_query[0]->id) > 0)
                            {
                                $cat_item_id[]['page'] = $page_query[0]->id;
                            }
                            else
                            {
                                $this->page_modules();
                                return;
                            }
                        }
                    }
                }
                $last_category = $cat_item_id[sizeof($cat_item_id)-1];
                $last_page = (is_array($last_category)) ? $last_category['page'] : 0;
                
                if ($last_category > 0 && !is_array($last_category))
                { 
                    $categorys_query_last = ORM::factory('categorys');
                    $categorys_query_last->where('id', '=', $last_category);
                    $categorii = $categorys_query_last->find_all();
                    if ($categorii[0]->id > 0)
                    {
                        
                        $data['breadcrumbs'] = Helper_Public::breadcrumbs('category', 
                            array(
                                'cid' => $categorii[0]->id,
                            ));
                        
                        $categorys_query_last = ORM::factory('categorys');
                        $categorys_query_last->where('parent_id', '=', $categorii[0]->id);
                        $cats = $categorys_query_last->find_all();
                        
                        $pages_query_last = ORM::factory('pages');
                        $pages_query_last->where('category', '=', $categorii[0]->id);
                        $pages = $pages_query_last->find_all();
                        $data['cat_data'] = $categorii[0];
                        $data['cats'] = $cats;
                        $data['pages'] = $pages;
                    }
                    else
                    {
                        $data['no_this_cat'] = true;
                    }
                    $this->category($data);
                }
                
                if ($last_page > 0)
                {
                    $page_query = ORM::factory('pages');
                    $page_query->where('id', '=', $last_page);
                    $page = $page_query->find_all();
                    $data['page'] = $page;
                    
                    $comments_lib = new Model_Libs_Comments('page', $page[0]->id);
                    $data['comments_list'] = $comments_lib->build();
                    
                    $data['breadcrumbs'] = Helper_Public::breadcrumbs('page', 
                            array(
                                'cid' => $page[0]->category,
                                'title' => $page[0]->title,
                                'url' => $page[0]->cat_url.$page[0]->url,
                            ));
                    $this->page($data);
                }
                
            }
            else
            {
                if (preg_match('/^category/', $url_segment_url))
                {
                    $categorys_query_last = ORM::factory('categorys');
                    $categorys_query_last->where('parent_id', '=', 0);
                    $categorys = $categorys_query_last->find_all();
                    
                    $pages_query_last = ORM::factory('pages');
                    $pages_query_last->where('category', '=', 0);
                    $pages = $pages_query_last->find_all();
                    
                    $data['breadcrumbs'] = Helper_Public::breadcrumbs('category_list');
                    $data['cat_data'] = (object) array('title' => 'Категории', 'meta_keywords' => '', 'meta_description' => '');
                    $data['cats'] = $categorys;
                    $data['pages'] = $pages;
                    $this->category($data);
                }
                else
                {
                    $url_segment_url = (strlen($url_segment_url) > 0) ? $url_segment_url : '/';
                    $pages_query_last = ORM::factory('pages');
                    $pages_query_last->where('category', '=', 0);
                    $pages_query_last->where('url', '=', $url_segment_url);
                    $page = $pages_query_last->find_all();
                    if ($page->count() < 1)
                    {
                        $this->page_modules();
                        return;
                    }

                    $data['page'] = $page;
                    $bread_type = ($url_segment_url == '/') ? 'index' : 'nocat';
                    
                    $comments_lib = new Model_Libs_Comments('page', $page[0]->id);
                    $data['comments_list'] = $comments_lib->build();
                    
                    $data['breadcrumbs'] = Helper_Public::breadcrumbs($bread_type, 
                        array(
                            'cid' => $page[0]->category,
                            'title' => $page[0]->title,
                            'url' => $page[0]->cat_url.$page[0]->url,
                        ));
                    $this->page($data);
                }
            }

	}
        
        
        private function page_modules()
        {
            $url_segment = $this->request->param('route');
            preg_match_all("@^.*@", $url_segment, $preg_com);
            $com_exp = explode('/', $preg_com[0][0]);
            $module_name = $com_exp[0];
            
            $check_module = ORM::factory('modules')->where('dir', '=', $module_name)->where('active', '=', 1)->where('site', '=', 1)->count_all();
            if ($check_module > 0)
            {
                $module_name_load = "Modules_".ucfirst($module_name)."_Index";
                $module_load_action = ($com_exp[1] != "") ? $com_exp[1] : 'index';
                if (file_exists(DOCROOT.'/application/classes/modules/'.$module_name.'/index.php'))
                {
                    $load_model = new $module_name_load();
                    if (method_exists($load_model, $module_load_action))
                    {
                        $check_method = new ReflectionMethod($load_model, $module_load_action);
                        $check_method = $check_method->isPublic();
                        if ($check_method)
                        {
                            Kohana::add_path_module($module_name);
                            $get_data = $load_model->$module_load_action();
                            $this->display_tpl($get_data['template'], $get_data['data'], $get_data['metategs'], 'mod', $module_name);
                        }
                        else
                        {
                            return $this->display_error('404');
                        }
                    }
                    else
                    {
                        return $this->display_error('404');
                    }
                }
                else
                {
                    return $this->display_error('404');
                }
            }
            else
            {
                return $this->display_error('404');
            }
        }
        
        public function display_tpl($template, $data = array(), $metategs = array(), $type = 'com', $module = false)
        {
            $settings = ORM::factory('settings')->find()->as_array();
            $settings_general = unserialize($settings['general']);
            $settings_seo = unserialize($settings['seo']);
            $get_settings = Helper_Public::get_settings();
            $this->template_in = $get_settings['template'];
                        
            if ($settings_general['disable_site'] == 0)
                return $this->display_error('site_disable');
            
            $metategs_put = array(
                'base_title' => $settings_general['site_name'],
                'base_keywords' => $settings_seo['keywords'],
                'description' => (strlen($metategs['description']) > 2) ? $metategs['description'] : $settings_seo['description'],
                'title' => $metategs['title'],
                'keywords' => $metategs['keywords']
            );
            
            $this->template->metatags = View::factory('public/'.$this->template_in.'/meta_tags', $metategs_put);
            switch ($type) {
                case 'com':
                    $this->template->content = View::factory('public/'.$this->template_in.'/'.$template, $data);
                break;
            
                case 'mod':
                    $this->template->content = View::factory('modules_find/'.$module.'/template/'.$template, $data);
                break;
            }
        }
        
        public function display_error($template)
        {
            switch ($template) {
                case '404':
                    $metategs = array(
                        'title' => __('404 Error'),
                        'keywords' => '',
                        'description' => '',
                    );
                break;
            
                case 'site_disable':
                    $metategs = array(
                        'title' => __('Site Disable'),
                        'keywords' => '',
                        'description' => '',
                    );
                break;
            }
            $this->template->metatags = View::factory('public/'.$this->template_in.'/meta_tags', $metategs);
            $this->template->content = View::factory('public/'.$this->template_in.'/'.$template);
        }

} // End Welcome
