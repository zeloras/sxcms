<?php
class Helper_Common
{
 
    public static function get_category_path($category_id = 0, $url = '')
    {
        if ($category_id > 0)
        {
            $category_query = ORM::factory('categorys');
            $category_query->select('url', 'id', 'parent_id');
            $category_query->where('id', '=', $category_id);
            $category = $category_query->find_all();
            $category = $category[0];
            if ($category->id > 0)
            {
                if ($category->parent_id > 0)
                {
                    $url = $category->url.'/'.$url;
                    $url = self::get_category_path($category->parent_id, $url);
                }
                else
                {
                    $url = $category->url.'/'.$url;
                }
            }
        }
        
        //var_dump($url);
        return $url;
    }
    
    
    public static function get_category_info($category = 0)
    {
        if ($category > 0)
        {
            $category_model = ORM::factory('categorys');
            $category_model->select('id', 'url', 'id');
            $category_model->where('id', '=', $category);
            $category_result = $category_model->find();
            if (sizeof($category_result->id) > 0)
            {
                $result = array(
                    'title' => $category_result->title,
                    'url' => $category_result->url,
                    'id' => $category_result->id,
                    'full_url' => self::get_category_path($category_result->id),
                );
            }
            else
            {
                $result = array(
                    'title' => __('no category'),
                    'url' => '/',
                    'id' => 0,
                    'full_url' => '',
                );
            }
        }
        else 
        {
            $result = array(
                'title' => __('no category'),
                'url' => '/',
                'id' => 0,
                'full_url' => '',
            );
        }
        return $result;
    }
    

    public static function translit_url($urlstr) 
    {
        $tr = array(
            "А" => "A",
            "Б" => "B",
            "В" => "V",
            "Г" => "G",
            "Д" => "D",
            "Е" => "E",
            "Ж" => "ZH",
            "З" => "Z",
            "И" => "I",
            "Й" => "I",
            "К" => "K",
            "Л" => "L",
            "М" => "M",
            "Н" => "N",
            "О" => "O",
            "П" => "P",
            "Р" => "R",
            "С" => "S",
            "Т" => "T",
            "У" => "U",
            "Ф" => "F",
            "Х" => "H",
            "Ц" => "TS",
            "Ч" => "CH",
            "Ш" => "SH",
            "Щ" => "SHCH",
            "Ъ" => "",
            "Ы" => "Y",
            "Ь" => "'",
            "Э" => "E",
            "Ю" => "IU",
            "Я" => "IA",
            "Г" => "G",
            "Ї" => "YI",
            "І" => "I",
            "Є" => "E",
            "а" => "a",
            "б" => "b",
            "в" => "v",
            "г" => "g",
            "д" => "d",
            "е" => "e",
            "ж" => "zh",
            "з" => "z",
            "и" => "i",
            "й" => "i",
            "к" => "k",
            "л" => "l",
            "м" => "m",
            "н" => "n",
            "о" => "o",
            "п" => "p",
            "р" => "r",
            "с" => "s",
            "т" => "t",
            "у" => "u",
            "ф" => "f",
            "х" => "h",
            "ц" => "ts",
            "ч" => "ch",
            "ш" => "sh",
            "щ" => "shch",
            "ъ" => "",
            "ы" => "y",
            "ь" => "'",
            "э" => "e",
            "ю" => "iu",
            "я" => "ia",
            "г" => "g",
            "ї" => "yi",
            "і" => "i",
            "є" => "e",
            " " => "-",
            "." => "",
            ":" => "",
            ";" => "",
            "/" => "-"
        );

        if (preg_match('/[^A-Za-z0-9_\-]/', $urlstr)) 
        {
            $urlstr = strtr($urlstr, $tr);
            $urlstr = preg_replace('/[^A-Za-z0-9_\-]/', '', $urlstr);
        }

        return strtolower(($urlstr));
    }
    
    
    public static function get_userinfo()
    {
        $auth = Auth::instance();
        $user_id= $auth->get_user();
        
        $user_role_model = ORM::factory('userroles')->where('user_id', '=', $user_id)->find()->as_array();
        
        return $user_role_model;
    }

 }