<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Comments extends Controller_Admin_Index {
	public function comments_list($dir = 'all')
	{
            switch ($dir) {
                case 'all':
                    $page_count = ORM::factory('comments')->count_all();
                    $page_query = ORM::factory('comments')->find_all();
                break;
            
                case 'waiting':
                    $page_count = ORM::factory('comments')->where('status', '=', 0)->count_all();
                    $page_query = ORM::factory('comments')->where('status', '=', 0)->find_all();
                break;
            
                case 'approved':
                    $page_count = ORM::factory('comments')->where('status', '=', 1)->count_all();
                    $page_query = ORM::factory('comments')->where('status', '=', 1)->find_all();
                break;
            
                case 'spam':
                    $page_count = ORM::factory('comments')->where('status', '=', 2)->count_all();
                    $page_query = ORM::factory('comments')->where('status', '=', 2)->find_all();
                break;

                default:
                    $page_count = ORM::factory('comments')->count_all();
                    $page_query = ORM::factory('comments')->find_all();
                break;
            }
            $data = array();
            foreach ($page_query as $key => $pqr)
            {
                $data['url_data'][$key] = Helper_Admin::get_comment_url($pqr->item_id, 'page');
                $data['icon'][$key] = Helper_Admin::get_icon_class($pqr->status, 'comments');
            }

            $pagination = Pagination::factory(
                    array(
                            'total_items' => $pages_count,
                            'view' => 'pagination/admin',
                            'items_per_page' => 25,
                         )
                   );
            $data['comments_type'] = $dir;
            $data['comments_size'] = $page_count;
            $data['comments_list'] = $page_query;
            $this->display_tpl('comments/index', $data);
	}

} // End Welcome
