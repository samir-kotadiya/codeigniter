<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends Admin_Controller
{

    public function index()
    {
        $data = array();
        $this->load->template('common/dashboard', $data);
    }
}
