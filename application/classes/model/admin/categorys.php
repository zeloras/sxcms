<?php defined('SYSPATH') or die('No direct script access.');

class Model_Admin_Categorys
{    
    
    public $categories = array();
    public $level = 0;
    public $path = array();
    public $unsorted_arr = FALSE;
    public $unsorted = FALSE;
    private $access_code = array();
    
    
    private function get_access()
    {
        $auth = Auth::instance();
        $user_id= $auth->get_user();
        
        $user_role_model = ORM::factory('userroles')->where('user_id', '=', $user_id)->find()->as_array();
        $user_role_id = $user_role_model['role_id'];
        
        $user_role = ORM::factory('roles')->where('id', '=', $user_role_id)->find()->as_array();
        $access = unserialize($user_role['access']);
        
        return $access; 
    }
    
    
    public function admin_category_add()
    {
        $title = Arr::get($_POST, 'title');
        $url = Arr::get($_POST, 'url');
        $parent = Arr::get($_POST, 'parent');
        $description = Arr::get($_POST, 'text_full');
        $meta_keywords = Arr::get($_POST, 'meta_keywords');
        $template = Arr::get($_POST, 'template');
        $image = Arr::get($_POST, 'image');
        $meta_description = Arr::get($_POST, 'meta_description');
        $category_query = new Model_Categorys();
        
        try		
        {
            $category_query->title = $title;
            $category_query->url = $url;
            $category_query->template = $template;
            $category_query->image = $image;
            $category_query->description = $description;
            $category_query->parent_id = $parent;
            $category_query->meta_keywords = $meta_keywords;
            $category_query->meta_description = $meta_description;
            $category_query->date = time();
            $category_query->update = time();
            $category_query->save();
            return $category_query->id;
        }
        catch(ORM_Validation_Exception $e)
        {
                return $e->errors('admin');
        }
    }
    
    
    public function admin_category_edit($id = 0)
    {
        $cid = Arr::get($_POST, 'category_id');
        $title = Arr::get($_POST, 'title');
        $url = Arr::get($_POST, 'url');
        $parent = Arr::get($_POST, 'parent');
        $description = Arr::get($_POST, 'text_full');
        $meta_keywords = Arr::get($_POST, 'meta_keywords');
        $template = Arr::get($_POST, 'template');
        $image = Arr::get($_POST, 'image');
        $meta_description = Arr::get($_POST, 'meta_description');
        $category_query = ORM::factory('categorys');
        $category_query->where('id', '=', $id);
        $category_query_count = $category_query->count_all();
        
        if ($category_query_count > 0 && $cid == $id)
        {
            $category_query->where('id', '=', $id);
            $category_query->find();
            try		
            {
                $category_query->id = $id;
                $category_query->title = $title;
                $category_query->url = $url;
                $category_query->template = $template;
                $category_query->image = $image;
                $category_query->description = $description;
                $category_query->parent_id = $parent;
                $category_query->meta_keywords = $meta_keywords;
                $category_query->meta_description = $meta_description;
                $category_query->update = time();
                $category_query->update();
                return $cid;
            }
            catch(ORM_Validation_Exception $e)
            {
                    return $e->errors('admin');
            }
        }
        else
        {
            if ($cid !== $id)
                return array(0 => 'Category wrong');
            else
                return array(0 => "Category not isset");
        }
    }
    
    function buildForAdmin() {
        // check cache file
        return $this->_build();
    }
    
    private function unsorted() {
        if ($this->unsorted != FALSE) {
            return $this->unsorted_arr;
        }
        
        $key = 'categories_unsorted_array';

        $this->categories = $this->get_categories();
        $this->create_path();

        $cats = array();
        foreach ($this->categories as $category) {
            $cats[$category['id']] = $category;
        }

        $this->unsorted_arr = & $cats;

        return $cats;
    }
    
    private function get_categories() {
        $categorys_model = new Model_Categorys();
        $query = $categorys_model->order_by('position')->find_all();

        if ($query->count() > 0) 
        {
            foreach ($query->as_array() as $key => $cat)
            {
                $categories[$key] = $cat->as_array();
            }

            return $categories;
        }
        return FALSE;
    }
    
    private function get_category($id) {
        if ($this->unsorted_arr == FALSE) {
            $this->unsorted();
        }

        if (is_array($id)) {
            $temp_arr = array();

            foreach ($id as $k => $v) {
                $temp_arr[$v] = $this->unsorted_arr[$v];
            }

            return $temp_arr;
        }
        return $this->unsorted_arr[$id];
    }
    
    private function GetValue($cat_id, $param) {
        if ($this->unsorted_arr == FALSE) {
            $this->unsorted();
        }

        return $this->unsorted_arr[$cat_id][$param];
    }
    
