<?php

class MY_Controller extends CI_Controller
{

    public $scripts = array();

    public $styles = array();
    
    protected $modules = array();

    function __construct()
    {
        parent::__construct();
        
        //load basic libraries
        $this->load->library('session');
        $this->load->helper('url');
        
        //load Helpers
        $this->load->helper('html');
        $this->load->helper('module');
    }

    public function addScript($script)
    {
        $this->scripts[] = $script;
    }

    public function addCss($css)
    {
        $this->styles[] = $css;
    }
    
    protected function setModule($position, $module)
    {
        $this->modules[$position][] = $module;
    }
    
    public function getModules($position)
    {
        if (isset($this->modules[$position])) {
            return $this->modules[$position];
        } else {
            return false;
        }
    }
}

require_once (APPPATH . 'core/Admin_Controller.php');
require_once (APPPATH . 'core/Front_Controller.php');