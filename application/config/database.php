<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
	'default' => array
	(
		'type'       => 'MySQLi',
		'connection' => array(
			/**
			 * The following options are available for MySQL:
			 *
			 * string   hostname     server hostname, or socket
			 * string   database     database name
			 * string   username     database username
			 * string   password     database password
			 * boolean  persistent   use persistent connections?
			 * array    variables    system variables as "key => value" pairs
			 *
			 * Ports and sockets may be appended to the hostname.
			 */
                        
                        'hostname'   => 'localhost',
			'database'   => 'root_sxcms',
			'username'   => 'direx',
			'password'   => '123123',
                        'port'       => NULL,
                        'socket'     => NULL
                ),
		'table_prefix' => 'sx_',
		'charset'      => 'utf8',
		'caching'      => FALSE,
	),
	'alternative' => array(
		'type'       => 'pdo',
		'connection' => array(
			/**
			 * The following options are available for PDO:
			 *
			 * string   dsn         Data Source Name
			 * string   username    database username
			 * string   password    database password
			 * boolean  persistent  use persistent connections?
			 */
			'dsn'        => 'mysql:host=localhost;dbname=root_sxcms',
			'username'   => 'direx',
			'password'   => '123123',
			'persistent' => FALSE,
		),
		/**
		 * The following extra options are available for PDO:
		 *
		 * string   identifier  set the escaping identifier
		 */
		'table_prefix' => 'sx_',
		'charset'      => 'utf8',
		'caching'      => FALSE,
		'profiling'    => TRUE,
	),
);
