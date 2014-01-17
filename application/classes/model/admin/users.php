<?php defined('SYSPATH') or die('No direct script access.');

class Model_Admin_Users
{    
    
    public function admin_users_add()
    {
        $username = Arr::get($_POST, 'username');
        $email = Arr::get($_POST, 'email');
        $password = Arr::get($_POST, 'password');
        $country = Arr::get($_POST, 'country');
        $city = Arr::get($_POST, 'city');
        $address = Arr::get($_POST, 'address');
        $zipcode = Arr::get($_POST, 'zipcode');
        $phone = Arr::get($_POST, 'phone');
        $role_id = Arr::get($_POST, 'role');
        $users_query = new Model_Users();
        $role_users_query = new Model_Userroles();
        $auth = Auth::instance();
        try
        {
            $users_query->username = $username;
            $users_query->email = $email;
            $users_query->password = $auth->hash_password($password);
            $users_query->country = $country;
            $users_query->city = $city;
            $users_query->address = $address;
            $users_query->zip_code = $zipcode;
            $users_query->phone = $phone;
            $user_id = $users_query->save();
            
            $role_users_query->user_id = $user_id;
            $role_users_query->role_id = $role_id;
            $role_users_query->save();
            
            return $user_id;
        }
        catch(ORM_Validation_Exception $e)
        {
                return $e->errors('admin');
        }
    }
    
    
    public function admin_users_edit($id = 0)
    {
        $username = Arr::get($_POST, 'username');
        $email = Arr::get($_POST, 'email');
        $password = Arr::get($_POST, 'password');
        $country = Arr::get($_POST, 'country');
        $city = Arr::get($_POST, 'city');
        $address = Arr::get($_POST, 'address');
        $zipcode = Arr::get($_POST, 'zipcode');
        $phone = Arr::get($_POST, 'phone');
        $role_id = Arr::get($_POST, 'role');
        $uid = Arr::get($_POST, 'user_id');
        
        $role_users_query = ORM::factory('userroles');
        $role_users_query->where('user_id', '=', $id);
        $role_users_query->find();

        
        $users_query = ORM::factory('users');
        $users_query->where('id', '=', $id);
        $user_query_count = $users_query->count_all();
        $auth = Auth::instance();
        
        if ($user_query_count > 0 && $uid == $id)
        {
            $users_query->where('id', '=', $id);
            $users_query->find();
            try		
            {
                $role_users_query->role_id = $role_id;
                $role_users_query->update();
                
                $users_query->id = $uid;
                $users_query->username = $username;
                $users_query->email = $email;
                if (strlen($password) > 3)
                    $users_query->password = $auth->hash_password($password);
                
                $users_query->country = $country;
                $users_query->city = $city;
                $users_query->address = $address;
                $users_query->zip_code = $zipcode;
                $users_query->phone = $phone;
                $users_query->update();
                return $uid;
            }
            catch(ORM_Validation_Exception $e)
            {
                    return $e->errors('admin');
            }
        }
        else
        {
            if ($uid !== $id)
                return array(0 => 'User wrong');
            else
                return array(0 => "User not isset");
        }
    }
  
}
