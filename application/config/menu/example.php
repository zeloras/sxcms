<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
        'driver' => 'database', // you can use 'database' or 'file', database uses ORM driver
	'view' => 'menu', // the view file
	'current_class' => 'current', // the set_current() method uses this setting to mark the current menu item

);