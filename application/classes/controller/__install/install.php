<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Install_Install {
    
    
    public function index()
    {
        return $this->display_tpl('first', array());
    }
    
    public function step1()
    {
        $data['settings'] = array(
            'lib_php' => (phpversion() >= '5.3.0') ? true : false,
            'lib_fgs' => (ini_get('allow_url_fopen')) ? true : false,
            'lib_sock' => (phpversion() >= '5.3.0') ? true : false,
            'lib_xml' => (phpversion('SimpleXML')) ? true: false,
            'lib_ftp' => function_exists('ftp_connect'),
            'lib_gd2' => (extension_loaded('gd') && function_exists('gd_info')) ? true : false,
            'lib_mysql' => (phpversion('mysql')) ? true : false,
            'per_cache' => (substr(decoct(fileperms(DOCROOT.'application/cache')),2) == (755 || 777)),
            'per_logs' => (substr(decoct(fileperms(DOCROOT.'application/logs')),2) == (755 || 777)),
            'per_backup' => (substr(decoct(fileperms(DOCROOT.'uploads/backup')),2) == (755 || 777)),
            'per_images' => (substr(decoct(fileperms(DOCROOT.'uploads/images')),2) == (755 || 777)),
            'per_config' => (substr(decoct(fileperms(DOCROOT.'config.xml')),3) == (644 || 777)),
        );
        
        $data['all_ok'] = true;
        
        foreach ($data['settings'] as $ds)
        {
            if (!$ds)
            {
                $data['all_ok'] = false;
                break;
            }
        }
        return $this->display_tpl('second', $data);
    }
    
    public function step2()
    {
        $data['all_ok'] = true;
        $mysql_check_connect = false;
        $mysql_select_db = false;
        $user_mail = false;
        $user_password = false;
        $user_repassword = false;
        if (!isset($_POST['finish_install']))
        {
            if (isset($_POST['submit_step2']))
            {
                $mysql_check_connect = (@mysql_connect($_POST['mysql']['server'], $_POST['mysql']['login'], $_POST['mysql']['password'])) ? true : false;;
                if ($mysql_check_connect)
                    $mysql_select_db = (mysql_num_rows(mysql_query('SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = "'.$_POST['mysql']['database'].'"')) > 0) ? true : false;
                $user_mail = (filter_var($_POST['user']['email'], FILTER_VALIDATE_EMAIL)) ? true : false;
                $user_password = strlen($_POST['user']['password']) > 5;
                $user_repassword = (strlen($_POST['user']['repassword']) > 5 && $_POST['user']['repassword'] == $_POST['user']['password']);
            }

            $data['check'] = array(
                'mysql_host' => $mysql_check_connect,
                'mysql_login' => $mysql_check_connect,
                'mysql_password' => $mysql_check_connect,
                'mysql_db' => $mysql_select_db,
                'user_email' => $user_mail,
                'user_password' => $user_password,
                'user_repassword' => $user_repassword,
            );

            foreach ($data['check'] as $check)
            {
                if (!$check)
                {
                    $data['all_ok'] = false;
                    break;
                }
            }
        }
        else
        {
            $system_tables = array('sx_additional_fields',
                'sx_additional_fields_data', 'sx_categorys', 'sx_comments', 'sx_i18n', 'sx_langs',
                'sx_menus', 'sx_menus_data', 'sx_modules', 'sx_pages', 'sx_roles',
                'sx_roles_users', 'sx_settings', 'sx_users', 'sx_user_tokens', 'sx_widgets'
                );
            $mysql_conn = mysqli_connect($_POST['mysql']['server'], $_POST['mysql']['login'], $_POST['mysql']['password'], $_POST['mysql']['database']);
            $mysql_conn->query("SET NAMES `utf8`");
            $show_tables = $mysql_conn->query("SHOW TABLES FROM ".$_POST['mysql']['database']);
            while ($rows = mysqli_fetch_array($show_tables))
                if (in_array($rows[0], $system_tables))
                    $sql_drop_isset_table = $mysql_conn->query("DROP TABLE `".$rows[0]."`");
            
            $sql_dump_file = file_get_contents(dirname(__FILE__) . '/sql/sql_dump.sql');
            $sql_dump_explode = explode(";\n", $sql_dump_file);
            
            foreach ($sql_dump_explode as $sql_exp)
            {
                $sql_exp = trim($sql_exp);
                if ($sql_exp != '')
                    $mysql_conn->query($sql_exp.';');
            }
            $hash_password = Auth::instance()->hash_password($_POST['user']['password']);
            $user_name = explode("@", $_POST['user']['email']);
            $user_name = $user_name[0];
            $add_user = $mysql_conn->query("INSERT INTO sx_users (`email`, `password`, `username`) VALUES ('".$_POST['user']['email']."', '".$hash_password."', '".$user_name."')");
            $add_role_user = $mysql_conn->query("INSERT INTO `sx_roles_users` (`user_id`, `role_id`) VALUES ('1', '2')");
            
            $get_config_install = file_get_contents(DOCROOT.'application/classes/controller/install/config/database.php');
            $db_settings_insert = "
                        'hostname'   => '".$_POST['mysql']['server']."',
			'database'   => '".$_POST['mysql']['database']."',
			'username'   => '".$_POST['mysql']['login']."',
			'password'   => '".$_POST['mysql']['password']."',
			'persistent' => FALSE,";
            $db_settings_insert = preg_replace("@\/\/{DB_SETTINGS}@", $db_settings_insert, $get_config_install);
            $file_put_config = file_put_contents(DOCROOT.'application/config/database.php', $db_settings_insert);
            
            $data['user_login'] = $user_name;
            $data['user_email'] = $_POST['user']['email'];
            $data['user_password'] = $_POST['user']['password'];
            $data['finish_install'] = true;
        }
        
        return $this->display_tpl('three', $data);
    }
    
    private function display_tpl($file, $args = array())
    {
        $data['temp_dir'] = '/application/classes/controller/install/templates/';
        $templates = 'install_cmssystem/templates/';
        if (isset($args['finish_install']))
            $data['temp_dir'] = '/application/classes/controller/__install/templates/';;
        $data['content'] = View::factory($templates.$file, $args);
        echo View::factory('install_cmssystem/templates/index', $data);
        if (isset($args['finish_install']))
            rename(DOCROOT."/application/classes/controller/install", DOCROOT."/application/classes/controller/__install");
        die();
    }
}