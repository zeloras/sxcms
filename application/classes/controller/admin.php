<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller_Admin_Additionalfields {
        private $is_auth_user = false,
                $is_auth_role = false;
        private $access_code = array();
        public $language_system = "en",
               $texteditor_system = "elrte",
               $system_username = array();


        public function __construct(\Request $request, \Response $response) {
            parent::__construct($request, $response);
            $settings = ORM::factory('settings')->find()->as_array();
            $settings_global = unserialize($settings['general']);
            I18n::lang($settings_global['language']);
            $this->texteditor_system = $settings_global['text_editor'];
            $this->access_code = $this->get_access();
            $this->access_code = (is_array($this->access_code)) ? $this->access_code : array(0);
            $this->language_system = I18n::$lang;
            $this->system_username = Auth::instance()->get_user();
        }


        public function action_route()
	{
            $url_segment = $this->request->param('route');
            $auth = Auth::instance();
            $this->is_auth_user = $auth->logged_in();
            $this->is_auth_role = (in_array(71, $this->access_code)) ? true : false;
                        
            View::bind_global('is_auth_user', $this->is_auth_user);
            View::bind_global('is_auth_role', $this->is_auth_role);
            if (!$this->is_auth_user || !$this->is_auth_role)
            {
                   $this->admin_auth(); 
            }
            else
            {
                if (preg_match("/^auth/", $url_segment))
                {
                    $this->admin_auth();
                }
                else
                {
                    $this->routes($url_segment);
                }
                
                if (strlen($url_segment) < 1)
                    $this->index_admin();
            }
            
            
	}
        
        private function menu_generate()
        {
            $modules_get = ORM::factory('modules')->where('menu', '=', 1)->select('name', 'dir')->find_all();

            foreach ($modules_get as $mod)
                $data_menu['menu_ext']['extra'][] = array('title' => Kohana::i18n ('module', $mod->id, 'name', $mod->dir, $mod->name), 'url' => '/admin/'.$mod->dir);

            $data_menu['menus'] = array(
                    array('title' =>  __("Home"), 'class' => 'active', 'caret' => '', 'url' => '/admin/', 'icon' => 'icon-home'),
                    array('title' => __("Components"), 'class' => 'dropdown', 'caret' => 'caret', 'url' => 'javascript://', 'icon' => 'icon-th', 
                        'under' => array(
                                array('title' => __("Comments"), 'url' => '/admin/comments'),
                                array('title' => __("Categories"), 'url' => '/admin/categorys'),
                                array('title' => __("Additional fields"), 'url' => '/admin/additional_fields'),
                                array('title' => __("Menu"), 'url' => '/admin/menus'),
                                array('title' => __("Users"), 'url' => '/admin/users'),
                                array('title' => __("Roles"), 'url' => '/admin/roles'),
                            ),
                        ),
                    array('title' => __("Pages"), 'class' => '', 'caret' => '', 'url' => '/admin/pages', 'icon' => 'icon-copy'),
                    array('title' => __("Extra"), 'class' => 'dropdown', 'caret' => 'caret', 'url' => 'javascript://', 'icon' => 'icon-cog', 'type' => 'extra',
                            'under' => array(
                                array('title' => __("Widgets"), 'url' => '/admin/widgets'),
                                array('title' => __("Languages"), 'url' => '/admin/languages'),
                                array('title' => __("Modules"), 'url' => '/admin/modules'),
                                array('title' => 'divider', 'url' => '', 'class' => 'divider'),
                            ),
                        ),
                    array('title' => __("Settings"), 'class' => '', 'caret' => '',  'url' => '/admin/settings', 'icon' => 'icon-wrench'),
                );
            
            if ($this->is_auth_user)
            {
                return View::factory('/admin/admin_menu', $data_menu);
            }
            else
            {
                return false;
            }
        }
        
        private function access_error()
        {
            $this->display_tpl('system/access_denied');
        }
        
        private function error_404()
        {
            $this->display_tpl('system/404');
        }
        
        private function routes($url_segment)
        {
            $access = $this->access_code;
            $components = array(
                    'pages',
                    'additional_fields',
                    'categorys',
                    'comments',
                    'menus',
                    'users',
                    'roles',
                    'menus_data',
                    'settings',
                    'widgets',
                    'modules',
                    'syscom',
                    'languages'
                );

            preg_match_all("@^.*@", $url_segment, $preg_com);
            $com_exp = explode('/', $preg_com[0][0]);
            $module_name = $com_exp[0];
            if (!in_array($module_name, $components))
            {
                $check_module = ORM::factory('modules')->where('dir', '=', $module_name)->where('active', '=', 1)->count_all();
                if ($check_module > 0)
                {
                    $module_name_load = "Modules_".ucfirst($module_name)."_Admin";
                    $module_load_action = ($com_exp[1] != "") ? $com_exp[1] : 'index';
                    $module_path = DOCROOT.'/application/classes/modules/'.$module_name;
                    if (file_exists($module_path.'/admin.php'))
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
                                $clip = $module_name.'_admin_'.$module_load_action;
                                if (in_array($clip, $access))
                                    $this->display_tpl($get_data['template'], $get_data['data'], $get_data['metategs'], 'mod', $module_name);
                                else
                                    $this->access_error();
                            }
                            else
                            {
                                $this->error_404();
                            }
                        }
                        else
                        {
                            $this->error_404();
                        }
                    }
                    else
                    {
                        $this->error_404();
                    }
                }
                else
                {
                    $this->error_404();
                }
            }
            if (preg_match("/^pages/", $url_segment))
            {
                $url_exp = explode('/', $url_segment);
                
                if (!isset($url_exp[1]))
                    $url_exp[1] = 'page';
                if (!isset($url_exp[2]))
                    $url_exp[2] = 0;
                
                switch ($url_exp[1]) {
                    case 'add':
                        if (in_array(12, $access))
                            $this->page_add();
                        else
                            $this->access_error();
                    break;

                    case 'edit':
                        if (in_array(13, $access))
                            $this->page_edit($url_exp[2]);
                        else
                            $this->access_error();
                    break;

                    default:
                        if (in_array(11, $access))
                            $this->page_list($url_exp[1], $url_exp[2]);
                        else
                            $this->access_error();
                    break;
                }
            }
            
            
            if (preg_match("/^comments/", $url_segment))
            {
                $url_exp = explode('/', $url_segment);
                
                if (!isset($url_exp[1]))
                    $url_exp[1] = 'comments';
                if (!isset($url_exp[2]))
                    $url_exp[2] = 0;
                
                switch ($url_exp[1]) {
                    case 'edit':
                        $this->comments_edit($url_exp[2]);
                    break;
                
                    default:
                        if (in_array(111, $access))
                            $this->comments_list($url_exp[1], $url_exp[2]);
                        else
                            $this->access_error();
                    break;
                }
            }
            
            
            if (preg_match("/^additional_fields/", $url_segment))
            {
                $url_exp = explode('/', $url_segment);
                
                if (!isset($url_exp[1]))
                    $url_exp[1] = 'additional_fields';
                if (!isset($url_exp[2]))
                    $url_exp[2] = 0;
                
                switch ($url_exp[1]) {
                    case 'add':
                        if (in_array(122, $access))
                            $this->fields_add();
                        else
                            $this->access_error();
                    break;

                    case 'edit':
                        if (in_array(123, $access))
                            $this->fields_edit($url_exp[2]);
                        else
                            $this->access_error();
                    break;

                    default:
                        if (in_array(121, $access))
                            $this->fields_list($url_exp[1], $url_exp[2]);
                        else
                            $this->access_error();
                    break;
                }
            }
            
            if (preg_match("/^categorys/", $url_segment))
            {
                $url_exp = explode('/', $url_segment);
                
                if (!isset($url_exp[1]))
                    $url_exp[1] = 'page';
                if (!isset($url_exp[2]))
                    $url_exp[2] = 0;
                
                switch ($url_exp[1]) {
                    case 'add':
                        if (in_array(22, $access))
                            $this->category_add();
                        else
                            $this->access_error();
                    break;

                    case 'edit':
                        if (in_array(23, $access))
                            $this->category_edit($url_exp[2]);
                        else
                            $this->access_error();
                    break;

                    default:
                        if (in_array(21, $access))
                            $this->category_list($url_exp[1], $url_exp[2]);
                        else
                            $this->access_error();
                    break;
                }
            }
            
            
            if (preg_match("/^menus/", $url_segment))
            {
                $url_exp = explode('/', $url_segment);
                
                if (!isset($url_exp[1]))
                    $url_exp[1] = 'page';
                if (!isset($url_exp[2]))
                    $url_exp[2] = 0;
                
                switch ($url_exp[1]) {
                    case 'add':
                        if (in_array(32, $access))
                            $this->menus_add();
                        else
                            $this->access_error();
                    break;

                    case 'edit':
                        if (in_array(33, $access))
                            $this->menus_edit($url_exp[2]);
                        else
                            $this->access_error();
                    break;

                    default:
                        if (in_array(31, $access))
                            $this->menus_list($url_exp[1], $url_exp[2]);
                        else
                            $this->access_error();
                    break;
                }
            }
            
            
            if (preg_match("/^users/", $url_segment))
            {
                $url_exp = explode('/', $url_segment);
                
                if (!isset($url_exp[1]))
                    $url_exp[1] = 'users';
                if (!isset($url_exp[2]))
                    $url_exp[2] = 0;
                
                switch ($url_exp[1]) {
                    case 'add':
                        if (in_array(52, $access))
                            $this->users_add();
                        else
                            $this->access_error();
                    break;

                    case 'edit':
                        if (in_array(53, $access))
                            $this->users_edit($url_exp[2]);
                        else
                            $this->access_error();
                    break;

                    default:
                        if (in_array(51, $access))
                            $this->users_list($url_exp[1], $url_exp[2]);
                        else
                            $this->access_error();
                    break;
                }
            }
            
            
            if (preg_match("/^roles/", $url_segment))
            {
                $url_exp = explode('/', $url_segment);
                
                if (!isset($url_exp[1]))
                    $url_exp[1] = 'roles';
                if (!isset($url_exp[2]))
                    $url_exp[2] = 0;
                
                switch ($url_exp[1]) {
                    case 'add':
                        if (in_array(52, $access))
                            $this->roles_add();
                        else
                            $this->access_error();
                    break;

                    case 'edit':
                        if (in_array(53, $access))
                            $this->roles_edit($url_exp[2]);
                        else
                            $this->access_error();
                    break;

                    default:
                        if (in_array(51, $access))
                            $this->roles_list($url_exp[1], $url_exp[2]);
                        else
                            $this->access_error();
                    break;
                }
            }
            
            
            if (preg_match("/^menus_data/", $url_segment))
            {
                $url_exp = explode('/', $url_segment);
                
                if (!isset($url_exp[1]))
                    $url_exp[1] = 0;
                if (!isset($url_exp[2]))
                    $url_exp[2] = 'page';
                if (!isset($url_exp[3]))
                    $url_exp[3] = 0;
                
                switch ($url_exp[1]) {
                    case 'add':
                        if (in_array(32, $access))
                            $this->menus_data_add($url_exp[2]);
                        else
                            $this->access_error();
                    break;

                    case 'edit':
                        if (in_array(32, $access))
                            $this->menus_data_edit($url_exp[2], $url_exp[3]);
                        else
                            $this->access_error();
                    break;

                    default:
                        if (in_array(32, $access))
                            $this->menus_data_list($url_exp[1], $url_exp[2], $url_exp[3]);
                        else
                            $this->access_error();
                    break;
                }
            }
            
            
            
            if (preg_match("/^settings/", $url_segment))
            {
                $url_exp = explode('/', $url_segment);
                
                if (!isset($url_exp[1]))
                    $url_exp[1] = 'settings';
                if (!isset($url_exp[2]))
                    $url_exp[2] = 0;
                
                switch ($url_exp[1]) {
                    default:
                        if (in_array(51, $access))
                            $this->settings($url_exp[1], $url_exp[2]);
                        else
                            $this->access_error();
                    break;
                }
            }
            
            
            
            if (preg_match("/^widgets/", $url_segment))
            {
                $url_exp = explode('/', $url_segment);
                
                if (!isset($url_exp[1]))
                    $url_exp[1] = 'widgets';
                if (!isset($url_exp[2]))
                    $url_exp[2] = 0;
                
                switch ($url_exp[1]) {
                    case 'add':
                        if (in_array(82, $access))
                            $this->widgets_add();
                        else
                            $this->access_error();
                    break;

                    case 'edit':
                        if (in_array(83, $access))
                            $this->widgets_edit($url_exp[2]);
                        else
                            $this->access_error();
                    break;

                    default:
                        if (in_array(81, $access))
                            $this->widgets_list($url_exp[1], $url_exp[2]);
                        else
                            $this->access_error();
                    break;
                }
            }
            
            
            
       if (preg_match("/^languages/", $url_segment))
            {
                $url_exp = explode('/', $url_segment);
                
                if (!isset($url_exp[1]))
                    $url_exp[1] = 'languages';
                if (!isset($url_exp[2]))
                    $url_exp[2] = 0;
                
                switch ($url_exp[1]) {
                    case 'add':
                        if (in_array(102, $access))
                            $this->languages_add();
                        else
                            $this->access_error();
                    break;

                    case 'edit':
                        if (in_array(103, $access))
                            $this->languages_edit($url_exp[2]);
                        else
                            $this->access_error();
                    break;

                    default:
                        if (in_array(101, $access))
                            $this->languages_list($url_exp[1], $url_exp[2]);
                        else
                            $this->access_error();
                    break;
                }
            }
            
            if (preg_match("/^modules/", $url_segment))
            {
                $url_exp = explode('/', $url_segment);
                
                if (!isset($url_exp[1]))
                    $url_exp[1] = 'modules';
                if (!isset($url_exp[2]))
                    $url_exp[2] = 0;
                
                switch ($url_exp[1]) {
                    case 'install':
                        if (in_array(92, $access))
                            $this->modules_install();
                        else
                            $this->access_error();
                    break;

                    case 'edit':
                        if (in_array(93, $access))
                            $this->modules_edit($url_exp[2]);
                        else
                            $this->access_error();
                    break;

                    default:
                        if (in_array(91, $access))
                            $this->modules_list($url_exp[1], $url_exp[2]);
                        else
                            $this->access_error();
                    break;
                }
            }
            
            
            
            if (preg_match("/^syscom/", $url_segment))
            {
                $url_exp = explode('/', $url_segment);
                
                switch ($url_exp[1]) {
                    case 'ajax_delete':
                        $this->ajax_delete($url_exp[2], $this->access_code);
                    break;
                
                    case 'ajax_getafields':
                        $this->ajax_additional_fields_get();
                    break;
                
                    case 'ajax_changeactive':
                        $this->ajaxChangeActive();        
                    break;
                
                    case 'getCategorys_opt':
                        $this->ajax_getCategorys_opt();
                    break;
                
                    case 'getPages_opt':
                        $this->ajax_getPages_opt($url_exp[2]);
                    break;
                
                    case 'getSystem_opt':
                        $this->ajax_getSystem_opt();
                    break;
                
                    case 'getTranslitUrl':
                        $this->ajax_translit_url();
                    break;
                    
                    case 'ajax_save_position':
                        $this->ajax_save_position($url_exp[2]);
                    break;
                
                    case 'ajax_cloud_check':
                        $this->ajaxCloudCheckConnect($url_exp[2]);
                    break;
                
                    case 'ajax_ftp_check':
                        $this->ajaxFTPCheckConnect($url_exp[2]);
                    break;
                
                    case 'ajax_ftp_save':
                        $this->ajaxFTPSaveFile($url_exp[2]);
                    break;
                
                    case 'ajax_ftp_delete':
                        $this->ajaxFTPDeleteFile($url_exp[2]);
                    break;
                
                    case 'ajax_cloud_save':
                        $this->ajaxCloudSaveFile($url_exp[2]);
                    break;
                
                    case 'ajax_cloud_delete':
                        $this->ajaxCloudDeleteFile($url_exp[2]);
                    break;
                
                    case 'load_elfinder':
                        $this->elfinder_init($url_exp[2]);
                    break;
                
                    case 'ajax_getkeywords':
                        $this->generate_keywords();
                    break;
                
                    case 'ajax_comment_update':
                        $this->ajax_comment_update($this->access_code);
                    break;
                }
            }

        }


        public function display_tpl($template, $data = array(), $metategs = array(), $type = 'com', $module = false)
        {
            $access_code = $this->access_code;
            $language = $this->language_system;
            $text_editor = $this->texteditor_system;
            $useradmin = $this->system_username->username;
            //$this->template->metatags = View::factory('admin/meta_tags', $metategs);
            
            $this->template->menu_admin_html = $this->menu_generate();
            
            $this->template->language = $language;
            $this->template->text_editor = $text_editor;
            $this->template->username = $useradmin;
            switch ($type)
            {
                case 'mod':
                $this->template->content_admin = View::factory('modules_find/'.$module.'/template/'.$template, $data)
                        ->bind('access_code', $access_code)
                        ->bind('language', $language);
                break;
            
                case 'com':
                $this->template->content_admin = View::factory('admin/'.$template, $data)
                        ->bind('access_code', $access_code)
                        ->bind('language', $language);
                break;
            }
        }
        
        public function ajax_tpl($data = array())
        {
            $access_code = $this->access_code;
            $language = $this->language_system;
            $text_editor = $this->texteditor_system;
            $useradmin = $this->system_username->username;
            
            $this->template->menu_admin_html = false;
            
            $this->template->language = $language;
            $this->template->text_editor = $text_editor;
            $this->template->username = $useradmin;
            
            $this->template->content_admin = View::factory('admin/system/blank', $data)
                ->bind('access_code', $access_code)
                ->bind('language', $language);
        }
        
        public function fetch_tpl($tpl = '', $data = array())
        {
            return View::factory('admin/'.$tpl, $data);
        }

} // End Welcome
