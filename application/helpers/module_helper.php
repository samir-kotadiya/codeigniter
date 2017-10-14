<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * CodeIgniter Module Helpers
 *
 * @package CodeIgniter
 * @subpackage Helpers
 * @category Helpers
 * @author Naresh
 */

// ------------------------------------------------------------------------

if (! function_exists('load_module')) {

    function load_module($module = '')
    {
        if ($module == '') {
            return '';
        }
        
        $file = APPPATH . 'modules' . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . $module . '.php';
        if (file_exists($file)) {
            $CIModuleHelper = & get_instance();
            $CIModuleHelper->load->library('smartyci');
            require_once $file;
            
            $classname = $module . 'Module';
            
            $class = new $classname($CIModuleHelper);
            $class->html();
            $output = $class->render();
            
            return $output;
        } else {
            return '';
        }
    }
}

if (! class_exists('CI_Modules')) {

    class CI_Modules
    {

        protected $data = array();

        protected $module = null;

        protected $CIHelper = null;

        protected $scripts = array();

        protected $styles = array();
        
        protected $template = 'default';

        public function __construct($CIHelper)
        {
            $this->CIHelper = $CIHelper;
        }

        public function addScript($script)
        {
            $this->scripts[] = $script;
        }

        public function addCss($css)
        {
            $this->styles[] = $css;
        }

        public function render()
        {
            $this->CIHelper->scripts = array_merge($this->CIHelper->scripts, $this->scripts);
            $this->CIHelper->styles = array_merge($this->CIHelper->styles, $this->styles);
            
            $this->CIHelper->smartyci->cache_lifetime = 1;
            $this->CIHelper->smartyci->caching = 0;
            $this->CIHelper->smartyci->force_compile = true;
            $this->CIHelper->smartyci->setCompileCheck(false);
            
            foreach ($this->data as $key => $value) {
                $this->CIHelper->smartyci->assign($key, $value);
            }
            
            return $this->CIHelper->smartyci->fetch(APPPATH . 'modules/' . strtolower($this->module) . '/tmpl/'.$this->template.'.tpl');
        }
    }
}

