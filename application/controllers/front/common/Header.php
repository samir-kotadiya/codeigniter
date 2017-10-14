<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Header extends Front_Controller
{

    public function index()
    {
    	
        $this->load->view('templates/default/front/common/header');
    }
}