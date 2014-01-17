<?php defined('SYSPATH') or die('No direct script access.');

class Model_Admin_Fields
{    
    
    public function admin_fields_add()
    {
        $title = Arr::get($_POST, 'title');
        $csv = Arr::get($_POST, 'csv');
        $category = Arr::get($_POST, 'category');
        $active = Arr::get($_POST, 'active');
        $active = ($active) ? 1 : 0;
        
        $fields_query = new Model_Fields();
        
        try		
        {
            $fields_query->title = $title;
            $fields_query->csv = $csv;
            $fields_query->category = serialize($category);
            $fields_query->active = $active;
            $fields_query->date = time();
            $fields_query->update = time();
            $fields_query->position = 0;
            
            return $fields_query->save();
        }
        catch(ORM_Validation_Exception $e)
        {
                return $e->errors('admin');
        }
    }
    
    
    public function admin_fields_edit($id = 0)
    {
        $fid = Arr::get($_POST, 'field_id');
        $title = Arr::get($_POST, 'title');
        $csv = Arr::get($_POST, 'csv');
        $category = Arr::get($_POST, 'category');
        $active = Arr::get($_POST, 'active');
        $active = ($active) ? 1 : 0;
        
        $field_query_count = ORM::factory('fields')->where('id', '=', $fid)->count_all();
        
        if ($field_query_count > 0 && $fid == $id)
        {
            $fields_query = ORM::factory('fields')->where('id', '=', $fid)->find();
            try
            {
                $fields_query->id = $fid;
                $fields_query->title = $title;
                $fields_query->csv = $csv;
                $fields_query->category = serialize($category);
                $fields_query->active = $active;
                $fields_query->update = time();
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
