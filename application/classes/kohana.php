<?php defined('SYSPATH') or die('No direct script access.');

class Kohana extends Kohana_Core {
    protected static $find_modules = array();

    public static function find_file($dir, $file, $ext = NULL, $array = FALSE)
	{
		if ($ext === NULL)
		{
			// Use the default extension
			$ext = EXT;
		}
		elseif ($ext)
		{
			// Prefix the extension with a period
			$ext = ".{$ext}";
		}
		else
		{
			// Use no extension
			$ext = '';
		}

		// Create a partial path of the filename
		$path = $dir.DIRECTORY_SEPARATOR.$file.$ext;

		if (Kohana::$caching === TRUE AND isset(Kohana::$_files[$path.($array ? '_array' : '_path')]))
		{
			// This path has been cached
			return Kohana::$_files[$path.($array ? '_array' : '_path')];
		}

		if (Kohana::$profiling === TRUE AND class_exists('Profiler', FALSE))
		{
			// Start a new benchmark
			$benchmark = Profiler::start('Kohana', __FUNCTION__);
		}

		if ($array OR $dir === 'config' OR $dir === 'i18n' OR $dir === 'messages')
		{ 
			$paths = array_reverse(Kohana::$_paths);

                        // Array of files that have been found
			$found = array();
                        
			foreach ($paths as $dir)
			{
                                $found_array = preg_replace("@application\/views\/modules_find@", 'application/classes/modules',  $dir.$path);
                                $found_array = preg_replace('@application\/views@', 'templates', $found_array);
				if (is_file($found_array))
				{
					// This path has a file, add it to the list
					$found[] = $found_array;
				}
			}
		}
		else
		{
			// The file has not been found yet
			$found = FALSE;
			foreach (Kohana::$_paths as $dir)
			{
                                $found_reach = preg_replace("@application\/views\/modules_find@", 'application/classes/modules',  $dir.$path);
                                $found_reach = preg_replace('@application\/views@', 'templates', $found_reach);
				if (is_file($found_reach))
				{
					// A path has been found
					$found = $found_reach;
					// Stop searching
					break;
				}
			}
		}

		if (Kohana::$caching === TRUE)
		{
			// Add the path to the cache
			Kohana::$_files[$path.($array ? '_array' : '_path')] = $found;

			// Files have been changed
			Kohana::$_files_changed = TRUE;
		}

		if (isset($benchmark))
		{
			// Stop the benchmark
			Profiler::stop($benchmark);
		}
                //var_dump($found);
                return $found;
	}
        
        public static function add_path_module($module)
        {
            Kohana::$_paths[] = DOCROOT.'application/classes/modules/'.$module.'/';
        }
        
        public static function i18n($type = 'page', $item_id = 0, $row_name = '')
        {
            $get_translate = ORM::factory('i18n')->where('type', '=', $type)->where('item_id', '=', $item_id)->where('lang', '=', I18n::lang());
            if (strlen($row_name) > 1)
                $get_translate->where('row', '=', $row_name);
            $get_data = $get_translate->find();
            if (strlen($get_data->translate) > 2)
                $translate = $get_data->translate;
            else
                $translate = __('Translate not isset');
            return $translate;
        }
}
