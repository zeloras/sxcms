<?php defined('SYSPATH') or die('No direct script access.');

class Model_Admin_Languages
{    
    
    public function admin_languages_add()
    {
        $title = Arr::get($_POST, 'language');
        $file = preg_replace(array('@\\/@', '@.php@'), array('', ''), Arr::get($_POST, 'file'));
        $active = Arr::get($_POST, 'active');
        $active = ($active) ? 1 : 0;
        
        $fields_query = new Model_Langs();
        
        try		
        {
            $fields_query->title = $title;
            $fields_query->file = $file;
            $fields_query->active = $active;
            $fields_query->date = time();
            
            return $fields_query->save();
        }
        catch(ORM_Validation_Exception $e)
        {
                return $e->errors('admin');
        }
    }
    
    
    public function admin_languages_edit($id = 0)
    {
        $fid = Arr::get($_POST, 'field_id');
        $title = Arr::get($_POST, 'language');
        $file = preg_replace(array('@\\/@', '@.php@'), array('', ''), Arr::get($_POST, 'file'));
        $active = Arr::get($_POST, 'active');
        $active = ($active) ? 1 : 0;
        
        $field_query_count = ORM::factory('langs')->where('id', '=', $fid)->count_all();
        
        if ($field_query_count > 0 && $fid == $id)
        {
            $fields_query = ORM::factory('langs')->where('id', '=', $fid)->find();
            try
            {
                $fields_query->id = $id;
                $fields_query->title = $title;
                $fields_query->file = $file;
                $fields_query->active = $active;
                $fields_query->date = time();
                $fields_query->update();
                return $fid;
            }
            catch(ORM_Validation_Exception $e)
            {
                    return $e->errors('admin');
            }
        }
        else
        {
            if ($fid !== $id)
                return array(0 => 'Field wrong');
            else
                return array(0 => "Field not isset");
        }
    }
}
