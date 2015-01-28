<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2015-01-03 13:05:06 --- ERROR: Kohana_Exception [ 0 ]: A valid cookie salt is required. Please set Cookie::$salt. ~ SYSPATH/classes/kohana/cookie.php [ 151 ]
2015-01-03 13:05:06 --- STRACE: Kohana_Exception [ 0 ]: A valid cookie salt is required. Please set Cookie::$salt. ~ SYSPATH/classes/kohana/cookie.php [ 151 ]
--
#0 /home/devjcat/www/public_html/system/classes/kohana/cookie.php(67): Kohana_Cookie::salt('_ga', NULL)
#1 /home/devjcat/www/public_html/system/classes/kohana/request.php(202): Kohana_Cookie::get('_ga')
#2 /home/devjcat/www/public_html/index.php(108): Kohana_Request::factory()
#3 {main}
2015-01-03 13:06:15 --- ERROR: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'menu' at 'MODPATH/menu' ~ SYSPATH/classes/kohana/core.php [ 550 ]
2015-01-03 13:06:15 --- STRACE: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'menu' at 'MODPATH/menu' ~ SYSPATH/classes/kohana/core.php [ 550 ]
--
#0 /home/devjcat/www/public_html/application/bootstrap.php(116): Kohana_Core::modules(Array)
#1 /home/devjcat/www/public_html/index.php(102): require('/home/devjcat/w...')
#2 {main}
2015-01-03 13:06:41 --- ERROR: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'menu' at 'MODPATH/menu' ~ SYSPATH/classes/kohana/core.php [ 550 ]
2015-01-03 13:06:41 --- STRACE: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'menu' at 'MODPATH/menu' ~ SYSPATH/classes/kohana/core.php [ 550 ]
--
#0 /home/devjcat/www/public_html/application/bootstrap.php(116): Kohana_Core::modules(Array)
#1 /home/devjcat/www/public_html/index.php(102): require('/home/devjcat/w...')
#2 {main}
2015-01-03 13:06:43 --- ERROR: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'menu' at 'MODPATH/menu' ~ SYSPATH/classes/kohana/core.php [ 550 ]
2015-01-03 13:06:43 --- STRACE: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'menu' at 'MODPATH/menu' ~ SYSPATH/classes/kohana/core.php [ 550 ]
--
#0 /home/devjcat/www/public_html/application/bootstrap.php(116): Kohana_Core::modules(Array)
#1 /home/devjcat/www/public_html/index.php(102): require('/home/devjcat/w...')
#2 {main}
2015-01-03 13:06:43 --- ERROR: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'menu' at 'MODPATH/menu' ~ SYSPATH/classes/kohana/core.php [ 550 ]
2015-01-03 13:06:43 --- STRACE: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'menu' at 'MODPATH/menu' ~ SYSPATH/classes/kohana/core.php [ 550 ]
--
#0 /home/devjcat/www/public_html/application/bootstrap.php(116): Kohana_Core::modules(Array)
#1 /home/devjcat/www/public_html/index.php(102): require('/home/devjcat/w...')
#2 {main}
2015-01-03 13:07:55 --- ERROR: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'pagination' at 'MODPATH/pagination' ~ SYSPATH/classes/kohana/core.php [ 550 ]
2015-01-03 13:07:55 --- STRACE: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'pagination' at 'MODPATH/pagination' ~ SYSPATH/classes/kohana/core.php [ 550 ]
--
#0 /home/devjcat/www/public_html/application/bootstrap.php(116): Kohana_Core::modules(Array)
#1 /home/devjcat/www/public_html/index.php(102): require('/home/devjcat/w...')
#2 {main}
2015-01-03 13:07:58 --- ERROR: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'pagination' at 'MODPATH/pagination' ~ SYSPATH/classes/kohana/core.php [ 550 ]
2015-01-03 13:07:58 --- STRACE: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'pagination' at 'MODPATH/pagination' ~ SYSPATH/classes/kohana/core.php [ 550 ]
--
#0 /home/devjcat/www/public_html/application/bootstrap.php(116): Kohana_Core::modules(Array)
#1 /home/devjcat/www/public_html/index.php(102): require('/home/devjcat/w...')
#2 {main}
2015-01-03 13:08:06 --- ERROR: ErrorException [ 2 ]: file_get_contents(config.xml): failed to open stream: No such file or directory ~ APPPATH/classes/ropublic.php [ 16 ]
2015-01-03 13:08:06 --- STRACE: ErrorException [ 2 ]: file_get_contents(config.xml): failed to open stream: No such file or directory ~ APPPATH/classes/ropublic.php [ 16 ]
--
#0 [internal function]: Kohana_Core::error_handler(2, 'file_get_conten...', '/home/devjcat/w...', 16, Array)
#1 /home/devjcat/www/public_html/application/classes/ropublic.php(16): file_get_contents('config.xml')
#2 /home/devjcat/www/public_html/application/classes/ropublic.php(10): Ropublic->set_template()
#3 /home/devjcat/www/public_html/application/classes/controller/public/page.php(6): Ropublic->__construct(Object(Request), Object(Response))
#4 /home/devjcat/www/public_html/application/classes/controller/public/category.php(6): Controller_Public_Page->__construct(Object(Request), Object(Response))
#5 /home/devjcat/www/public_html/application/classes/controller/public.php(9): Controller_Public_Category->__construct(Object(Request), Object(Response))
#6 [internal function]: Controller_Public->__construct(Object(Request), Object(Response))
#7 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(101): ReflectionClass->newInstance(Object(Request), Object(Response))
#8 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#10 /home/devjcat/www/public_html/index.php(109): Kohana_Request->execute()
#11 {main}
2015-01-03 13:08:22 --- ERROR: ErrorException [ 1 ]: Class 'Database_Mysqli' not found ~ MODPATH/database/classes/kohana/database.php [ 78 ]
2015-01-03 13:08:22 --- STRACE: ErrorException [ 1 ]: Class 'Database_Mysqli' not found ~ MODPATH/database/classes/kohana/database.php [ 78 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2015-01-03 13:08:45 --- ERROR: ErrorException [ 1 ]: Class 'Database_Mysqli' not found ~ MODPATH/database/classes/kohana/database.php [ 78 ]
2015-01-03 13:08:45 --- STRACE: ErrorException [ 1 ]: Class 'Database_Mysqli' not found ~ MODPATH/database/classes/kohana/database.php [ 78 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2015-01-03 13:09:11 --- ERROR: Database_Exception [ 8192 ]: mysql_connect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead ~ MODPATH/database/classes/kohana/database/mysql.php [ 67 ]
2015-01-03 13:09:11 --- STRACE: Database_Exception [ 8192 ]: mysql_connect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead ~ MODPATH/database/classes/kohana/database/mysql.php [ 67 ]
--
#0 /home/devjcat/www/public_html/modules/database/classes/kohana/database/mysql.php(171): Kohana_Database_MySQL->connect()
#1 /home/devjcat/www/public_html/modules/database/classes/kohana/database/mysql.php(358): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#2 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(1538): Kohana_Database_MySQL->list_columns('settings')
#3 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(392): Kohana_ORM->list_columns()
#4 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(337): Kohana_ORM->reload_columns()
#5 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(246): Kohana_ORM->_initialize()
#6 /home/devjcat/www/public_html/application/classes/orm.php(25): Kohana_ORM->__construct(NULL)
#7 /home/devjcat/www/public_html/application/classes/controller/public.php(12): ORM::factory('settings')
#8 [internal function]: Controller_Public->__construct(Object(Request), Object(Response))
#9 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(101): ReflectionClass->newInstance(Object(Request), Object(Response))
#10 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#12 /home/devjcat/www/public_html/index.php(109): Kohana_Request->execute()
#13 {main}
2015-01-03 13:09:25 --- ERROR: Kohana_Exception [ 0 ]: Database method list_columns is not supported by Kohana_Database_PDO ~ MODPATH/database/classes/kohana/database/pdo.php [ 241 ]
2015-01-03 13:09:25 --- STRACE: Kohana_Exception [ 0 ]: Database method list_columns is not supported by Kohana_Database_PDO ~ MODPATH/database/classes/kohana/database/pdo.php [ 241 ]
--
#0 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(1538): Kohana_Database_PDO->list_columns('settings')
#1 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(392): Kohana_ORM->list_columns()
#2 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(337): Kohana_ORM->reload_columns()
#3 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(246): Kohana_ORM->_initialize()
#4 /home/devjcat/www/public_html/application/classes/orm.php(25): Kohana_ORM->__construct(NULL)
#5 /home/devjcat/www/public_html/application/classes/controller/public.php(12): ORM::factory('settings')
#6 [internal function]: Controller_Public->__construct(Object(Request), Object(Response))
#7 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(101): ReflectionClass->newInstance(Object(Request), Object(Response))
#8 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#10 /home/devjcat/www/public_html/index.php(109): Kohana_Request->execute()
#11 {main}
2015-01-03 13:13:23 --- ERROR: ErrorException [ 1 ]: Class 'Database_PDO_MySQL' not found ~ MODPATH/database/classes/kohana/database.php [ 78 ]
2015-01-03 13:13:23 --- STRACE: ErrorException [ 1 ]: Class 'Database_PDO_MySQL' not found ~ MODPATH/database/classes/kohana/database.php [ 78 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2015-01-03 13:16:57 --- ERROR: Database_Exception [ 0 ]: invalid data source name ~ MODPATH/database/classes/kohana/database/pdo.php [ 59 ]
2015-01-03 13:16:57 --- STRACE: Database_Exception [ 0 ]: invalid data source name ~ MODPATH/database/classes/kohana/database/pdo.php [ 59 ]
--
#0 /home/devjcat/www/public_html/modules/database/classes/kohana/database/pdo.php(136): Kohana_Database_PDO->connect()
#1 /home/devjcat/www/public_html/modules/database/classes/database/pdo.php(18): Kohana_Database_PDO->query(1, 'SHOW FULL COLUM...', false)
#2 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(1538): Database_PDO->list_columns('settings')
#3 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(392): Kohana_ORM->list_columns()
#4 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(337): Kohana_ORM->reload_columns()
#5 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(246): Kohana_ORM->_initialize()
#6 /home/devjcat/www/public_html/application/classes/orm.php(25): Kohana_ORM->__construct(NULL)
#7 /home/devjcat/www/public_html/application/classes/controller/public.php(12): ORM::factory('settings')
#8 [internal function]: Controller_Public->__construct(Object(Request), Object(Response))
#9 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(101): ReflectionClass->newInstance(Object(Request), Object(Response))
#10 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#12 /home/devjcat/www/public_html/index.php(109): Kohana_Request->execute()
#13 {main}
2015-01-03 13:18:59 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected ',' ~ APPPATH/config/database.php [ 27 ]
2015-01-03 13:18:59 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected ',' ~ APPPATH/config/database.php [ 27 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2015-01-03 13:19:24 --- ERROR: View_Exception [ 0 ]: The requested view public/default/index could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
2015-01-03 13:19:24 --- STRACE: View_Exception [ 0 ]: The requested view public/default/index could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
--
#0 /home/devjcat/www/public_html/system/classes/kohana/view.php(137): Kohana_View->set_filename('public/default/...')
#1 /home/devjcat/www/public_html/system/classes/kohana/view.php(30): Kohana_View->__construct('public/default/...', NULL)
#2 /home/devjcat/www/public_html/system/classes/kohana/controller/template.php(33): Kohana_View::factory('public/default/...')
#3 [internal function]: Kohana_Controller_Template->before()
#4 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Controller_Public))
#5 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#7 /home/devjcat/www/public_html/index.php(109): Kohana_Request->execute()
#8 {main}
2015-01-03 13:20:09 --- ERROR: Database_Exception [ 42000 ]: SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'update FROM sx_pages AS sx_pages WHERE category = 0 AND url = '/'' at line 1 [ SELECT sx_pages.id AS id, sx_pages.title AS title, sx_pages.short_text AS short_text, sx_pages.text AS text, sx_pages.url AS url, sx_pages.cat_url AS cat_url, sx_pages.category AS category, sx_pages.meta_keywords AS meta_keywords, sx_pages.meta_description AS meta_description, sx_pages.template AS template, sx_pages.site_template AS site_template, sx_pages.author AS author, sx_pages.status AS status, sx_pages.comment AS comment, sx_pages.position AS position, sx_pages.date AS date, sx_pages.post_date AS post_date, sx_pages.update AS update FROM sx_pages AS sx_pages WHERE category = 0 AND url = '/' ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2015-01-03 13:20:09 --- STRACE: Database_Exception [ 42000 ]: SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'update FROM sx_pages AS sx_pages WHERE category = 0 AND url = '/'' at line 1 [ SELECT sx_pages.id AS id, sx_pages.title AS title, sx_pages.short_text AS short_text, sx_pages.text AS text, sx_pages.url AS url, sx_pages.cat_url AS cat_url, sx_pages.category AS category, sx_pages.meta_keywords AS meta_keywords, sx_pages.meta_description AS meta_description, sx_pages.template AS template, sx_pages.site_template AS site_template, sx_pages.author AS author, sx_pages.status AS status, sx_pages.comment AS comment, sx_pages.position AS position, sx_pages.date AS date, sx_pages.post_date AS post_date, sx_pages.update AS update FROM sx_pages AS sx_pages WHERE category = 0 AND url = '/' ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /home/devjcat/www/public_html/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'SELECT sx_pages...', 'Model_Pages', Array)
#1 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(993): Kohana_Database_Query->execute(Object(Database_PDO))
#2 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(934): Kohana_ORM->_load_result(true)
#3 /home/devjcat/www/public_html/application/classes/controller/public.php(168): Kohana_ORM->find_all()
#4 [internal function]: Controller_Public->action_route()
#5 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Public))
#6 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#8 /home/devjcat/www/public_html/index.php(109): Kohana_Request->execute()
#9 {main}
2015-01-03 14:55:01 --- ERROR: ErrorException [ 8192 ]: preg_replace(): The /e modifier is deprecated, use preg_replace_callback instead ~ MODPATH/database/classes/kohana/database.php [ 530 ]
2015-01-03 14:55:01 --- STRACE: ErrorException [ 8192 ]: preg_replace(): The /e modifier is deprecated, use preg_replace_callback instead ~ MODPATH/database/classes/kohana/database.php [ 530 ]
--
#0 [internal function]: Kohana_Core::error_handler(8192, 'preg_replace():...', '/home/devjcat/w...', 530, Array)
#1 /home/devjcat/www/public_html/modules/database/classes/kohana/database.php(530): preg_replace('/"(.+?)"/e', '$this->quote_co...', 'COUNT("*")')
#2 [internal function]: Kohana_Database->quote_column(Array)
#3 /home/devjcat/www/public_html/modules/database/classes/kohana/database/query/builder/select.php(348): array_map(Array, Array)
#4 /home/devjcat/www/public_html/modules/database/classes/kohana/database/query.php(228): Kohana_Database_Query_Builder_Select->compile(Object(Database_PDO))
#5 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(1413): Kohana_Database_Query->execute(Object(Database_PDO))
#6 /home/devjcat/www/public_html/modules/orm/classes/kohana/auth/orm.php(86): Kohana_ORM->has('roles', Object(Model_Role))
#7 /home/devjcat/www/public_html/modules/auth/classes/kohana/auth.php(92): Kohana_Auth_ORM->_login('zeloras@gmail.c...', 'shadowz6x', false)
#8 /home/devjcat/www/public_html/application/classes/model/admin/auth.php(14): Kohana_Auth->login('zeloras@gmail.c...', 'shadowz6x', false)
#9 /home/devjcat/www/public_html/application/classes/controller/admin/auth.php(32): Model_Admin_Auth->admin_auth()
#10 /home/devjcat/www/public_html/application/classes/controller/admin.php(38): Controller_Admin_Auth->admin_auth()
#11 [internal function]: Controller_Admin->action_route()
#12 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Admin))
#13 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#14 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#15 /home/devjcat/www/public_html/index.php(109): Kohana_Request->execute()
#16 {main}
2015-01-03 15:02:05 --- ERROR: Database_Exception [ 42000 ]: SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'update FROM sx_pages AS sx_pages WHERE category = 0 AND url = '/'' at line 1 [ SELECT sx_pages.id AS id, sx_pages.title AS title, sx_pages.short_text AS short_text, sx_pages.text AS text, sx_pages.url AS url, sx_pages.cat_url AS cat_url, sx_pages.category AS category, sx_pages.meta_keywords AS meta_keywords, sx_pages.meta_description AS meta_description, sx_pages.template AS template, sx_pages.site_template AS site_template, sx_pages.author AS author, sx_pages.status AS status, sx_pages.comment AS comment, sx_pages.position AS position, sx_pages.date AS date, sx_pages.post_date AS post_date, sx_pages.update AS update FROM sx_pages AS sx_pages WHERE category = 0 AND url = '/' ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2015-01-03 15:02:05 --- STRACE: Database_Exception [ 42000 ]: SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'update FROM sx_pages AS sx_pages WHERE category = 0 AND url = '/'' at line 1 [ SELECT sx_pages.id AS id, sx_pages.title AS title, sx_pages.short_text AS short_text, sx_pages.text AS text, sx_pages.url AS url, sx_pages.cat_url AS cat_url, sx_pages.category AS category, sx_pages.meta_keywords AS meta_keywords, sx_pages.meta_description AS meta_description, sx_pages.template AS template, sx_pages.site_template AS site_template, sx_pages.author AS author, sx_pages.status AS status, sx_pages.comment AS comment, sx_pages.position AS position, sx_pages.date AS date, sx_pages.post_date AS post_date, sx_pages.update AS update FROM sx_pages AS sx_pages WHERE category = 0 AND url = '/' ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /home/devjcat/www/public_html/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'SELECT sx_pages...', 'Model_Pages', Array)
#1 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(993): Kohana_Database_Query->execute(Object(Database_PDO))
#2 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(934): Kohana_ORM->_load_result(true)
#3 /home/devjcat/www/public_html/application/classes/controller/public.php(168): Kohana_ORM->find_all()
#4 [internal function]: Controller_Public->action_route()
#5 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Public))
#6 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#8 /home/devjcat/www/public_html/index.php(109): Kohana_Request->execute()
#9 {main}
2015-01-03 15:02:12 --- ERROR: Database_Exception [ 42000 ]: SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'update FROM sx_pages AS sx_pages WHERE category = 0 AND url = '/'' at line 1 [ SELECT sx_pages.id AS id, sx_pages.title AS title, sx_pages.short_text AS short_text, sx_pages.text AS text, sx_pages.url AS url, sx_pages.cat_url AS cat_url, sx_pages.category AS category, sx_pages.meta_keywords AS meta_keywords, sx_pages.meta_description AS meta_description, sx_pages.template AS template, sx_pages.site_template AS site_template, sx_pages.author AS author, sx_pages.status AS status, sx_pages.comment AS comment, sx_pages.position AS position, sx_pages.date AS date, sx_pages.post_date AS post_date, sx_pages.update AS update FROM sx_pages AS sx_pages WHERE category = 0 AND url = '/' ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2015-01-03 15:02:12 --- STRACE: Database_Exception [ 42000 ]: SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'update FROM sx_pages AS sx_pages WHERE category = 0 AND url = '/'' at line 1 [ SELECT sx_pages.id AS id, sx_pages.title AS title, sx_pages.short_text AS short_text, sx_pages.text AS text, sx_pages.url AS url, sx_pages.cat_url AS cat_url, sx_pages.category AS category, sx_pages.meta_keywords AS meta_keywords, sx_pages.meta_description AS meta_description, sx_pages.template AS template, sx_pages.site_template AS site_template, sx_pages.author AS author, sx_pages.status AS status, sx_pages.comment AS comment, sx_pages.position AS position, sx_pages.date AS date, sx_pages.post_date AS post_date, sx_pages.update AS update FROM sx_pages AS sx_pages WHERE category = 0 AND url = '/' ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /home/devjcat/www/public_html/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'SELECT sx_pages...', 'Model_Pages', Array)
#1 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(993): Kohana_Database_Query->execute(Object(Database_PDO))
#2 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(934): Kohana_ORM->_load_result(true)
#3 /home/devjcat/www/public_html/application/classes/controller/public.php(168): Kohana_ORM->find_all()
#4 [internal function]: Controller_Public->action_route()
#5 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Public))
#6 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#8 /home/devjcat/www/public_html/index.php(109): Kohana_Request->execute()
#9 {main}
2015-01-03 15:03:59 --- ERROR: Kohana_Exception [ 0 ]: Database method list_columns is not supported by Kohana_Database_PDO ~ MODPATH/database/classes/kohana/database/pdo.php [ 241 ]
2015-01-03 15:03:59 --- STRACE: Kohana_Exception [ 0 ]: Database method list_columns is not supported by Kohana_Database_PDO ~ MODPATH/database/classes/kohana/database/pdo.php [ 241 ]
--
#0 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(1538): Kohana_Database_PDO->list_columns('settings')
#1 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(392): Kohana_ORM->list_columns()
#2 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(337): Kohana_ORM->reload_columns()
#3 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(246): Kohana_ORM->_initialize()
#4 /home/devjcat/www/public_html/application/classes/orm.php(25): Kohana_ORM->__construct(NULL)
#5 /home/devjcat/www/public_html/application/classes/controller/public.php(12): ORM::factory('settings')
#6 [internal function]: Controller_Public->__construct(Object(Request), Object(Response))
#7 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(101): ReflectionClass->newInstance(Object(Request), Object(Response))
#8 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#10 /home/devjcat/www/public_html/index.php(109): Kohana_Request->execute()
#11 {main}
2015-01-03 15:10:21 --- ERROR: ErrorException [ 1 ]: Class 'Database_MySQLi' not found ~ MODPATH/database/classes/kohana/database.php [ 78 ]
2015-01-03 15:10:21 --- STRACE: ErrorException [ 1 ]: Class 'Database_MySQLi' not found ~ MODPATH/database/classes/kohana/database.php [ 78 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2015-01-03 15:10:38 --- ERROR: ErrorException [ 1 ]: Class 'Database_Mysqli' not found ~ MODPATH/database/classes/kohana/database.php [ 78 ]
2015-01-03 15:10:38 --- STRACE: ErrorException [ 1 ]: Class 'Database_Mysqli' not found ~ MODPATH/database/classes/kohana/database.php [ 78 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2015-01-03 15:10:39 --- ERROR: ErrorException [ 1 ]: Class 'Database_Mysqli' not found ~ MODPATH/database/classes/kohana/database.php [ 78 ]
2015-01-03 15:10:39 --- STRACE: ErrorException [ 1 ]: Class 'Database_Mysqli' not found ~ MODPATH/database/classes/kohana/database.php [ 78 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2015-01-03 15:13:27 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'COUNT("*")' in 'field list' [ SELECT `COUNT("*")` AS `records_found` FROM `sx_modules` AS `sx_modules` WHERE `dir` = '' AND `active` = 1 AND `site` = 1 ] ~ MODPATH/database/classes/database/mysqli.php [ 174 ]
2015-01-03 15:13:27 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'COUNT("*")' in 'field list' [ SELECT `COUNT("*")` AS `records_found` FROM `sx_modules` AS `sx_modules` WHERE `dir` = '' AND `active` = 1 AND `site` = 1 ] ~ MODPATH/database/classes/database/mysqli.php [ 174 ]
--
#0 /home/devjcat/www/public_html/modules/database/classes/kohana/database/query.php(245): Database_Mysqli->query(1, 'SELECT `COUNT("...', false, Array)
#1 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(1518): Kohana_Database_Query->execute(Object(Database_Mysqli))
#2 /home/devjcat/www/public_html/application/classes/controller/public.php(201): Kohana_ORM->count_all()
#3 /home/devjcat/www/public_html/application/classes/controller/public.php(171): Controller_Public->page_modules()
#4 [internal function]: Controller_Public->action_route()
#5 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Public))
#6 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#8 /home/devjcat/www/public_html/index.php(109): Kohana_Request->execute()
#9 {main}
2015-01-03 15:20:37 --- ERROR: ErrorException [ 4096 ]: Argument 2 passed to Kohana_Request::factory() must be an instance of HTTP_Cache, array given, called in /home/devjcat/www/public_html/index.php on line 117 and defined ~ SYSPATH/classes/kohana/request.php [ 56 ]
2015-01-03 15:20:37 --- STRACE: ErrorException [ 4096 ]: Argument 2 passed to Kohana_Request::factory() must be an instance of HTTP_Cache, array given, called in /home/devjcat/www/public_html/index.php on line 117 and defined ~ SYSPATH/classes/kohana/request.php [ 56 ]
--
#0 /home/devjcat/www/public_html/system/classes/kohana/request.php(56): Kohana_Core::error_handler(4096, 'Argument 2 pass...', '/home/devjcat/w...', 56, Array)
#1 /home/devjcat/www/public_html/index.php(117): Kohana_Request::factory(true, Array, false)
#2 {main}
2015-01-03 15:23:07 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'COUNT("*")' in 'field list' [ SELECT `COUNT("*")` AS `records_found` FROM `sx_modules` AS `sx_modules` WHERE `dir` = '' AND `active` = 1 AND `site` = 1 ] ~ MODPATH/database/classes/database/mysqli.php [ 174 ]
2015-01-03 15:23:07 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'COUNT("*")' in 'field list' [ SELECT `COUNT("*")` AS `records_found` FROM `sx_modules` AS `sx_modules` WHERE `dir` = '' AND `active` = 1 AND `site` = 1 ] ~ MODPATH/database/classes/database/mysqli.php [ 174 ]
--
#0 /home/devjcat/www/public_html/modules/database/classes/kohana/database/query.php(245): Database_Mysqli->query(1, 'SELECT `COUNT("...', false, Array)
#1 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(1518): Kohana_Database_Query->execute(Object(Database_Mysqli))
#2 /home/devjcat/www/public_html/application/classes/controller/public.php(201): Kohana_ORM->count_all()
#3 /home/devjcat/www/public_html/application/classes/controller/public.php(171): Controller_Public->page_modules()
#4 [internal function]: Controller_Public->action_route()
#5 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Public))
#6 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#8 /home/devjcat/www/public_html/index.php(118): Kohana_Request->execute()
#9 {main}
2015-01-03 15:30:01 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'COUNT("*")' in 'field list' [ SELECT `COUNT("*")` AS `records_found` FROM `sx_roles_users` WHERE `user_id` = '1' AND `role_id` IN ('1') ] ~ MODPATH/database/classes/database/mysqli.php [ 174 ]
2015-01-03 15:30:01 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'COUNT("*")' in 'field list' [ SELECT `COUNT("*")` AS `records_found` FROM `sx_roles_users` WHERE `user_id` = '1' AND `role_id` IN ('1') ] ~ MODPATH/database/classes/database/mysqli.php [ 174 ]
--
#0 /home/devjcat/www/public_html/modules/database/classes/kohana/database/query.php(245): Database_Mysqli->query(1, 'SELECT `COUNT("...', false, Array)
#1 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(1413): Kohana_Database_Query->execute(Object(Database_Mysqli))
#2 /home/devjcat/www/public_html/modules/orm/classes/kohana/auth/orm.php(86): Kohana_ORM->has('roles', Object(Model_Role))
#3 /home/devjcat/www/public_html/modules/auth/classes/kohana/auth.php(92): Kohana_Auth_ORM->_login('zeloras@gmail.c...', 'shadowz6x', false)
#4 /home/devjcat/www/public_html/application/classes/model/admin/auth.php(14): Kohana_Auth->login('zeloras@gmail.c...', 'shadowz6x', false)
#5 /home/devjcat/www/public_html/application/classes/controller/admin/auth.php(32): Model_Admin_Auth->admin_auth()
#6 /home/devjcat/www/public_html/application/classes/controller/admin.php(38): Controller_Admin_Auth->admin_auth()
#7 [internal function]: Controller_Admin->action_route()
#8 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Admin))
#9 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#10 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#11 /home/devjcat/www/public_html/index.php(118): Kohana_Request->execute()
#12 {main}
2015-01-03 15:30:12 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'COUNT("*")' in 'field list' [ SELECT `COUNT("*")` AS `records_found` FROM `sx_roles_users` WHERE `user_id` = '1' AND `role_id` IN ('1') ] ~ MODPATH/database/classes/database/mysqli.php [ 174 ]
2015-01-03 15:30:12 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'COUNT("*")' in 'field list' [ SELECT `COUNT("*")` AS `records_found` FROM `sx_roles_users` WHERE `user_id` = '1' AND `role_id` IN ('1') ] ~ MODPATH/database/classes/database/mysqli.php [ 174 ]
--
#0 /home/devjcat/www/public_html/modules/database/classes/kohana/database/query.php(245): Database_Mysqli->query(1, 'SELECT `COUNT("...', false, Array)
#1 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(1413): Kohana_Database_Query->execute(Object(Database_Mysqli))
#2 /home/devjcat/www/public_html/modules/orm/classes/kohana/auth/orm.php(86): Kohana_ORM->has('roles', Object(Model_Role))
#3 /home/devjcat/www/public_html/modules/auth/classes/kohana/auth.php(92): Kohana_Auth_ORM->_login('zeloras@gmail.c...', 'shadowz6x', false)
#4 /home/devjcat/www/public_html/application/classes/model/admin/auth.php(14): Kohana_Auth->login('zeloras@gmail.c...', 'shadowz6x', false)
#5 /home/devjcat/www/public_html/application/classes/controller/admin/auth.php(32): Model_Admin_Auth->admin_auth()
#6 /home/devjcat/www/public_html/application/classes/controller/admin.php(38): Controller_Admin_Auth->admin_auth()
#7 [internal function]: Controller_Admin->action_route()
#8 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Admin))
#9 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#10 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#11 /home/devjcat/www/public_html/index.php(118): Kohana_Request->execute()
#12 {main}
2015-01-03 16:05:31 --- ERROR: Database_Exception [ 2 ]: mysqli_connect(): (HY000/2002): Can't connect to local MySQL server through socket '/var/run/mysqld/mysqld.sock' (2) ~ MODPATH/database/classes/database/mysqli.php [ 59 ]
2015-01-03 16:05:31 --- ERROR: Database_Exception [ 2 ]: mysqli_connect(): (HY000/2002): Can't connect to local MySQL server through socket '/var/run/mysqld/mysqld.sock' (2) ~ MODPATH/database/classes/database/mysqli.php [ 59 ]
2015-01-03 16:05:31 --- ERROR: Database_Exception [ 2 ]: mysqli_connect(): (HY000/2002): Can't connect to local MySQL server through socket '/var/run/mysqld/mysqld.sock' (2) ~ MODPATH/database/classes/database/mysqli.php [ 59 ]
2015-01-03 16:05:31 --- STRACE: Database_Exception [ 2 ]: mysqli_connect(): (HY000/2002): Can't connect to local MySQL server through socket '/var/run/mysqld/mysqld.sock' (2) ~ MODPATH/database/classes/database/mysqli.php [ 59 ]
--
#0 /home/devjcat/www/public_html/modules/database/classes/database/mysqli.php(157): Database_Mysqli->connect()
#1 /home/devjcat/www/public_html/modules/database/classes/database/mysqli.php(338): Database_Mysqli->query(1, 'SHOW FULL COLUM...', false)
#2 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(1538): Database_Mysqli->list_columns('settings')
#3 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(392): Kohana_ORM->list_columns()
#4 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(337): Kohana_ORM->reload_columns()
#5 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(246): Kohana_ORM->_initialize()
#6 /home/devjcat/www/public_html/application/classes/orm.php(25): Kohana_ORM->__construct(NULL)
#7 /home/devjcat/www/public_html/application/classes/controller/admin.php(16): ORM::factory('settings')
#8 [internal function]: Controller_Admin->__construct(Object(Request), Object(Response))
#9 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(101): ReflectionClass->newInstance(Object(Request), Object(Response))
#10 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#12 /home/devjcat/www/public_html/index.php(118): Kohana_Request->execute()
#13 {main}
2015-01-03 16:05:31 --- STRACE: Database_Exception [ 2 ]: mysqli_connect(): (HY000/2002): Can't connect to local MySQL server through socket '/var/run/mysqld/mysqld.sock' (2) ~ MODPATH/database/classes/database/mysqli.php [ 59 ]
--
#0 /home/devjcat/www/public_html/modules/database/classes/database/mysqli.php(157): Database_Mysqli->connect()
#1 /home/devjcat/www/public_html/modules/database/classes/database/mysqli.php(338): Database_Mysqli->query(1, 'SHOW FULL COLUM...', false)
#2 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(1538): Database_Mysqli->list_columns('settings')
#3 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(392): Kohana_ORM->list_columns()
#4 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(337): Kohana_ORM->reload_columns()
#5 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(246): Kohana_ORM->_initialize()
#6 /home/devjcat/www/public_html/application/classes/orm.php(25): Kohana_ORM->__construct(NULL)
#7 /home/devjcat/www/public_html/application/classes/controller/admin.php(16): ORM::factory('settings')
#8 [internal function]: Controller_Admin->__construct(Object(Request), Object(Response))
#9 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(101): ReflectionClass->newInstance(Object(Request), Object(Response))
#10 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#12 /home/devjcat/www/public_html/index.php(118): Kohana_Request->execute()
#13 {main}
2015-01-03 16:05:31 --- STRACE: Database_Exception [ 2 ]: mysqli_connect(): (HY000/2002): Can't connect to local MySQL server through socket '/var/run/mysqld/mysqld.sock' (2) ~ MODPATH/database/classes/database/mysqli.php [ 59 ]
--
#0 /home/devjcat/www/public_html/modules/database/classes/database/mysqli.php(157): Database_Mysqli->connect()
#1 /home/devjcat/www/public_html/modules/database/classes/database/mysqli.php(338): Database_Mysqli->query(1, 'SHOW FULL COLUM...', false)
#2 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(1538): Database_Mysqli->list_columns('settings')
#3 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(392): Kohana_ORM->list_columns()
#4 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(337): Kohana_ORM->reload_columns()
#5 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(246): Kohana_ORM->_initialize()
#6 /home/devjcat/www/public_html/application/classes/orm.php(25): Kohana_ORM->__construct(NULL)
#7 /home/devjcat/www/public_html/application/classes/controller/admin.php(16): ORM::factory('settings')
#8 [internal function]: Controller_Admin->__construct(Object(Request), Object(Response))
#9 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(101): ReflectionClass->newInstance(Object(Request), Object(Response))
#10 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#12 /home/devjcat/www/public_html/index.php(118): Kohana_Request->execute()
#13 {main}
2015-01-03 17:46:59 --- ERROR: ErrorException [ 2 ]: file_get_contents(): php_network_getaddresses: getaddrinfo failed: Name or service not known ~ APPPATH/classes/helper/admin.php [ 175 ]
2015-01-03 17:46:59 --- STRACE: ErrorException [ 2 ]: file_get_contents(): php_network_getaddresses: getaddrinfo failed: Name or service not known ~ APPPATH/classes/helper/admin.php [ 175 ]
--
#0 [internal function]: Kohana_Core::error_handler(2, 'file_get_conten...', '/home/devjcat/w...', 175, Array)
#1 /home/devjcat/www/public_html/application/classes/helper/admin.php(175): file_get_contents('http://sxservic...')
#2 /home/devjcat/www/public_html/application/classes/controller/admin/index.php(16): Helper_Admin::get_system_info()
#3 /home/devjcat/www/public_html/application/classes/controller/admin.php(52): Controller_Admin_Index->index_admin()
#4 [internal function]: Controller_Admin->action_route()
#5 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Admin))
#6 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#8 /home/devjcat/www/public_html/index.php(118): Kohana_Request->execute()
#9 {main}
2015-01-03 17:48:31 --- ERROR: Kohana_Exception [ 0 ]: Cannot update roles model because it is not loaded. ~ MODPATH/orm/classes/kohana/orm.php [ 1284 ]
2015-01-03 17:48:31 --- STRACE: Kohana_Exception [ 0 ]: Cannot update roles model because it is not loaded. ~ MODPATH/orm/classes/kohana/orm.php [ 1284 ]
--
#0 /home/devjcat/www/public_html/application/classes/base.php(19): Kohana_ORM->update()
#1 /home/devjcat/www/public_html/application/classes/controller/admin.php(20): Base->get_access()
#2 [internal function]: Controller_Admin->__construct(Object(Request), Object(Response))
#3 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(101): ReflectionClass->newInstance(Object(Request), Object(Response))
#4 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#6 /home/devjcat/www/public_html/index.php(118): Kohana_Request->execute()
#7 {main}
2015-01-03 17:49:14 --- ERROR: Kohana_Exception [ 0 ]: Cannot update roles model because it is not loaded. ~ MODPATH/orm/classes/kohana/orm.php [ 1284 ]
2015-01-03 17:49:14 --- STRACE: Kohana_Exception [ 0 ]: Cannot update roles model because it is not loaded. ~ MODPATH/orm/classes/kohana/orm.php [ 1284 ]
--
#0 /home/devjcat/www/public_html/application/classes/base.php(19): Kohana_ORM->update()
#1 /home/devjcat/www/public_html/application/classes/controller/admin.php(20): Base->get_access()
#2 [internal function]: Controller_Admin->__construct(Object(Request), Object(Response))
#3 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(101): ReflectionClass->newInstance(Object(Request), Object(Response))
#4 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#6 /home/devjcat/www/public_html/index.php(118): Kohana_Request->execute()
#7 {main}
2015-01-03 17:51:09 --- ERROR: Kohana_Exception [ 0 ]: Cannot update roles model because it is not loaded. ~ MODPATH/orm/classes/kohana/orm.php [ 1284 ]
2015-01-03 17:51:09 --- STRACE: Kohana_Exception [ 0 ]: Cannot update roles model because it is not loaded. ~ MODPATH/orm/classes/kohana/orm.php [ 1284 ]
--
#0 /home/devjcat/www/public_html/application/classes/base.php(19): Kohana_ORM->update()
#1 /home/devjcat/www/public_html/application/classes/controller/admin.php(20): Base->get_access()
#2 [internal function]: Controller_Admin->__construct(Object(Request), Object(Response))
#3 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(101): ReflectionClass->newInstance(Object(Request), Object(Response))
#4 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#6 /home/devjcat/www/public_html/index.php(118): Kohana_Request->execute()
#7 {main}
2015-01-03 17:51:11 --- ERROR: Kohana_Exception [ 0 ]: Cannot update roles model because it is not loaded. ~ MODPATH/orm/classes/kohana/orm.php [ 1284 ]
2015-01-03 17:51:11 --- STRACE: Kohana_Exception [ 0 ]: Cannot update roles model because it is not loaded. ~ MODPATH/orm/classes/kohana/orm.php [ 1284 ]
--
#0 /home/devjcat/www/public_html/application/classes/base.php(19): Kohana_ORM->update()
#1 /home/devjcat/www/public_html/application/classes/controller/admin.php(20): Base->get_access()
#2 [internal function]: Controller_Admin->__construct(Object(Request), Object(Response))
#3 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(101): ReflectionClass->newInstance(Object(Request), Object(Response))
#4 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#6 /home/devjcat/www/public_html/index.php(118): Kohana_Request->execute()
#7 {main}
2015-01-03 17:51:19 --- ERROR: Database_Exception [ 1241 ]: Operand should contain 1 column(s) [ UPDATE `sx_roles` SET `access` = ('11', '12', '13', '14', '21', '22', '23', '24', '31', '32', '33', '34', '41', '42', '43', '44', '51', '52', '53', '54', '61', '62', '63', 71) WHERE `id` = '1' ] ~ MODPATH/database/classes/database/mysqli.php [ 174 ]
2015-01-03 17:51:19 --- STRACE: Database_Exception [ 1241 ]: Operand should contain 1 column(s) [ UPDATE `sx_roles` SET `access` = ('11', '12', '13', '14', '21', '22', '23', '24', '31', '32', '33', '34', '41', '42', '43', '44', '51', '52', '53', '54', '61', '62', '63', 71) WHERE `id` = '1' ] ~ MODPATH/database/classes/database/mysqli.php [ 174 ]
--
#0 /home/devjcat/www/public_html/modules/database/classes/kohana/database/query.php(245): Database_Mysqli->query(3, 'UPDATE `sx_role...', false, Array)
#1 /home/devjcat/www/public_html/modules/orm/classes/kohana/orm.php(1321): Kohana_Database_Query->execute(Object(Database_Mysqli))
#2 /home/devjcat/www/public_html/application/classes/base.php(21): Kohana_ORM->update()
#3 /home/devjcat/www/public_html/application/classes/controller/admin.php(20): Base->get_access()
#4 [internal function]: Controller_Admin->__construct(Object(Request), Object(Response))
#5 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(101): ReflectionClass->newInstance(Object(Request), Object(Response))
#6 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#8 /home/devjcat/www/public_html/index.php(118): Kohana_Request->execute()
#9 {main}
2015-01-03 17:51:40 --- ERROR: ErrorException [ 2 ]: file_get_contents(): php_network_getaddresses: getaddrinfo failed: Name or service not known ~ APPPATH/classes/helper/admin.php [ 175 ]
2015-01-03 17:51:40 --- STRACE: ErrorException [ 2 ]: file_get_contents(): php_network_getaddresses: getaddrinfo failed: Name or service not known ~ APPPATH/classes/helper/admin.php [ 175 ]
--
#0 [internal function]: Kohana_Core::error_handler(2, 'file_get_conten...', '/home/devjcat/w...', 175, Array)
#1 /home/devjcat/www/public_html/application/classes/helper/admin.php(175): file_get_contents('http://sxservic...')
#2 /home/devjcat/www/public_html/application/classes/controller/admin/index.php(16): Helper_Admin::get_system_info()
#3 /home/devjcat/www/public_html/application/classes/controller/admin.php(52): Controller_Admin_Index->index_admin()
#4 [internal function]: Controller_Admin->action_route()
#5 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Admin))
#6 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#8 /home/devjcat/www/public_html/index.php(118): Kohana_Request->execute()
#9 {main}
2015-01-03 17:51:50 --- ERROR: ErrorException [ 2 ]: file_get_contents(): php_network_getaddresses: getaddrinfo failed: Name or service not known ~ APPPATH/classes/helper/admin.php [ 175 ]
2015-01-03 17:51:50 --- STRACE: ErrorException [ 2 ]: file_get_contents(): php_network_getaddresses: getaddrinfo failed: Name or service not known ~ APPPATH/classes/helper/admin.php [ 175 ]
--
#0 [internal function]: Kohana_Core::error_handler(2, 'file_get_conten...', '/home/devjcat/w...', 175, Array)
#1 /home/devjcat/www/public_html/application/classes/helper/admin.php(175): file_get_contents('http://sxservic...')
#2 /home/devjcat/www/public_html/application/classes/controller/admin/index.php(16): Helper_Admin::get_system_info()
#3 /home/devjcat/www/public_html/application/classes/controller/admin.php(52): Controller_Admin_Index->index_admin()
#4 [internal function]: Controller_Admin->action_route()
#5 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Admin))
#6 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#8 /home/devjcat/www/public_html/index.php(118): Kohana_Request->execute()
#9 {main}
2015-01-03 18:08:05 --- ERROR: ErrorException [ 2 ]: unlink(/home/devjcat/www/public_html/uploads/backup/3123123): No such file or directory ~ APPPATH/classes/controller/admin/settings.php [ 96 ]
2015-01-03 18:08:05 --- STRACE: ErrorException [ 2 ]: unlink(/home/devjcat/www/public_html/uploads/backup/3123123): No such file or directory ~ APPPATH/classes/controller/admin/settings.php [ 96 ]
--
#0 [internal function]: Kohana_Core::error_handler(2, 'unlink(/home/de...', '/home/devjcat/w...', 96, Array)
#1 /home/devjcat/www/public_html/application/classes/controller/admin/settings.php(96): unlink('/home/devjcat/w...')
#2 /home/devjcat/www/public_html/application/classes/controller/admin.php(452): Controller_Admin_Settings->settings('settings', 0)
#3 /home/devjcat/www/public_html/application/classes/controller/admin.php(48): Controller_Admin->routes('settings')
#4 [internal function]: Controller_Admin->action_route()
#5 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Admin))
#6 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#8 /home/devjcat/www/public_html/index.php(118): Kohana_Request->execute()
#9 {main}
2015-01-03 18:15:06 --- ERROR: ErrorException [ 2048 ]: Resource ID#4 used as offset, casting to integer (4) ~ APPPATH/classes/model/libs/webdev.php [ 1174 ]
2015-01-03 18:15:06 --- STRACE: ErrorException [ 2048 ]: Resource ID#4 used as offset, casting to integer (4) ~ APPPATH/classes/model/libs/webdev.php [ 1174 ]
--
#0 /home/devjcat/www/public_html/application/classes/model/libs/webdev.php(1174): Kohana_Core::error_handler(2048, 'Resource ID#4 u...', '/home/devjcat/w...', 1174, Array)
#1 [internal function]: Model_Libs_Webdev->_propfind_startElement(Resource id #4, 'DAV::multistatu...', Array)
#2 /home/devjcat/www/public_html/application/classes/model/libs/webdev.php(909): xml_parse(Resource id #4, '<?xml version="...')
#3 /home/devjcat/www/public_html/application/classes/model/libs/api.php(49): Model_Libs_Webdev->ls('/')
#4 /home/devjcat/www/public_html/application/classes/controller/admin/special.php(309): Model_Libs_Api->webdev_connect('n.ponich', 'kolia9028', 'yandex')
#5 /home/devjcat/www/public_html/application/classes/controller/admin.php(602): Controller_Admin_Special->ajaxCloudCheckConnect('yandex')
#6 /home/devjcat/www/public_html/application/classes/controller/admin.php(48): Controller_Admin->routes('syscom/ajax_clo...')
#7 [internal function]: Controller_Admin->action_route()
#8 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Admin))
#9 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#10 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#11 /home/devjcat/www/public_html/index.php(118): Kohana_Request->execute()
#12 {main}
2015-01-03 18:15:39 --- ERROR: ErrorException [ 2048 ]: Resource ID#4 used as offset, casting to integer (4) ~ APPPATH/classes/model/libs/webdev.php [ 1174 ]
2015-01-03 18:15:39 --- STRACE: ErrorException [ 2048 ]: Resource ID#4 used as offset, casting to integer (4) ~ APPPATH/classes/model/libs/webdev.php [ 1174 ]
--
#0 /home/devjcat/www/public_html/application/classes/model/libs/webdev.php(1174): Kohana_Core::error_handler(2048, 'Resource ID#4 u...', '/home/devjcat/w...', 1174, Array)
#1 [internal function]: Model_Libs_Webdev->_propfind_startElement(Resource id #4, 'DAV::multistatu...', Array)
#2 /home/devjcat/www/public_html/application/classes/model/libs/webdev.php(909): xml_parse(Resource id #4, '<?xml version="...')
#3 /home/devjcat/www/public_html/application/classes/model/libs/api.php(49): Model_Libs_Webdev->ls('/')
#4 /home/devjcat/www/public_html/application/classes/controller/admin/special.php(309): Model_Libs_Api->webdev_connect('n.ponich', 'kolia9028', 'yandex')
#5 /home/devjcat/www/public_html/application/classes/controller/admin.php(602): Controller_Admin_Special->ajaxCloudCheckConnect('yandex')
#6 /home/devjcat/www/public_html/application/classes/controller/admin.php(48): Controller_Admin->routes('syscom/ajax_clo...')
#7 [internal function]: Controller_Admin->action_route()
#8 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Admin))
#9 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#10 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#11 /home/devjcat/www/public_html/index.php(118): Kohana_Request->execute()
#12 {main}
2015-01-03 18:16:53 --- ERROR: ErrorException [ 2 ]: unlink(/home/devjcat/www/public_html/uploads/backup/.tmb): Is a directory ~ APPPATH/classes/controller/admin/settings.php [ 96 ]
2015-01-03 18:16:53 --- STRACE: ErrorException [ 2 ]: unlink(/home/devjcat/www/public_html/uploads/backup/.tmb): Is a directory ~ APPPATH/classes/controller/admin/settings.php [ 96 ]
--
#0 [internal function]: Kohana_Core::error_handler(2, 'unlink(/home/de...', '/home/devjcat/w...', 96, Array)
#1 /home/devjcat/www/public_html/application/classes/controller/admin/settings.php(96): unlink('/home/devjcat/w...')
#2 /home/devjcat/www/public_html/application/classes/controller/admin.php(452): Controller_Admin_Settings->settings('settings', 0)
#3 /home/devjcat/www/public_html/application/classes/controller/admin.php(48): Controller_Admin->routes('settings')
#4 [internal function]: Controller_Admin->action_route()
#5 /home/devjcat/www/public_html/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Admin))
#6 /home/devjcat/www/public_html/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /home/devjcat/www/public_html/system/classes/kohana/request.php(1164): Kohana_Request_Client->execute(Object(Request))
#8 /home/devjcat/www/public_html/index.php(118): Kohana_Request->execute()
#9 {main}