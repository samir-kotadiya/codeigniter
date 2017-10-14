<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Miscellaneous extends Front_Controller
{

    public function newsletter()
    {
        $requestdata = $this->input->post();
        
        $savedata['email'] = $requestdata['email'];
        
        $this->load->model('common/Miscellaneous_model');
        $flag = $this->Miscellaneous_model->savenewsletter($savedata);
        if ($flag) {
            redirect(site_url());
        }
    }
}