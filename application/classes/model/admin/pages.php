<?php defined('SYSPATH') or die('No direct script access.');

class Model_Admin_Pages
{    
    
    public function admin_page_add()
    {
        $title = Arr::get($_POST, 'title');
        $url = Arr::get($_POST, 'url');
        $category = Arr::get($_POST, 'category');
        $short_desc = Arr::get($_POST, 'text_prev');
        $full_desc = Arr::get($_POST, 'text_full');
        $meta_keywords = Arr::get($_POST, 'meta_keywords');
        $meta_description = Arr::get($_POST, 'meta_description');
        $status = Arr::get($_POST, 'publication_status');
        $post_date = strtotime(Arr::get($_POST, 'post_date'));
        $template = Arr::get($_POST, 'template');
        //$site_template = Arr::get($_POST, 'site_template');
        $is_comment = Arr::get($_POST, 'is_comment');
        
        $pages_query = new Model_Pages();
        
        try		
        {
            $pages_query->title = $title;
            $pages_query->url = $url;
            $pages_query->category = $category;
            $pages_query->cat_url = Helper_Common::get_category_path($category);
            $pages_query->short_text = $short_desc;
            $pages_query->text = $full_desc;
            $pages_query->meta_keywords = $meta_keywords;
            $pages_query->meta_description = $meta_description;
            $pages_query->template = $template;
            //$pages_query->site_template = $site_template;
            $pages_query->status = $status;
            $pages_query->date = time();
            $pages_query->comment = ($is_comment) ? 1 : 0;
            $pages_query->post_date = ($post_date > 100) ? $post_date : time();
            $pages_query->update = time();
            
            return $pages_query->save();
        }
        catch(ORM_Validation_Exception $e)
        {
                return $e->errors('admin');
        }
    }
    
    
    public function admin_page_edit($id = 0)
    {
        $pid = Arr::get($_POST, 'page_id');
        $title = Arr::get($_POST, 'title');
        $url = Arr::get($_POST, 'url');
        $category = Arr::get($_POST, 'category');
        $short_desc = Arr::get($_POST, 'text_prev');
        $full_desc = Arr::get($_POST, 'text_full');
        $meta_keywords = Arr::get($_POST, 'meta_keywords');
        $meta_description = Arr::get($_POST, 'meta_description');
        $template = Arr::get($_POST, 'template');
        //$site_template = Arr::get($_POST, 'site_template');
        $status = Arr::get($_POST, 'publication_status');
        $post_date = strtotime(Arr::get($_POST, 'post_date'));
        $is_comment = Arr::get($_POST, 'is_comment');
        
        $pages_query = ORM::factory('pages');
        $pages_query->where('id', '=', $id);
        $pages_query_count = $pages_query->count_all();
        
        if ($pages_query_count > 0 && $pid == $id)
        {
            $pages_query->where('id', '=', $id);
            $pages_query->find();
            try		
            {
                $pages_query->id =  $pid;
                $pages_query->title = $title;
                $pages_query->url = $url;
                $pages_query->category = $category;
                $pages_query->cat_url = Helper_Common::get_category_path($category);
                $pages_query->short_text = $short_desc;
                $pages_query->text = $full_desc;
                $pages_query->meta_keywords = $meta_keywords;
                $pages_query->meta_description = $meta_description;
                $pages_query->template = $template;
                //$pages_query->site_template = $site_template;
                $pages_query->status = $status;
                $pages_query->update = time();
                $pages_query->comment = ($is_comment) ? 1 : 0;
                $pages_query->post_date = ($post_date > 100) ? $post_date : time();
                $pages_query->update();
                return $pid;
            }
            catch(ORM_Validation_Exception $e)
            {
                    return $e->errors('admin');
            }
        }
        else
        {
            if ($pid !== $id)
                return array(0 => 'Page wrong');
            else
                return array(0 => "Page not isset");
        }
    }
}
