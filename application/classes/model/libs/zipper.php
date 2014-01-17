<?php defined('SYSPATH') or die('No direct script access.');
class Model_Libs_Zipper extends KOZip 
{

/**
 * Read a directory and add it to the zip using the new filepath set.
 *
 * This function recursively reads a folder and everything it contains (including
 * sub-folders) and creates a zip based on it.  You must specify the new directory structure.
 * The original structure is thrown out.
 *
 * @access  public
 * @param   string  path to source
 * @param   string  new directory structure
 */
function get_files_from_folder($directory, $put_into) 
{
    if ($handle = opendir($directory)) 
    {
        while (false !== ($file = readdir($handle))) 
        {
            if (is_file($directory.$file)) 
            {
                $fileContents = file_get_contents($directory.$file);

                $this->add_data($put_into.$file, $fileContents);

            }
            if ($file != '.' and $file != '..' and $file != 'backup' and is_dir($directory.$file)) {

                $this->add_dir($put_into.$file.'/');

                $this->get_files_from_folder($directory.$file.'/', $put_into.$file.'/');
            }
            else
            {
                if ($file == 'backup' and is_dir($directory.$file))
                        $this->add_dir($put_into.$file.'/');
            }
            //echo $file."<br /><br />";

        }//end while
            closedir($handle);

    }//end if
}

}