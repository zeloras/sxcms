<?php defined('SYSPATH') or die('No direct script access.');

class Model_Admin_Menus
{    
    
    public $links = array();
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
    
    public function admin_menus_add()
    {
        $title = Arr::get($_POST, 'title');
        $name = Arr::get($_POST, 'name');
        $description = Arr::get($_POST, 'description');
        $template = Arr::get($_POST, 'template');
        $class = Arr::get($_POST, 'class');
        $parent_class = Arr::get($_POST, 'parent_class');
        $menus_query = new Model_Menus();
        
        try		
        {
            $menus_query->title = $title;
            $menus_query->name = $name;
            $menus_query->description = $description;
            $menus_query->template = $template;
            $menus_query->class = $class;
            $menus_query->parent_class = $parent_class;
            $menus_query->date = time();
            $menus_query->update = time();
            
            return $menus_query->save();
        }
        catch(ORM_Validation_Exception $e)
        {
                return $e->errors('admin');
        }
    }
    
    
    public function admin_menus_edit($id = 0)
    {
        $title = Arr::get($_POST, 'title');
        $name = Arr::get($_POST, 'name');
        $description = Arr::get($_POST, 'description');
        $template = Arr::get($_POST, 'template');
        $class = Arr::get($_POST, 'class');
        $parent_class = Arr::get($_POST, 'parent_class');
        $mid = Arr::get($_POST, 'menu_id');
        $menus_query = ORM::factory('menus');
        $menus_query->where('id', '=', $id);
        $menus_query_count = $menus_query->count_all();
        
        if ($menus_query_count > 0 && $mid == $id)
        {
            $menus_query->where('id', '=', $id);
            $menus_query->find();
            try		
            {
                $menus_query->id =  $mid;
                $menus_query->title = $title;
                $menus_query->name = $name;
                $menus_query->description = $description;
                $menus_query->template = $template;
                $menus_query->class = $class;
                $menus_query->parent_class = $parent_class;
                $menus_query->update = time();
                $menus_query->update();
                return $mid;
            }
            catch(ORM_Validation_Exception $e)
            {
                    return $e->errors('admin');
            }
        }
        else
        {
            if ($mid !== $id)
                return array(0 => 'Menu wrong');
            else
                return array(0 => "Menu not isset");
        }
    }
    
    
    public function admin_link_add($id = 0)
    {
        $title = Arr::get($_POST, 'title');
        $description = Arr::get($_POST, 'description');
        $icons = Arr::get($_POST, 'icons');
        $classes = Arr::get($_POST, 'classes');
        $parent = Arr::get($_POST, 'parent');
        $hidden = Arr::get($_POST, 'visible');
        $select_1 = Arr::get($_POST, 'linktype');
        $select_2 = Arr::get($_POST, 'first');
        $select_3 = Arr::get($_POST, 'second');
        $select_4 = Arr::get($_POST, 'threed');
        $menus_query = new Model_Links();
        
        switch ($select_1) 
        {
            case 1:
                $data_prop['type'] = $select_1;
                $data_prop['first'] = $select_2;
                $data_prop['second'] = 0;
                $data_prop['threed'] = '';
                $data_prop['url'] = Helper_Common::get_category_path($select_2);
            break;

            case 2:
                $data_prop['type'] = $select_1;
                $data_prop['first'] = $select_2;
                $data_prop['second'] = $select_3;
                $data_prop['threed'] = '';
                $data_prop['url'] = $select_3;
            break;

            case 3:
                $data_prop['type'] = $select_1;
                $data_prop['first'] = $select_2;
                $data_prop['second'] = 0;
                $data_prop['threed'] = '';
                $data_prop['url'] = $select_2;
            break;
        
            case 4:
                $data_prop['type'] = $select_1;
                $data_prop['first'] = $select_2;
                $data_prop['second'] = 0;
                $data_prop['threed'] = $select_4;
                $data_prop['url'] = $select_4;
            break;

        }
        
        try		
        {
            $menus_query->menu_id = $id;
            $menus_query->title = $title;
            $menus_query->hidden = $hidden;
            $menus_query->description = $description;
            $menus_query->icons = $icons;
            $menus_query->classes = $classes;
            $menus_query->parent_id = $parent;
            $menus_query->data = serialize($data_prop);
            $menus_query->date = time();
            
            return $menus_query->save();
        }
        catch(ORM_Validation_Exception $e)
        {
                return $e->errors('admin');
        }
    }
    
