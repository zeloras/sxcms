<?php defined('SYSPATH') or die('No direct script access.');

class ORM extends Kohana_ORM {
    /**
     * Creates and returns a new model.
     *
     * @chainable
     * @param   string  $model  Model name
     * @param   mixed   $id     Parameter for find()
     * @return  ORM
     */
    public static function factory($model, $id = NULL)
    {
            // Set class name
            if (preg_match("@^sxmodule*@", $model))
            {
                $mod_exp = explode("_", $model);
                $module = $mod_exp[1];
                $output_model = implode('', array_slice($mod_exp, 2));
                $model = 'Modules_'.ucfirst($module).'_Model_'.ucfirst($output_model);
            }
            else
                $model = 'Model_'.ucfirst($model);

            return new $model($id);
    }
}
