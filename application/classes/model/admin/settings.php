<?php defined('SYSPATH') or die('No direct script access.');

class Model_Admin_Settings
{    
    
    public function admin_settings_update()
    {
        $settigns = Arr::get($_POST, 'settings');
        $cloud = Arr::get($_POST, 'cloud');
        $settings_general = serialize($settigns['general']);
        $settigns_seo = serialize($settigns['seo']);
        $settigns_template = serialize($settigns['template']);
        $settigns_cloud = serialize($cloud);
        $settigns_comments = serialize(Arr::get($_POST, 'comments'));
        
        $settings_query = ORM::factory('settings')->find();
        try
        {
            $settings_query->general = $settings_general;
            $settings_query->seo = $settigns_seo;
            $settings_query->template = $settigns_template;
            $settings_query->cloud = $settigns_cloud;
            $settings_query->comments = $settigns_comments;
            
            return $settings_query->update();
        }
        catch(ORM_Validation_Exception $e)
        {
                return $e->errors('admin');
        }
    }
  
    
    public function admin_backup_create($typebackup = "sql") 
    {
            //get all of the tables
            $return = '';
            $tables = array(
                'additional_fields',
                'additional_fields_data',
                'categorys',
                'comments',
                'i18n',
                'langs',
                'menus',
                'links',
                'modules',
                'pages',
                'roles',
                'userroles',
                'settings',
                'users',
                'usertokens',
                'widgets',
                //'myshop_products',
                //'myshop_properties',
                ////'myshop_properties_data',
                //'myshop_settings',
                //'myshop_warehouse',
                //'myshop_profile',
                //'myshop_rate',
                //'myshop_comments',
                //'myshop_preorders',
            );
            if ($typebackup == "sql" || $typebackup == "sql_files")
            {
                //cycle through each table and format the data
                foreach($tables as $table)
                {
                    $values = '';
                    $fileds = '';
                    $fdata = '';
                        $result = ORM::factory($table)->find_all()->as_array();
                        $fields_data = ORM::factory($table)->list_columns();
                        $fdata_size = sizeof($fields_data);
                        $primary_key = '';
                        $fdata .= "CREATE TABLE IF NOT EXISTS `".$table."` (\n";
                        $fsize = 0;
                        foreach ($fields_data as $f => $field_data)
                        {
                            if ($field_data['extra'] == "auto_increment")
                            {
                                $field_data['key'] = " AUTO_INCREMENT,";
                                $primary_key = $field_data['column_name'];
                            }
                            else
                            {
                                if ($fsize < $fdata_size)
                                {
                                    $field_data['key'] = ",";
                                }
                                else
                                {
                                    if (strlen($primary_key) > 0)
                                        $field_data['key'] = ",";
                                    else
                                        $field_data['key'] = "";
                                }
                            }
                            $field_data['type'] = (isset($field_data['display'])) ? $field_data['type']."(".$field_data['display'].")" : $field_data['type'];
                            $field_data['column_default'] = ($field_data['column_default'] != NULL) ? " DEFAULT '".$field_data['column_default']."'" : "";
                            $fdata .= "`".$field_data['column_name']."` ".$field_data['type']." NOT NULL".$field_data['column_default'].$field_data['key']."\n";
                            if ($fdata_size == $fsize)
                            {
                                $fdata .= (strlen($primary_key) > 0) ? "PRIMARY KEY (`".$primary_key."`)" : "";
                            }
                            $fsize++;
                        }
                        $fdata .= "\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;\n\n";
                       // echo $fdata;
                        //foreach ($result as $res)
                        //{
                            //var_dump(($result[0]));
                        //}
                        //break;
                        $keys_1 = array_keys($result[0]->as_array());
                        $keys_size = sizeof($keys_1) - 1;
                        //*Получаем запрос в виде INSER INTo 'bla bla' (rows1,rows2) VALUES
                        foreach ($keys_1 as $k => $key_table)
                        { 
                            if ($k == 0)
                            {
                                $fileds = "INSERT INTO `".$table."` ";
                                $fileds .= "(`".$key_table."`, ";
                            }
                            else
                            {
                                if ($k == $keys_size)
                                {
                                    $fileds .= "`".$key_table."`) VALUES \n";
                                }
                                else
                                {
                                    $fileds .= "`".$key_table."`, ";
                                }
                            }
                        }
                        $values_size = sizeof($result) -1;
                        foreach ($result as $vr => $values_rows)
                        {
                            //var_dump($values_rows);
                            $values_1 = array_values($values_rows->as_array());
                            $v_size = sizeof($values_1) - 1;
                            foreach ($values_1 as $k => $val)
                            {
                                if ($k == 0)
                                {
                                    $values .= "('".$this->magic($val)."', ";
                                }
                                else
                                {
                                    if ($k == $v_size)
                                    {
                                        if ($vr == $values_size)
                                        $values .= "'".$this->magic($val)."');\n\n\n";
                                        else
                                        $values .= "'".$this->magic($val)."'),\n";
                                    }
                                    else
                                    {
                                        $values .= "'".$this->magic($val)."',";
                                    }
                                }
                            }
                        }
                        $return .= $fdata.$fileds.$values;                
                }
            }

            //var_dump($return);
            //save the file
            $model_zipper = new Model_Libs_Zipper();
            if ($typebackup == "sql")
            {
                $handle = fopen(DOCROOT.'uploads/backup/sql-backup-'.time().'-sxcms'.'.sql','w+');
                fwrite($handle,$return);
                fclose($handle);
            }
            
            if ($typebackup == "files")
            {
                $model_zipper->get_files_from_folder(DOCROOT,'files/');
                $model_zipper->archive(DOCROOT.'uploads/backup/files-backup-'.time().'-sxcms'.'.zip'); 
            }
            
            if ($typebackup == "sql_files")
            {
                $model_zipper->get_files_from_folder(DOCROOT,'files/');
                $model_zipper->add_data('sql_backup.sql', $return);
                $model_zipper->archive(DOCROOT.'uploads/backup/sql_and_files-backup-'.time().'-sxcms'.'.zip'); 
            }
            $this->_RESULT = true;
    }
    
    
    private function magic ($path) 
    {
            @ini_set('magic_quotes_runtime', '0');
            @ini_set('magic_quotes_sybase', '0');
        if (@ini_get('magic_quotes_gpc')=='1') $path=stripslashes($path);
        $path = preg_replace("@'@", "''", $path);
        return $path;
    }
    
}
