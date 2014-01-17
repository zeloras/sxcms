<?php defined('SYSPATH') or die('No direct script access.');
class Model_Libs_Api extends Model_Libs_Webdev
{
   protected $wdc;
   protected $ftp;
    public $errors = false;

    function Base()
    {
        parent::__construct();
        $this->wdc = false;
    }
    
   public function webdev_connect($login, $password, $type)
   {
       switch ($type) {
           case 'yandex':
               $server_url = 'ssl://webdav.yandex.ru';
               $port = 443;
           break;

           case 'box_com':
               $server_url = 'ssl://dav.dropdav.com';
               $port = 443;
           break;
       
           case 'fourshared':
               $server_url = 'ssl://webdav.4shared.com';
               $port = 443;
           break;
       
           default:
           break;
       }
       $this->wdc = new Model_Libs_Webdev();
       $this->wdc->set_server($server_url);
       $this->wdc->set_port($port);
       $this->wdc->set_user($login);
       $this->wdc->set_pass($password);
       $this->wdc->set_protocol(1);
       $this->wdc->set_debug(true);
       
       if (!$this->wdc->open())
       {
           return $this->errors = array('type' => false,'text' =>'Не удалось подключиться к серверу.');
       }

       // check if server supports webdav rfc 2518
        if (!$this->wdc->ls('/'))
        {
            return $this->errors = array('type' => false,'text' =>'Логин и пароль указаны не верно.');
        }
        
        return $this->errors = array('type' => true,'text' =>'Подключение прошло успешно.');
   }
   
   public function webdev_save($file = 'false')
   {
       $path = "/".$_SERVER['HTTP_HOST']."_backups";
       $target_file = $path."/".$file;
               
       $backup_path = DOCROOT."uploads/backup/";
       $backup_file = $backup_path.$file;
       if (file_exists($backup_file))
       {
            $handle = fopen ($backup_file, 'r');
            $contents = fread ($handle, filesize ($backup_file));
            fclose ($handle);
            $this->wdc->mkcol($path);
            $save_file = $this->wdc->put($target_file,$contents);
       }
   }
   
   
   public function webdev_delete($file = 'false')
   {
       $path = "/".$_SERVER['HTTP_HOST']."_backups";
       $target_file = $path."/".$file;
               
       $backup_path = DOCROOT."uploads/backup/";
       $backup_file = $backup_path.$file;
       if (file_exists($backup_file))
       {
            $delete_file = $this->wdc->delete($target_file);
       }
   }
   
   
   public function webdev_list_short()
   {
       $path = "/".$_SERVER['HTTP_HOST']."_backups";
       $lists = $this->wdc->ls($path);
       foreach ($lists as $ls)
       {
           if ($ls['href'] !== $path.'/')
           {
              $exp_file = explode('/', $ls['href']);
              $file_list[$exp_file[sizeof($exp_file) - 1]] = true;
           }
       }
       return $file_list;
   }
   
   
  public function ftp_connect($login, $password, $host, $port = 21)
   {
        $this->ftp = new Model_Libs_Ftp();
        $config['hostname'] = ($host) ? $host : 'isp3.xfes.ru';
        $config['username'] = ($login) ? $login : 'zeloras_service';
        $config['port'] = $port;
        $config['password'] = ($password) ? $password : 'zeloras';
        $config['debug'] = FALSE;

       if (!$this->ftp->connect($config))
       {
           return $this->errors = array('type' => false,'text' =>'Не удалось подключиться к серверу, проверьте введенные данные.');
       }
       
       $path = "/".$_SERVER['HTTP_HOST']."_backups";
       $this->ftp->mkdir($path, DIR_WRITE_MODE);
    return $this->errors = array('type' => true,'text' =>'Подключение прошло успешно.');
   }
   
   public function ftp_save($file = 'false')
   {
       $path = "/".$_SERVER['HTTP_HOST']."_backups";
       $target_file = $path."/".$file;
               
       $backup_path = DOCROOT."uploads/backup/";
       $backup_file = $backup_path.$file;
       if (file_exists($backup_file))
       {
            $this->ftp->mkdir($path, DIR_WRITE_MODE);
            $this->ftp->upload($backup_file, $target_file);
            $this->ftp->close();
       }
   }
   
   
   public function ftp_delete($file = 'false')
   {
       $path = "/".$_SERVER['HTTP_HOST']."_backups";
       $target_file = $path."/".$file;
               
       $backup_path = DOCROOT."uploads/backup/";
       $backup_file = $backup_path.$file;
       if (file_exists($backup_file))
       {
            $this->ftp->delete_file($target_file);
       }
   }
   
   
   public function ftp_list_short()
   {
       $path = "/".$_SERVER['HTTP_HOST']."_backups";
       $lists = $this->ftp->list_files($path);
       foreach ($lists as $ls)
       {
           if ($ls !== $path.'/')
           {
              $exp_file = explode('/', $ls);
              $file = $exp_file[sizeof($exp_file) - 1];
              if ($file != '..' && $file != '.')
                $file_list[$file] = true;
           }
       }
       return $file_list;
   }
}