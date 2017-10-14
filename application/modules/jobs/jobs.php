<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JobsModule extends CI_Modules
{

    public function html($args = array())
    {
        $this->module = 'Jobs';
        $this->data['test'] = 'Success';
        $this->data['success'] = 'Success123';
    }
}