    public function admin_link_edit($id = 0, $item = 0)
    {
        $iid = Arr::get($_POST, 'item_id');
        $mid = Arr::get($_POST,'menu_id');
        $title = Arr::get($_POST, 'title');
        $description = Arr::get($_POST, 'description');
        $icons = Arr::get($_POST, 'icons');
        $classes = Arr::get($_POST, 'classes');
        $parent = Arr::get($_POST, 'parent');
        $hidden = Arr::get($_POST, 'visible');
        $select_1 = Arr::get($_POST, 'linktype');
        $select_2 = Arr::get($_POST, 'first');
        $select_3 = Arr::get($_POST, 'second');
        $select_4 = Arr::get($_POST, 'threed');
        $menus_query = ORM::factory('links')->where('id', '=', $item)->where('menu_id', '=', $id)->find();
        
        switch ($select_1) 
        {
            case 1:
                $data_prop['type'] = $select_1;
                $data_prop['first'] = $select_2;
                $data_prop['second'] = 0;
                $data_prop['threed'] = '';
                $data_prop['url'] = Helper_Common::get_category_path($select_2);
            break;

            case 2:
                $data_prop['type'] = $select_1;
                $data_prop['first'] = $select_2;
                $data_prop['second'] = $select_3;
                $data_prop['threed'] = '';
                $data_prop['url'] = Helper_Common::get_category_path($select_2).$select_3;
            break;

            case 3:
                $data_prop['type'] = $select_1;
                $data_prop['first'] = $select_2;
                $data_prop['second'] = 0;
                $data_prop['threed'] = '';
                $data_prop['url'] = $select_2;
            break;
        
            case 4:
                $data_prop['type'] = $select_1;
                $data_prop['first'] = 0;
                $data_prop['second'] = 0;
                $data_prop['threed'] = $select_4;
                $data_prop['url'] = $select_4;
            break;

        }
        
        try		
        {
            $menus_query->id = $item;
            $menus_query->menu_id = $id;
            $menus_query->title = $title;
            $menus_query->hidden = $hidden;
            $menus_query->icons = $icons;
            $menus_query->classes = $classes;
            $menus_query->description = $description;
            $menus_query->parent_id = $parent;
            $menus_query->data = serialize($data_prop);
            $menus_query->date = time();
            
            return $menus_query->update();
        }
        catch(ORM_Validation_Exception $e)
        {
                return $e->errors('admin');
        }
    }
 
    function buildLinks($id = 0) {
        // check cache file
        return $this->_build($id);
    }
    
    private function unsorted() {
        if ($this->unsorted != FALSE) {
            return $this->unsorted_arr;
        }
        
        $key = 'links_unsorted_array';

        $this->links = $this->get_links();
        $this->create_path();

        $cats = array();
        foreach ($this->links as $category) {
            $cats[$category['id']] = $category;
        }

        $this->unsorted_arr = & $cats;

        return $cats;
    }
    
    private function get_links($id) {
        $links_model = ORM::factory('links')->where('menu_id', '=', $id)->order_by('position');
        $query = $links_model->find_all();

        if ($query->count() > 0) 
        {
            foreach ($query->as_array() as $key => $lnk)
            {
                $links[$key] = $lnk->as_array();
            }

            return $links;
        }
        return FALSE;
    }
    
    
    private function _build($id = 0) {
        $this->links = $this->get_links($id);

        $new_cats = array();
        if (isset($this->links[0]['id']))
        {
            foreach ($this->links as $cats) {
                if ($cats['parent_id'] == 0) {
                    # Category Level
                    $cats['level'] = $this->level;

                    # Build sublinks
                    //$cats['subtree'] = $this->_get_sub_links($cats['id']);
                    $sub = $this->_get_sub_links($cats['id']);
                    if (count($sub))
                        $cats['subtree'] = $sub;

                    array_push($new_cats, $cats);
                }
            }

            unset($this->links);
            return $new_cats;
        }
        else
        {
            return false;
        }
    }
    
    private function _get_sub_links($parent_id) {
        $new_sub_links = array();
        $this->level++;

        foreach ($this->links as $sub_links) {
            if ($sub_links['parent_id'] == $parent_id) {
                $sub_links['level'] = $this->level;

                $sub = $this->_get_sub_links($sub_links['id']);
                
                if (count($sub))
                    $sub_links['subtree'] = $sub;

                array_push($new_sub_links, $sub_links);
            }
        }

        $this->level--;
        return $new_sub_links;
    }
    
    

    
  public function sub_links($array = array()) {
        if (is_array($array))
        {
            foreach ($array as $item) {
                $this->temp_links[] = $item;
                $item['subtree'] = (isset($item['subtree'])) ? $item['subtree'] : false;

                if ($item['subtree'] != false) {
                    $this->sub_links($item['subtree']);
                }
            }

            return $this->temp_links;
        }
        else
        {
            return false;
        }
    }
    
    public function renderList($tree) {
        $html = '';
        
        if (is_array($tree))
        {
            foreach ($tree as $item) {
                $html .= '<div>';
                $html .= $this->fetch_tpl('list-item', array('item' => $item));
                $item['subtree'] = (isset($item['subtree'])) ? $item['subtree'] : false;

                if ($item['subtree'] != false) {
                    $html .= '<div class="frame_level sortable" style="display:none;">';
                    $html .= $this->renderList($item['subtree']);
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
    
    
    private function fetch_tpl($file, $data = array())
    {   
        $access = $this->get_access();
        $this->access_code = (is_array($access)) ? $access : array();
        return View::factory('admin/menus/data/'.$file, $data)
                ->bind('access_code', $this->access_code);
    }
}
