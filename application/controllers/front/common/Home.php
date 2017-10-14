<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends Front_Controller
{
	public function __construct()
	{
		$this->menuitem = 'home';
		parent::__construct();
	}

    public function index()
    {
        $data = array();
        $this->modules['top'][] = 'slider';
        $this->modules['top'][] = 'statistics';
        $this->modules['bottom_wrapper'][] = 'recentjobs';
        $this->modules['bottom_wrapper'][] = 'featuredjobs';
        $this->modules['bottom_wrapper'][] = 'latestnews';
        $this->modules['bottom'][] = 'testimonials';
        $this->modules['bottom'][] = 'newsletter';
        $this->load->template('common/home', $data);
    }
}