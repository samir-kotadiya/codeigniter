<?php
defined('BASEPATH') or exit('No direct script access allowed');

class login extends Front_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->lang->load("common", $this->language);
    }

    public function index()
    {
        if(!empty($this->session->userdata('user'))){
            $usersession = $this->session->userdata('user');
            if($usersession['userid']>0){
                redirect(base_url());
            }
        }
        
        $data = array();
        $this->load->helper('form');
        $data['lbl_login'] = $this->lang->line('lbl_login');
        $data['lbl_remember'] = $this->lang->line('lbl_remember');
        /*echo"<pre>";exit(print_r($data));*/
        $this->load->template('common/login', $data);
    }

    public function login()
    {
        $this->session->set_userdata('islogin', 0);
        $this->load->model('common/login_model');
        $result = $this->login_model->login($this->input->post('username'), $this->input->post('password'));
        
        if (! empty($result)) {
            if ($result->group_id != 1) {
                $data = array(
                    'userid' => $result->id,
                    'username' => $result->username,
                    'group_id' => $result->group_id,
                    'islogin' => 1
                );
                
                $this->session->set_userdata('user', $data);
                redirect('users/dashboard/account');
            } else {
                $this->session->set_flashdata('login_error', $this->lang->line('login_error'));
                redirect('common/login');
            }
        } else {
            $this->session->set_flashdata('login_error', $this->lang->line('login_error'));
            redirect('common/login');
        }
    }
     public function logout(){
       $this->session->unset_userdata('user');
       $this->index();
    }
}