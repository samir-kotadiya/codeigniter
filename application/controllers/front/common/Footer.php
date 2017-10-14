<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Footer extends Front_Controller
{

    public function index()
    {
        $this->load->view('templates/default/front/common/footer');
    }
}