    private function get_category_by($param, $value) {
        $categories = $this->unsorted();

        foreach ($categories as $cat) {
            if ($cat[$param] == $value)
                return $cat;
        }

        unset($categories);
        return FALSE;
    }
    
    
    private function _build() {
        $this->categories = $this->get_categories();
        $this->create_path();

        $new_cats = array();
        if (isset($this->categories[0]['id']))
        {
            foreach ($this->categories as $cats) {
                if ($cats['parent_id'] == 0) {
                    # Category Level
                    $cats['level'] = $this->level;

                    # Build subcategories
                    //$cats['subtree'] = $this->_get_sub_cats($cats['id']);
                    $sub = $this->_get_sub_cats($cats['id']);
                    if (count($sub))
                        $cats['subtree'] = $sub;

                    array_push($new_cats, $cats);
                }
            }

            unset($this->categories);
            return $new_cats;
        }
        else
        {
            return false;
        }
    }
    
    private function _get_sub_cats($parent_id) {
        $new_sub_cats = array();
        $this->level++;

        foreach ($this->categories as $sub_cats) {
            if ($sub_cats['parent_id'] == $parent_id) {
                $sub_cats['level'] = $this->level;

                $sub = $this->_get_sub_cats($sub_cats['id']);
                
                if (count($sub))
                    $sub_cats['subtree'] = $sub;

                array_push($new_sub_cats, $sub_cats);
            }
        }

        $this->level--;
        return $new_sub_cats;
    }
    
    private function create_path() {
        $path_str = '';

        // Create path to each category
        for ($i = 0, $cats_count = count($this->categories); $i < $cats_count; $i++) {
            $this->path = array(); // make path empty

            //var_dump($this->categories[1]->url);
            //die();
            
            $path_arr = $this->_PathToCat($this->categories[$i]['id']);
            $this->categories[$i]['path'] = $path_arr; // path array
            // build path string 'cat1/sub_cat1/sub_cat2'
            if ($path_arr)
            {
                foreach ($path_arr as $k) {
                    @$path_str .= $k . '/';
                }
            }

            $this->categories[$i]['path_url'] = $path_str; // path string

            unset($path_arr);
            unset($path_str);
        }
    }
    
    private function _PathToCat($cat_id) {
        if (is_array($this->categories)) 
        {
            foreach ($this->categories as $cats) {
                if ($cats['id'] == $cat_id) {
                    //array_push($this->path,$cats['url']);
                    $this->path[$cats['id']] = $cats['url'];
                    $this->_PathToCat($cats['parent_id']);
                }
            }

            return array_reverse($this->path, TRUE);
        }
        else
        {
            return false;
        }
        //return $this->path;
    }
    
  public function sub_cats($array = array()) {
        if (is_array($array))
        {
            foreach ($array as $item) {
                $this->temp_cats[] = $item;
                $item['subtree'] = (isset($item['subtree'])) ? $item['subtree'] : false;

                if ($item['subtree'] != false) {
                    $this->sub_cats($item['subtree']);
                }
            }

            return $this->temp_cats;
        }
        else
        {
            return false;
        }
    }
    
    public function renderCatList($tree, $type = 'list-item') {
        $html = '';
        
        if (is_array($tree))
        {
            foreach ($tree as $item) {
                $html .= '<div>';
                $html .= $this->fetch_tpl($type, array('item' => $item));
                $item['subtree'] = (isset($item['subtree'])) ? $item['subtree'] : false;

                if ($item['subtree'] != false) {
                    $html .= '<div class="frame_level sortable" style="display:none;">';
                    $html .= $this->renderCatList($item['subtree'], $type);
                    $html .= '</div>';
                }
                
                $html .= '</div>';
            }
            return $html;
        }
        else
        {
            return false;
        }
    }
    
    public function renderCatOptList($tree, $arr_cat = array()) {
        $html = '';
        if (is_array($tree))
        {
            if (!isset($arr_cat['no_sel'])) $arr_cat['no_sel'] = '';
            foreach ($tree as $item) 
            {
                $html .= $this->fetch_tpl('cats_select', array('item' => $item)+$arr_cat);
                $item['subtree'] = (isset($item['subtree'])) ? $item['subtree'] : false;

                if ($item['subtree'] != false) {
                   // $html .= '<div class="frame_level sortable" style="display:none;">';
                        $html .= $this->renderCatOptList($item['subtree'], $arr_cat);
                   // $html .= '</div>';
                }
                //$html .= '</div>';
            }
            return $html;
        }
        else
        {
            return false;
        }
    }
    
    private function fetch_tpl($file, $data = array())
    {   
        $access = $this->get_access();
        $this->access_code = (is_array($access)) ? $access : array();
        return View::factory('admin/categorys/'.$file, $data)
                ->bind('access_code', $this->access_code);
    }
}