<?php defined('SYSPATH') or die('No direct script access.');

class Ropublic extends Base {
    public $template = 'public/default/index';
    public $def_template = 'index';


    public function __construct(Request $request, Response $response) {
        parent::__construct($request, $response);
        $this->set_template();
    }
    
    protected function set_template($template_to_set = 'index')
    {
        $config_file = 'config.xml';
        $get_config = file_get_contents($config_file);
        $get_xml_config = new SimpleXMLElement($get_config);
        $base_template = $get_xml_config->base->template;
        $template_to_set = (strlen($template_to_set) > 1) ? $template_to_set : $this->def_template;
        $this->template = 'public/'.$base_template.'/'.$template_to_set; 
    }
}