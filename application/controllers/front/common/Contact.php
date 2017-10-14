<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends Front_Controller
{
     public function __construct()
    {
        parent::__construct();
        
         $this->load->helper('captcha');
        $this->load->library('googlemaps');
        $this->lang->load("common", $this->language);
    
   
        $this->addScript('formValidation.min.js');
        $this->addScript('jquery.bootstrap.wizard.min.js');
        $this->addScript('tinymce.min.js');
        $this->addCss('formValidation.min.css');
   
        $this->load->helper('global');
        $this->load->library('form_validation');
        $this->load->model('admin/Jobs/employers_model');
    }

    public function index()
    {
        // load library and helpers

      
        $data = array();
        $data['title'] = 'Contact us';
        
        // Language variables
        $data['label_name'] = $this->lang->line('name');
        $data['label_email'] = $this->lang->line('email');
        $data['label_phone'] = $this->lang->line('phone');
        $data['label_message'] = $this->lang->line('message');
        $data['label_captcha'] = $this->lang->line('captcha');
        
        $values = array(
            'word' => '',
            'word_length' => 8,
            'img_path' => './application/images/',
            'img_url' => base_url() . 'application/images/',
            'font_path' => base_url() . 'system/fonts/texb.ttf',
            'img_width' => '150',
            'img_height' => 50,
            'expiration' => 3600
        );
        
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phoneno', 'Phone no', 'required');
        $this->form_validation->set_rules('message', 'Message', 'required');
        $this->form_validation->set_rules('captcha', 'captcha', 'required');
        $data['captcha'] = create_captcha($values);
        $old_captcha_image = $this->session->userdata('captcha_image');
        if (isset($old_captcha_image) and file_exists(APPPATH . '/images/' . $this->session->userdata('captcha_image'))) {
            unlink(APPPATH . '/images/' . $this->session->userdata('captcha_image'));
        }
        $this->session->set_userdata('captcha_image', $data['captcha']['filename']);
        if ($this->input->post('submit') && $this->form_validation->run() != FALSE) {
            
            /*
             * if ($this->session->userdata('captcha') == $this->input->post('captcha')) {
             * $this->load->model('common/Contact_model');
             *
             * $flag = $this->Contact_model->save($this->input);
             * if ($flag == true) {
             * // $this->sendMail();
             * $this->session->set_flashdata('success_msg', 'Your Record Successfully Submited!');
             * }
             * } else {
             * $this->session->set_flashdata('captcha_error', 'captcha is wrong!');
             * }
             */
        } else {
            if ($this->input->post('submit') && $this->form_validation->run() == FALSE)
                $this->session->set_flashdata('error', 'Error Message');
        }
        
        $name_value = $this->input->post('name');
        $email_value = $this->input->post('email');
        $phone_value = $this->input->post('phone');
        $message_value = $this->input->post('message');
        
        $data['contact_name_value'] = (isset($name_value)) ? $name_value : '';
        $data['contact_email_value'] = (isset($email_value)) ? $email_value : '';
        $data['contact_phone_value'] = (isset($phone_value)) ? $phone_value : '';
        $data['contact_message_value'] = (isset($message_value)) ? $message_value : '';
        
        // map code start
        $config['center'] = '37.4419, -122.1419';
        $config['zoom'] = 'auto';
        $this->googlemaps->initialize($config);
        $marker = array();
        $marker['position'] = '37.429, -122.1419';
        $this->googlemaps->add_marker($marker);
        $data['map'] = $this->googlemaps->create_map();
        // map code end
        
        $data['forms']['fieldsets']['basic'] = array(
            'label' => 'Personal',
            'active' => true,
            'fields' => array(
                array(
                    'name' => 'name',
                    'placeholder' => 'Name',
                    'type' => 'text',
                    'label' => $this->lang->line('name'),
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'email',
                    'placeholder' => 'Email',
                    'type' => 'email',
                    'label' => $this->lang->line('email'),
                    'valid' => array(
                        'require',
                        'email'
                    )
                ),
                array(
                    'name' => 'phone_no',
                    'placeholder' => 'Phone No',
                    'type' => 'text',
                    'label' => $this->lang->line('phone'),
                    'valid' => array(
                        'numeric'
                    )
                ),
                array(
                    'name' => 'message',
                    'placeholder' => 'Message',
                    'type' => 'editor',
                    'label' => $this->lang->line('message'),
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'captcha',
                    'type' => 'captcha',
                    'label' => $this->lang->line('captcha'),
                    'captcha' => $data['captcha']
                )
            )
        );
        $data['forms']['action'] = site_url('common/contact/save');
        $this->session->set_userdata('captcha', $data['captcha']['word']);
        
        $this->load->template('common/contact', $data);
    }

    public function save()
    {
        if ($this->session->userdata('captcha') == $this->input->post('captcha')) {
            
            $this->load->model('common/Contact_model');
            
            $flag = $this->Contact_model->save($this->input->post());
            if ($flag == true) {
                  $subject="hi testting";
                  $to = $this->input->post('email');
                  $name = $this->input->post('name');
                  $message = '<p> <h4> hi '.$name.'</h4></p><p>'.$this->input->post('message');
                  $headers = "MIME-Version: 1.0" . "\r\n";
                  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                  $headers .= 'From: <test.raindropsinfotech@gmail.com>' . "\r\n";
                  sendMail($to,$subject,$message,$headers);
                  $to = ADMIN_EMAIL;
                 
                  sendMail($to,$subject,$message,$headers);
                $this->session->set_flashdata('success_message', $this->lang->line('contact_success'));
                redirect('common/Contact');
            }
        } else {
            $this->session->set_flashdata('fail_message', $this->lang->line('contact_captcha_wrong'));
            redirect('common/Contact');
        }
    }

   
}