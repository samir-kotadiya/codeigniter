`<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('error_reporting', E_ALL);

class Contact extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        $this->addScript('tinymce.min.js');
        $this->load->helper('global');
        $this->load->model('admin/Contact/contact_model');
        $this->load->helper('filter');
        $this->load->helper('text');
    }
    public function index()
    {
        $this->page = 'contact';
        $data = array();
 
       
        sorting_init();
        $page = $this->input->get('page');
        $page = (isset($page)) ? $page : 1;
        $limit = 10;
        $start = ($page * $limit) - $limit;
        $contact = $this->contact_model->getcontacts($start, $limit);

        $total = $this->contact_model->getCount();
        $this->pagination(site_url('admin/contact/contact'), $total, $limit);
        
        
        $data['contact'] = $contact;
        $this->load->template('contact/contact_list', $data);
    }

    public function add()
    {

      
        $this->addScript('bootstrap-switch.js');
        $data = array();
        $requestdata = $this->input->post('ciform');
        if (! empty($requestdata)) {
            // validate form input

                $userid = $this->contact_model->save($requestdata);
                if ($userid) {
                    $this->setFlash('contact saved!', 'success');
                    redirect(site_url('admin/contact/contact/edit/id/' . $userid));
                } else {
                    $this->setFlash('Error!', 'danger');
                    redirect(site_url('admin/contact/contact/edit/id/' . $userid));
                }
           
        }
        $data['contact'] = new stdClass();
        $data['contact']->name = (isset($requestdata['name'])) ? $requestdata['name'] : '';
        $data['contact']->email = (isset($requestdata['email'])) ? $requestdata['email'] : '';
        $data['contact']->id = 0;
        $data['contact']->phone_no = (isset($requestdata['phone_no'])) ? $requestdata['phone_no'] : '';
        $data['contact']->message = (isset($requestdata['message'])) ? $requestdata['message'] : '';
        
           $this->load->template('contact/contact_edit', $data);
    }

    public function edit()
    {
    
        $this->addScript('bootstrap-switch.js');
        $data = array();
        $requestdata = $this->input->post('ciform');
        if (! empty($requestdata)) {
            // validate form input
       
                $testid = $this->contact_model->save($requestdata);
                if ($testid) {
                    $this->setFlash('contact saved!', 'success');
                    redirect(site_url('admin/contact/contact/edit/id/' . $testid));
                } else {
                    $this->setFlash('Error!', 'danger');
                    redirect(site_url('admin/contact/contact/edit/id/' . $testid));
                }
            
        }
        $testid = $this->input->get('id');
      

        $data['contact'] = $this->contact_model->getcontact($testid);
/*        $data['contact']->created_by = (isset($requestdata['created_by'])) ? $this->session->userdata('created_by') : 1;*/
        if (! empty($data['contact'])) {
            
            $this->load->template('contact/contact_edit', $data);
        } else {
            show_404();
        }
    }

    
}