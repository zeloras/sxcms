<?php defined('SYSPATH') or die('No direct script access.');

class Model_Admin_Fieldsdata
{    
    
    public function create_additional_data($category = 0, $item = 0)
    {
        $post = Arr::get($_POST, 'prop');
        if ($post)
        {
            while($v = each ($post))
            {

                $count_data = ORM::factory('fieldsdata')
                        ->where('item_id', '=', $item)
                        ->where('properties_id', '=', $v[1]['id'])
                        ->count_all();
                if($count_data > 0)
                {
                    if (strlen($v[1]['value']) > 0)
                    {
                        $update = ORM::factory('fieldsdata')
                                ->where('item_id', '=', $item)
                                ->where('properties_id', '=', $v[1]['id'])->find();

                        $update->properties_id = $v[1]['id'];
                        $update->item_id = $item;
                        $update->value = $v[1]['value'];
                        $update->date = time();
                        $update->update = time();
                        $update->update();
                    }
                    else
                    {
                        $remove = ORM::factory('fieldsdata')
                                ->where('item_id', '=', $item)
                                ->where('properties_id', '=', $v[1]['id'])
                                ->delete();
                    }
                }
                else
                {
                    if (strlen($v[1]['value']) > 0)
                    {
                        $insert = ORM::factory('fieldsdata');
                        $insert->properties_id = $v[1]['id'];
                        $insert->item_id = $item;
                        $insert->value = $v[1]['value'];
                        $insert->date = time();
                        $insert->update = time();
                        $insert->save();
                    }
                }
            }
        }
        else
        {
            return false;
        }
    }
    
}
