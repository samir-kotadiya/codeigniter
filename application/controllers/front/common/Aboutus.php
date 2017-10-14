<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aboutus extends Front_Controller
{
	public function __construct()
	{
		$this->menuitem = 'aboutus';
		parent::__construct();
		 $this->lang->load("common", $this->language);
	}
	
    public function index()
    {
        $data = array();
        $data['title'] =  $this->lang->line('aboutus');
        $this->load->template('common/aboutus', $data);
    }
}