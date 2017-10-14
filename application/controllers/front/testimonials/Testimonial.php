<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Testimonial extends Front_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('front/testimonials_model');
              $this->lang->load("common", $this->language);
    }

    public function save()
    {
        $requestdata = $this->input->post();
        
        $data = array();
        $data['content'] = $requestdata['content'];

        $usersession = $this->session->userdata('user');
        if(empty($usersession['userid'])){
            $this->setFlash($this->lang->line('login_first'),'danger');
        }else{
            // Only employer can add testimonials
            if ($this->session->userdata('captcha') == $this->input->post('captcha')) {
                if($usersession['group_id']){
                    $this->setFlash($this->lang->line('permission_msg'),'danger');
                }else{
                    // Store data to database
                    $issave = $this->testimonials_model->save($data);
                     
                    // Redirect to proper page
                    if($issave){
                        $this->setFlash($this->lang->line('testimonial_saved'));
                    }else{
                        $this->setFlash($this->lang->line('testimonial_saved_failed'),'danger');
                    }   
                }
            }else{
                $this->setFlash($this->lang->line('security_code'),'danger');
            }
        }
        
        redirect(site_url('testimonials/lists'));
    }
}