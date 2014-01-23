<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Special extends Controller_Admin_Users {
        
    public function ajax_delete($type, $access_code = array())
    {
        $res_varchar = 0; //Резервная переменная что бы нотисы не вылетали
        $data = array(); //Тоже самое что и выше но только массив 
        $data_my = array( //В этом массиве находятся все данные с которыми мы будем работать
            'menu' => array(
                'dbs' => 'menus',
                'cmd' => 'menu_delete',
                'row' => 'id',
                'todelete' => (in_array(34, $access_code)) ? true : false,
                'getprop' => false,
                'cycle' => array( //Указывает что у нас будет задействован цикл на вложеные массивы
                    array(
                        'spec_type' => 'menu_data', // Это название основного ключа из которого мы будем выдирать dbs
                        'spec_type_data' => 'delete', //тип действий: update - обновление данных, delete - удаление данных, update_delete - (удаление и обновление) или (обновление или удаление)
                        'first' => 'menu_id', // обычно тут мы указываем поле с которым будем работать
                    ),
                    
                    ),
                ),
            
            'users' => array(
                'dbs' => 'users',
                'cmd' => 'user_delete',
                'row' => 'id',
                'todelete' => (in_array(54, $access_code)) ? true : false,
                'getprop' => false,
                ),
            
            'menu_data' => array(
                'dbs' => 'links',
                'cmd' => 'menu_data_delete',
                'row' => 'id',
                'todelete' => (in_array(34, $access_code)) ? true : false,
                'getprop' => false,
                ),
            
            'category' => array( //Это ключ для работы с таблицей myshop_category
                'dbs' => 'categorys',
                'cmd' => 'category_delete',
                'row' => 'id',
                'todelete' => (in_array(24, $access_code)) ? true : false,
                'getprop' => false,
                'cycle' => array(
                    array( //В этом блоке мы будем работать с таблицей myshop_products 
                        'spec_type' => 'pages',
                        'spec_type_data' => 'update',
                        'first' => 'category',
                        'first_data' => '0',
                    ),
                    
                    ),
                ),
            
            'pages' => array(
                'dbs' => 'pages',
                'cmd' => 'pages_update',
                'row' => 'id',
                'todelete' => (in_array(14, $access_code)) ? true : false,
                'getprop' => false,
                ),
            
            'comments' => array(
                'dbs' => 'comments',
                'cmd' => 'coment_update',
                'row' => 'id',
                'todelete' => (in_array(114, $access_code)) ? true : false,
                'getprop' => false,
                ),
            
            'widgets' => array(
                'dbs' => 'widgets',
                'cmd' => 'widgets_update',
                'row' => 'id',
                'todelete' => (in_array(84, $access_code)) ? true : false,
                'getprop' => false,
                ),
            
            'modules' => array(
                'dbs' => 'modules',
                'cmd' => 'modules_delete',
                'row' => 'id',
                'todelete' => (in_array(94, $access_code)) ? true : false,
                'getprop' => false,
                ),
                        
        );
        if (sizeof($data_my[$type]) < 2) return false; // Сразу проверям что в массиве с данными минимум 2 ключа, иначе уходим
        $data[$data_my[$type]['cmd']] = true; //Заранее активируем блок с сообщениями
        $ids = Arr::get($_POST, 'ids'); //А вот тут у нас массив с id эллементов которые мы будем использовать
        if ($ids != null && $data_my[$type]['todelete'])
        {
            foreach ($ids as $id) //Запускаем цикл и обрабатываем все id
            {
                if ($id > 0) //Малоли что, пустые значения заноситься не будут а вот 0 может влезть, по этому проверям
                {
                    if ($data_my[$type]['getprop'])
                    {
                        $spec_data = ORM::factory($data_my[$type]['dbs'])
                                ->where($data_my[$type]['row'], '=', $id)
                                ->find()
                                ->as_array();
                    }

                    $delete_dbs = ORM::factory($data_my[$type]['dbs'])
                            ->where($data_my[$type]['row'], '=', $id);
                            //->find();
                    $delete_dbs_count = $delete_dbs->count_all();

                    if ($delete_dbs_count > 0)
                    {
                        $delete_dbs->where($data_my[$type]['row'], '=', $id)->find();
                        $delete_dbs->delete(); //Тут мы используем наш массив и получаем базу данных из которой мы удалим полученый из цикла ID объекта
                        $data['updated'] = true; //Допустим удаление прошло успешно и в выбранном блоке выведется сообщение о том что все хорошо
                    }
                    if (isset($data_my[$type]['cycle'])) // Тут мы проверяем существует ли ключ cycle, если да, тот помимо стандартного удаления мы будем делать что то еще
                    {
                        foreach ($data_my[$type]['cycle'] as $prop) //Запускаем цикл и собираем инфу из блоков в cycle
                        {//для примера давайте поработаем с ключём 'category'
                            if ($data_my[$type]['getprop'])
                                $speid = $spec_data[$prop['first']];
                            else
                                $speid = $id;

                            $speid = ($speid == null) ? $id : $speid;

                            if ($prop['spec_type_data'] == 'update')// Если в $data_my['category']['cycle']['spec_type_data'] - передается значение update, значит будем что то обновлять (с)кэп
                            {
                                $update_dbs = ORM::factory($data_my[$prop['spec_type']]['dbs'])
                                        ->where($prop['first'], '=', $speid);
                                        //->find();
                                $update_dbs_count = $update_dbs->count_all();
                                if ($update_dbs_count > 0)
                                {
                                    $update_dbs->where($prop['first'], '=', $speid)->find();
                                    $update_dbs->$prop['first'] = $prop['first_data'];
                                    $update_dbs->update();
                                }
                            }

                            if ($prop['spec_type_data'] == 'delete')
                            {
                                $delete_dbs = ORM::factory($data_my[$prop['spec_type']]['dbs'])->where($prop['first'], '=', $speid);
                                $delete_dbs_count = $delete_dbs->count_all();
                                if ($delete_dbs_count > 0)
                                {
                                    $delspc = $delete_dbs->where($prop['first'], '=', $speid)->find_all();
                                    foreach ($delspc as $del_spc)
                                        $del_spc->delete();
                                }
                            }
                            if ($prop['spec_type_data'] === 'update_delete') //тут мы будем работать с (удалением и обновлением) или (удалением или обновлением)
                            {
                                if (isset($prop['spec_type']['update'])) //запрашиваем есть ли у нас массив $data_my['category']['cycle']['spec_type']['update'] если нет, то и делать тут нечего 
                                {
                                    $sync = ORM::factory($data_my[$prop['spec_type']['update']]['dbs'])->where($prop['first'], 'like', "%$id,%")->find_all();
                                    foreach ($sync as $db_sync) //Если что то есть то запускаем цикл
                                    {
                                        $to_db = preg_replace('@'.$id.',@', '', $db_sync->$prop['first']);// first - у нас содержит поле category в котором данные выглядят вот так: 2,66,9 
                                        $res_varchar = $db_sync->$prop['second']; //Сразу же заносим id строки в переменную т.к если будем еще работать и с удалением нам это понадобиться 
                                        if (isset($prop['spec_type']['delete'])) //Проверям есть ли массив с ключем delete если есть, значит надо что то удалять
                                        {
                                            $delete_dbs = ORM::factory($data_my[$prop['spec_type']['delete']]['dbs'])->where($prop['secod_data'], '=', $res_varchar);
                                            $delete_dbs_count = $delete_dbs->count_all();
                                            if ($delete_dbs_count > 0)
                                            {
                                                $spcdle = $delete_dbs->where($prop['secod_data'], '=', $res_varchar)->find_all();
                                                foreach ($spcdle as $spc_dle)
                                                $spc_dle->delete();//Если есть значения то удаляем
                                            }
                                        }

                                        $special_dbs = ORM::factory($data_my[$prop['spec_type']['update']]['dbs'])->where($prop['second'], '=', $res_varchar);
                                        $special_dbs_count = $special_dbs->count_all();
                                        $special_db = $special_dbs->where($prop['second'], '=', $res_varchar)->find_all();
                                        if ($special_dbs_count > 0)
                                        {
                                            if (strlen($to_db) > 1) //Если в $to_db символов болше чем 1 то обновляем, иначе просто удаляем строку это может быть если у нас было например в поле category 66, а нам как раз и нужно было исключить 66, из объекта 
                                            {
                                                $special_dbs->$prop['first'] = $to_db;
                                                $special_dbs->update();
                                            }
                                            else
                                            {
                                                foreach ($special_db as $specialdb)
                                                $specialdb->delete();
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        else
        {
            $data['no_ids'] = true;
        }
        $this->ajax_tpl($data);
    }
    
    
    public function ajax_getCategorys_opt()
    {
        $category_model = ORM::factory('admin_categorys');
        $tree = $category_model->buildForAdmin();
        $cats = $category_model->sub_cats($tree); 
        $data['getcats'] = true;
        $data['catTreeHTML'] = $category_model->renderCatOptList($tree);
        $this->ajax_tpl($data);
    }
    
    public function ajax_getPages_opt($cid = 0)
    {
        $pages_model = ORM::factory('pages');
        $pages_model->select('category', 'title', 'id', 'cat_url', 'url');
        $pages_model->where('category', '=', $cid);
        $page_list = $pages_model->find_all();
        $pages = array();
        foreach ($page_list as $key => $page)
        {
            $pages[$key]['id'] = $page->id;
            $pages[$key]['title'] = $page->title;
            $pages[$key]['url'] = $page->cat_url.$page->url;
        }
        
        $data['getpages'] = true;
        $data['pages'] = $pages;
        $this->ajax_tpl($data);
    }
    
    public function ajax_getSystem_opt()
    {
        $data['getsystem'] = true;
        $this->ajax_tpl($data);
    }
    
    public function ajax_translit_url()
    {
        $input_text = Arr::get($_POST, 'text_translit');
        $data['text'] = Helper_Common::translit_url($input_text);
        $data['url_translit'] = true;
        $this->ajax_tpl($data);
    }
    
    public function ajax_save_position($type = '')
    {
        $positions = Arr::get($_POST, 'positions');
        $data = array(
            'menu_links' => 'links',
            'categories' => 'categorys',
            'widgets' => 'widgets',
        );
        
        $type = $data[$type];
        if (strlen($type) < 1)
            $data['no_type'] = true;
        
        if (sizeof($positions) == 0)
            $data['no_ids'] = true;

        if ($positions) 
        {
            foreach ($positions as $pos => $id) 
            {
                $mod_model = ORM::factory($type);
                $mod_model->where('id', '=', $id);
                $mod_res = $mod_model->find();

                $mod_res->position = $pos;
                $mod_res->update();
            }
            $data['complite'] = true;
        }
        $data['save_positions'] = true;
        $this->ajax_tpl($data);
    }
    
    public function download_backup($file)
    {
        $dir = DOCROOT."uploads/backup/".$file;
        $this->response->send_file($dir, $file, array('mime_type' => 'application/octet-stream'));
    }
    
    
    public function ajaxCloudCheckConnect($type)
    {
        $data['cloud_check'] = true;
        $login = Arr::get($_POST, 'login');
        $password = Arr::get($_POST, 'password');
        
        $API = new Model_Libs_Api();
        switch ($type) {
            case 'yandex':
                $API->webdev_connect($login, $password, $type);
                $yandex_msg = $API->errors;
                
                $data['result'] = $yandex_msg;
            break;

            case 'box_com':
                $API->webdev_connect($login, $password, $type);
                $box_com_msg = $API->errors;
                
                $data['result'] = $box_com_msg;
            break;
        
            case 'fourshared':
                $API->webdev_connect($login, $password, $type);
                $fourshared_msg = $API->errors;
                
                $data['result'] = $fourshared_msg;
            break;
        
            default:
            break;
        }

        $this->ajax_tpl($data);
    }
    
    
    public function ajaxFTPCheckConnect()
    {
        $data['ftp_check'] = true;
        $login = Arr::get($_POST, 'login');
        $password = Arr::get($_POST, 'password');
        $server = Arr::get($_POST, 'host');
        $port = Arr::get($_POST, 'port');
        
        $API = new Model_Libs_Api();
        $API->ftp_connect($login, $password, $server, $port);
        $ftp_msg = $API->errors;

        $data['result'] = $ftp_msg;
        $this->ajax_tpl($data);
    }

    
    public function ajaxCloudSaveFile($type)
    {
        $settings_base = Helper_Admin::get_settings();
        $cloud_settings = $settings_base['yandex_cloud'];
        $API = new Model_Libs_Api();
        $file = Arr::get($_POST, 'file');
        $data['save_backup_cloud'] = true;
        
        if ($cloud_settings['active'] == 1)
        {
            $service_connect = $API->webdev_connect($cloud_settings['login'], $cloud_settings['password'], $type);
            if ($service_connect['type'])
            {
                $save_file = $API->webdev_save($file);
                $data['result'] = array('type' => false, 'text' => __('File has been sent to the server'));
            }
            else
            {
                $data['result'] = array('type' => false, 'text' => __('Failed to connect to server'));
            }
        }
        else
        {
            $data['result'] = array('type' => false, 'text' => __('Do not enabled saving files in the cloud'));
        }
        $this->ajax_tpl($data);
    }
    
    
    public function ajaxCloudDeleteFile($type)
    {
        $settings_base = Helper_Admin::get_settings();
        $cloud_settings = $settings_base['yandex_cloud'];
        $API = new Model_Libs_Api();
        $file = Arr::get($_POST, 'file');
        $data['delete_backup_cloud'] = true;
        
        if ($cloud_settings['active'] == 1)
        {
            $service_connect = $API->webdev_connect($cloud_settings['login'], $cloud_settings['password'], $type);
            if ($service_connect['type'])
            {
                $delete_file = $API->webdev_delete($file);
                $data['result'] = array('type' => true, 'text' => __('File remove from server'));
            }
            else
            {
                $data['result'] = array('type' => false, 'text' => __('Failed to connect to server'));
            }
        }
        else
        {
            $data['result'] = array('type' => false, 'text' => __('Do not enabled saving files in the cloud'));
        }
        $this->ajax_tpl($data);
    }
    
    
   
    public function ajaxFTPSaveFile()
    {
        $settings_base = Helper_Admin::get_settings();
        $ftp_settings = $settings_base['ftp'];
        $API = new Model_Libs_Api();
        $file = Arr::get($_POST, 'file');
        $data['save_backup_ftp'] = true;

        if ($ftp_settings['active'] == 1)
        {
            $service_connect = $API->ftp_connect($ftp_settings['login'], $ftp_settings['password'], $ftp_settings['server'], $ftp_settings['port']);
            if ($service_connect['type'])
            {
                $save_file = $API->ftp_save($file);
                $data['result'] = array('type' => false, 'text' => __('File has been sent to the server'));
            }
            else
            {
                $data['result'] = array('type' => false, 'text' => __('Failed to connect to server'));
            }
        }
        else
        {
            $data['result'] = array('type' => false, 'text' => __('Do not enabled saving files in the FTP'));
        }
        $this->ajax_tpl($data);
    }
    
    
    public function ajaxFTPDeleteFile($type)
    {
        $settings_base = Helper_Admin::get_settings();
        $ftp_settings = $settings_base['ftp'];
        $API = new Model_Libs_Api();
        $file = Arr::get($_POST, 'file');
        $data['delete_backup_ftp'] = true;

        if ($ftp_settings['active'] == 1)
        {
            $service_connect = $API->ftp_connect($ftp_settings['login'], $ftp_settings['password'], $ftp_settings['server'], $ftp_settings['port']);
            if ($service_connect['type'])
            {
                $delete_file = $API->ftp_delete($file);
                $data['result'] = array('type' => true, 'text' => __('File remove from server'));
            }
            else
            {
                $data['result'] = array('type' => false, 'text' => __('Failed to connect to server'));
            }
        }
        else
        {
            $data['result'] = array('type' => false, 'text' => __('Do not enabled saving files in the FTP'));
        }
        $this->ajax_tpl($data);
    }
    
    public function ajaxChangeActive()
    {
        $type = Arr::get($_POST, 'type');
        $id = Arr::get($_POST, 'id');
        $status = Arr::get($_POST, 'status');
        
        $data['change_active'] = true;
        $data_type = array(
            'menu' => array('table' => 'menus', 'row' => 'hidden'),
            'menu-data' => array('table' => 'links', 'row' => 'hidden'),
            'fields' => array('table' => 'fields', 'row' => 'active'),
            'page' => array('table' => 'pages', 'row' => 'status'),
            'widgets' => array('table' => 'widgets', 'row' => 'active'),
            'modules_active' => array('table' => 'modules', 'row' => 'active'),
            'modules_site' => array('table' => 'modules', 'row' => 'site'),
            'modules_menu' => array('table' => 'modules', 'row' => 'menu'),
            'comments' => array('table' => 'comments', 'row' => 'status'),
        );
        
        if (strlen($data_type[$type]['table']) < 2) return false;
        
        if ($id > 0 && !is_array($id))
        {
            $active = ORM::factory($data_type[$type]['table'])
                    ->select('id', $data_type[$type]['row'])
                    ->where('id', '=', $id)
                    ->find()
                    ->as_array();

            if ($active['id'] > 0)
            {
                if (!$status)
                    $status = ($active[$data_type[$type]['row']] == 0) ? 1 : 0;

                $select_new = ORM::factory($data_type[$type]['table'])
                        ->where('id', '=', $id)
                        ->find();
                $select_new->$data_type[$type]['row'] = $status;
                $select_new->update();
            }
            else
            {
               $data['no_item'] = true; 
            }
        }
        else
        {
            if (sizeof($id) > 0)
            {
                foreach ($id as $ids)
                {
                    $status = ($status > 2) ? 0 : $status;

                    $select_new = ORM::factory($data_type[$type]['table'])
                            ->where('id', '=', $ids)
                            ->find();
                    $select_new->$data_type[$type]['row'] = $status;
                    $select_new->update();
                }
            }
            else
            {
                $data['no_item'] = true;
            }
        }

        $this->ajax_tpl($data);
    }
    
    public function elfinder_init($dir)
    {
        $this->response->headers('Content-Type','application/json');
        switch ($dir) {
            case 'language_system':
                $path = DOCROOT.'application/i18n/';
                $url = '/';
            break;
        
            default:
                $path = DOCROOT.'uploads/'.$dir;
                $url = URL::base(true).'uploads/'.$dir;
            break;
        }
        $opts = array(
	'roots' => array(
		array(
			'driver'        => 'fs',   // driver for accessing file system (REQUIRED)
			'path'          => $path,         // path to files (REQUIRED)
			'URL'           => $url, // URL to files (REQUIRED)
			'accessControl' => 'access'             // disable and hide dot starting files (OPTIONAL)
		)
            )
        );
        $connector = new Model_Libs_Elfinder_Elfinderconnector(new Model_Libs_Elfinder_Elfinder($opts));
        die (json_encode($connector->run()));
    }
    
    public function generate_keywords()
    {
        $key_to_del;
        $end_data = array();
        $data['generate_keywords'] = true;
        $data['put_input'] = Arr::get($_POST, 'put');
        $get_text = Arr::get($_POST, 'keywords');
        $data_text = mb_strtolower(strip_tags($get_text));
        $arr_data_text = array_slice(preg_split('~\s~', preg_replace('@[^a-zа-я]\s+@','',$data_text)), 0, 40);
        $seo_orm = ORM::factory('settings')->select('seo_delete')->find();
        
        $seo_keywords = explode(',', $seo_orm->seo_delete);
        foreach ($seo_keywords as $srm)
            $key_to_del[] = trim($srm);
        
        $get_uniq = array_diff($arr_data_text, $key_to_del);
        
        foreach ($get_uniq as $end_data_text)
        {
            if (strlen($end_data_text) > 2)
                $end_data[] = $end_data_text;
        }
        
        $data['keywords'] = array_unique($end_data);
        $this->ajax_tpl($data);
    }
    
    
   public function get_properties($category = 0, $item = 0, $type = 'url', $onpage = 0)
    {
        $properties = ORM::factory('fields')->where('active', '=', 1)->order_by('position')->find_all();
        foreach ($properties as $prop)
        {
            $cats = unserialize($prop->category);
            foreach ($cats as $ct)
            {
                if ($ct == $category)
                {
                    if ($item > 0)
                    {
                        $data_row = ORM::factory('fieldsdata')
                                ->select('value')
                                ->where('properties_id', '=', $prop->id)
                                ->where('item_id', '=', $item)->find();
                        $data_row = $data_row->value;
                    }
                    else
                    {
                        $data_row = NULL;
                    }
                    $data['properties'][] = array(
                        'id' => $prop->id,
                        'title' => $prop->title,
                        'csv' => $prop->csv,
                        'category' => $ct,
                        'value' => $data_row,
                        );
                    break;
                }
            }
        }
        if (!isset($data))
           $data['no_properties'] = true;

        if ($onpage > 0)
        {
            array_splice($data['properties'], 0, -1);
        }

        if ($type == "url")
        {
            $data = array(
                    'html' => $this->fetch_tpl('additional_fields/select', $data),
                    'additional_block' => 1,
                );
            return $this->ajax_tpl($data);
        }
        else
        {
            return $this->fetch_tpl('additional_fields/select', $data);
        }
    }
    
    public function ajax_additional_fields_get()
    {
        $category = Arr::get($_POST, 'category');
        $item = Arr::get($_POST, 'item');
        
        $category = ($category > 0) ? $category : 0;
        $item = ($item > 0) ? $item : 0;
        $this->get_properties($category, $item, 'url');
    }
    
    public function ajax_comment_update($access)
    {
        $comment_id = Arr::get($_POST, 'comment_id');
        $comment_text = Arr::get($_POST, 'text');
        $data['fast_comment_update'] = true;
        
        if (Arr::get($_POST, 'submit_this_comment'))
        {
            if (in_array(113, $access))
            {
                $update = ORM::factory('comments')->where('id', '=', $comment_id)->find();
                $update->text = $comment_text;
                $update->update();
                $data['comment_update'] = true;
            }
            else
            {
                $data['access_error'] = true;
            }
        }
        
        return $this->ajax_tpl($data);
    }
    
}