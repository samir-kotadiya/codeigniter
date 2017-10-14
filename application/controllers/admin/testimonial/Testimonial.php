<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('error_reporting', E_ALL);

class Testimonial extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        $this->addScript('tinymce.min.js');
        $this->load->helper('global');
        $this->load->model('admin/Testimonial/testimonial_model');
        $this->load->helper('filter');
        $this->load->helper('text');
    }
    public function index()
    {
        $this->page = 'testimonial';
        $data = array();
 
       
        sorting_init();
        $page = $this->input->get('page');
        $page = (isset($page)) ? $page : 1;
        $limit = 10;
        $start = ($page * $limit) - $limit;
        $test = $this->testimonial_model->getTestimonials($start, $limit);
        $total = $this->testimonial_model->getCount();
        $this->pagination(site_url('admin/testimonial/testimonial'), $total, $limit);
        foreach ($test as $key => $value) {
            
            $string = $value['content'];
             $test[$key]['content'] = word_limiter($string, 5);
        }
        
        $data['testimonial'] = $test;
        $this->load->template('testimonial/testimonial_list', $data);
    }

    public function add()
    {

      
        $this->addScript('bootstrap-switch.js');
        $data = array();
        $requestdata = $this->input->post('ciform');
        if (! empty($requestdata)) {
            // validate form input

                $userid = $this->testimonial_model->save($requestdata);
                if ($userid) {
                    $this->setFlash('Testimonial saved!', 'success');
                    redirect(site_url('admin/testimonial/testimonial/edit/id/' . $userid));
                } else {
                    $this->setFlash('Error!', 'danger');
                    redirect(site_url('admin/testimonial/testimonial/edit/id/' . $userid));
                }
           
        }
        $data['users'] = $this->testimonial_model->getusers();


        $data['testimonial'] = new stdClass();
        $data['testimonial']->content = (isset($requestdata['content'])) ? $requestdata['content'] : '';
        $data['testimonial']->id = 0;
        $data['testimonial']->published = (isset($requestdata['published'])) ? $requestdata['published'] : 0;
        $data['testimonial']->user_id = (isset($requestdata['created_by'])) ? $requestdata['created_by'] :  0;
           $this->load->template('testimonial/testimonial_edit', $data);
    }

    public function edit()
    {
    
        $this->addScript('bootstrap-switch.js');
        $data = array();
        $requestdata = $this->input->post('ciform');
        if (! empty($requestdata)) {
            // validate form input
                $testid = $this->testimonial_model->save($requestdata);
                if ($testid) {
                    $this->setFlash('Testimonial saved!', 'success');
                    redirect(site_url('admin/testimonial/testimonial/edit/id/' . $testid));
                } else {
                    $this->setFlash('Error!', 'danger');
                    redirect(site_url('admin/testimonial/testimonial/edit/id/' . $testid));
                }
            
        }
        $testid = $this->input->get('id');
        $data['users'] = $this->testimonial_model->getusers();

        $data['testimonial'] = $this->testimonial_model->getTestimonial($testid);
/*        $data['testimonial']->created_by = (isset($requestdata['created_by'])) ? $this->session->userdata('created_by') : 1;*/
        if (! empty($data['testimonial'])) {
            
            $this->load->template('testimonial/testimonial_edit', $data);
        } else {
            show_404();
        }
    }

    public function publish()
    {
       
        $cids = $this->input->post('cid');
        if (! empty($cids)) {
       
            $this->testimonial_model->publish($cids);
            $this->setFlash('Testimonial(s) are published!', 'success');
        }
        redirect(site_url('admin/testimonial/testimonial'));
    }

    public function unpublish()
    {
 
        $cids = $this->input->post('cid');
        if (! empty($cids)) {
         
            $this->testimonial_model->unpublish($cids);
            $this->setFlash('testimonial(s) are unpublished!', 'success');
        }
        redirect(site_url('admin/testimonial/testimonial'));
    }

    public function delete()
    {
     
        $cids = $this->input->post('cid');
        if (! empty($cids)) {
      
            $this->testimonial_model->delete($cids);
            $this->setFlash('testimonial(s) are deleted!', 'success');
        }
        redirect(site_url('admin/testimonial/testimonial'));
    }
}