<?php defined('SYSPATH') or die('No direct script access.');

class Model_Userroles extends ORM
{
    protected $_table_name = 'roles_users';
    protected $_primary_key = 'user_id';
}
