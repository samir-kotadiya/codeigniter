<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends Admin_Controller
{

    public function index()
    {
        $data = array();
        $this->load->helper('form');
        $data['baseurl'] = $this->config->config['base_url'];
        $this->load->view('templates/default/admin/common/login', $data);
    }
    
    public function process(){
        $this->session->set_userdata('islogin',0);
        $this->load->model('common/login_model');
        
        $result = $this->login_model->login($this->input->post('username'),$this->input->post('password'));
        if (! empty($result)) {
            if($result->group_id == 1){
                $data = array(
                    'userid' => $result->id,
                    'username' => $result->username,
                    'islogin' => 1
                );
                
                $this->session->set_userdata($data);
                redirect('admin/common/dashboard');
            }else{
                $this->session->set_flashdata('login', 'Username or password is wrong!');
                redirect('admin/common/user');
            }
        } else {
            $this->session->set_flashdata('login', 'Username or password is wrong!');
            redirect('admin/common/user');
        }
    }
    
    public function logout(){
        $array_items = array('userid', 'username','islogin');
        $this->session->unset_userdata($array_items);
        $this->index();
    }
}
