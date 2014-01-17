<?php defined('SYSPATH') or die('No direct script access.');
class Model_Libs_Elfinder extends Model_Libs_Elfinder_Elfinderconnector
{
    public function access($attr, $path, $data, $volume)
    {
	return strpos(basename($path), '.') === 0       // if file/folder begins with '.' (dot)
		? !($attr == 'read' || $attr == 'write')    // set read+write to false, other (locked+hidden) set to true
		:  null;                                    // else elFinder decide it itself
    }
}