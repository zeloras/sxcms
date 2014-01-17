<?php defined('SYSPATH') or die('No direct access allowed.');

return array(

	'driver'       => 'orm',
	'hash_method'  => 'sha256',
	'hash_key'     => '1,3,4,9,12,15,20,21,43,66,99,666',
	'lifetime'     => 1209600,
	'session_type' => Session::$default,
	'session_key'  => 'auth_user',

	// Username/password combinations for the Auth File driver
	'users' => array(
		// 'admin' => 'b3154acf3a344170077d11bdb5fff31532f679a1919e716a02',
	),

);
