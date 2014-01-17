<?php defined('SYSPATH') or die('No direct script access.');

class Model_Admin_Roles
{    
    
    public function admin_roles_add()
    {
        $title = Arr::get($_POST, 'title');
        $name = Arr::get($_POST, 'name');
        $description = Arr::get($_POST, 'description');
        $is_admin = Arr::get($_POST, 'is_admin');
        $access = Arr::get($_POST, 'access');
        $roles_query = new Model_Roles();
        try
        {
            $roles_query->title = $title;
            $roles_query->name = $name;
            $roles_query->description = $description;
            $roles_query->is_admin = ($is_admin) ? 1 : 0;
            $roles_query->access = serialize($access);
            
            return $roles_query->save();
        }
        catch(ORM_Validation_Exception $e)
        {
                return $e->errors('admin');
        }
    }
    
    
    public function admin_roles_edit($id = 0)
    {
        $title = Arr::get($_POST, 'title');
        $name = Arr::get($_POST, 'name');
        $description = Arr::get($_POST, 'description');
        $is_admin = Arr::get($_POST, 'is_admin');
        $access = Arr::get($_POST, 'access');
        $rid = Arr::get($_POST, 'role_id');
        $roles_query = ORM::factory('roles');
        $roles_query->where('id', '=', $id);
        $roles_query_count = $roles_query->count_all();
        
        if ($roles_query_count > 0 && $rid == $id)
        {
            $roles_query->where('id', '=', $id);
            $roles_query->find();
            try		
            {
                $roles_query->id = $rid;
                $roles_query->title = $title;
                $roles_query->name = $name;
                $roles_query->description = $description;
                $roles_query->access = serialize($access);
                $roles_query->is_admin = ($is_admin) ? 1 : 0;
                $roles_query->update();
                return $rid;
            }
            catch(ORM_Validation_Exception $e)
            {
                    return $e->errors('admin');
            }
        }
        else
        {
            if ($rid !== $id)
                return array(0 => 'Role wrong');
            else
                return array(0 => "Role not isset");
        }
    }
  
}
