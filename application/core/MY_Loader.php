<?php

class MY_Loader extends CI_Loader
{

    public function __construct()
    {
        parent::__construct();
    }

    public function controller($route)
    {
        $parts = explode('/', $route);
        array_values($parts);
        
        if (isset($parts[2])) {
            $parts[2] = ucfirst(strtolower($parts[2]));
        }
        
        $method = 'index';
        if (isset($parts[3])) {
            $method = $parts[3];
            unset($parts[3]);
        }
        
        $buffer = '';
        $ci = &get_instance();
        if (file_exists(APPPATH . 'controllers/' . implode('/', $parts) . '.php')) {
            $ci->output->set_output('');
            require_once (APPPATH . 'controllers/' . implode('/', $parts) . '.php');
            $class = $parts[2];
            
            $allow = array(
                'benchmark',
                'hooks',
                'config',
                'log',
                'utf8',
                'uri',
                'router',
                'output',
                'security',
                'input',
                'lang'
            );
            
            foreach ($ci->load->_ci_classes as $key => $value) {
                if (! in_array($key, $allow)) {
                    unset($ci->load->_ci_classes[$key]);
                }
            }
            /* echo '<xmp>';print_r($ci->load->_ci_classes); */
            $object = new $class();
            
            $args = array();
            // call_user_func_array(array($object, $method), $args);
            $object->$method();
            $buffer = $ci->output->get_output();
        }
        return $buffer;
    }

    public function template($template_name, $vars = array())
    {
        $CIHelper = &get_instance();
        $temptype = ($CIHelper->uri->segments[0] == 'admin') ? 'admin' : 'front';
        $data = array();
        
        $vars['baseurl'] = $CIHelper->config->config['base_url'];
        
        $topmodules = $CIHelper->getModules('top');
        $topwrappermodules = $CIHelper->getModules('top_wrapper');
        $leftmodules = $CIHelper->getModules('left');
        $rightmodules = $CIHelper->getModules('right');
        $bottommodules = $CIHelper->getModules('bottom');
        $bottomwrappermodules = $CIHelper->getModules('bottom_wrapper');
        
        $data['top'] = '';
        if (! empty($topmodules)) {
            foreach ($topmodules as $mod) {
                $data['top'] .= load_module($mod);
            }
        }
        
        $data['top_wrapper'] = '';
        if (! empty($topwrappermodules)) {
            foreach ($topwrappermodules as $mod) {
                $data['top_wrapper'] .= load_module($mod);
            }
        }
        
        $data['left'] = '';
        if (! empty($leftmodules)) {
            foreach ($leftmodules as $mod) {
                $data['left'] .= load_module($mod);
            }
        }
        
        $data['right'] = '';
        if (! empty($rightmodules)) {
            foreach ($rightmodules as $mod) {
                $data['right'] .= load_module($mod);
            }
        }
        
        $data['bottom'] = '';
        if (! empty($bottommodules)) {
            foreach ($bottommodules as $mod) {
                $data['bottom'] .= load_module($mod);
            }
        }
        
        $data['bottom_wrapper'] = '';
        if (! empty($bottomwrappermodules)) {
            foreach ($bottomwrappermodules as $mod) {
                $data['bottom_wrapper'] .= load_module($mod);
            }
        }
        
        $scripts = array(
            'scripts' => array_unique($CIHelper->scripts)
        );
        $styles = array(
            'styles' => array_unique($CIHelper->styles)
        );
        
        if (in_array('admin', $CIHelper->uri->segments)) {
            $menus = $this->getAdminMenus();
            $notification = $this->getAdmin_notification($CIHelper);
            $vars = array_merge($vars, $menus, $notification);
        }
        
        $headerdata = array_merge($vars, $scripts, $styles);
        $data['header'] = $this->view('templates/default/' . $temptype . '/common/header', $headerdata, true);
        $data['content'] = $this->view('templates/default/' . $temptype . '/' . $template_name, $vars, true);
        $data['footer'] = $this->view('templates/default/' . $temptype . '/common/footer', $vars, true);
        
        $templatepage = 'page';
        $requesttemplate = $this->input->get('template');
        if (isset($requesttemplate)) {
            $templatepage = $requesttemplate;
        }
        
        $this->view('templates/default/' . $temptype . '/common/' . $templatepage, $data);
    }

    public function getAdminMenus()
    {
        $menus['menus'] = array(
            array(
                'label' => 'Dashboard',
                'url' => site_url('admin/common/dashboard'),
                'icon' => 'fa-dashboard',
                'childs' => array()
            ),
            array(
                'label' => 'Users',
                'url' => site_url('admin/users/users'),
                'icon' => 'fa-user',
                'childs' => array(
                    array(
                        'label' => 'Users',
                        'url' => site_url('admin/users/users'),
                        'icon' => 'fa-dashboard',
                        'childs' => array()
                    ),
                    array(
                        'label' => 'Groups',
                        'url' => site_url('admin/users/groups'),
                        'icon' => 'fa-dashboard',
                        'childs' => array()
                    )
                )
            ),
            array(
                'label' => 'Packages',
                'url' => site_url('admin/plans/packages'),
                'icon' => 'fa-database',
                'childs' => array()
            ),
            array(
                'label' => 'Jobs',
                'url' => site_url('admin/jobs/jobs'),
                'icon' => 'fa-tasks',
                'childs' => array(
                    array(
                        'label' => 'jobs',
                        'url' => site_url('admin/jobs/jobs'),
                        'icon' => 'fa-dashboard',
                        'childs' => array()
                    ),
                    array(
                        'label' => 'Employers',
                        'url' => site_url('admin/jobs/employers'),
                        'icon' => 'fa-dashboard',
                        'childs' => array()
                    ),
                    array(
                        'label' => 'Job Seekers',
                        'url' => site_url('admin/jobs/jobseekers'),
                        'icon' => 'fa-dashboard',
                        'childs' => array()
                    )
                )
            ),
            array(
                'label' => 'Blogs',
                'url' => site_url('admin/blogs/blogs'),
                'icon' => 'fa-book',
                'childs' => array(
                    array(
                        'label' => 'Blogs',
                        'url' => site_url('admin/blogs/blogs'),
                        'icon' => 'fa-book',
                        'childs' => array()
                    ),
                    array(
                        'label' => 'Category',
                        'url' => site_url('admin/blogs/category'),
                        'icon' => 'fa-book',
                        'childs' => array()
                    )
                )
            ),
             array(
                'label' => 'Testimonial',
                'url' => site_url('admin/testimonial/testimonial'),
                'icon' => 'fa-book',
                'childs' => array(
                    array(
                        'label' => 'Testimonial',
                        'url' => site_url('admin/testimonial/testimonial'),
                        'icon' => 'fa-book',
                        'childs' => array()
                    )
                )
            ),
             array(
                'label' => 'Contact',
                'url' => site_url('admin/contact/contact'),
                'icon' => 'fa-book',
                'childs' => array(
                    array(
                        'label' => 'Contact',
                        'url' => site_url('admin/contact/contact'),
                        'icon' => 'fa-book',
                        'childs' => array()
                    )
                )
            )
        );
        
        return $menus;
    }

    public function getAdmin_notification($CIHelperagain)
    {
        $CIHelperagain->load->database();
        $query = $CIHelperagain->db->query("SELECT * 
            FROM ci_contact ORDER BY id DESC  limit 2
        ");
        
        $return['notifications'] = $query->result_array();
        return $return;
    }
}