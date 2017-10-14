<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lists extends Front_Controller
{

    public function index()
    {
    	//Load form elements helper
    	loadFormHelpers();
    	
    	
        $this->load->helper('text');
        $this->lang->load("common", $this->language);
        $data = array();
        $data['title'] = $this->lang->line('testimonial_title');
        $this->load->model('front/testimonials_model');
        $testimonials = $this->testimonials_model->getTestimonials();
        
        foreach ($testimonials as $key=>$testimonial){
        	$user = $this->testimonials_model->getTestimonialUser($testimonial['user_id'],$testimonial['group_id']);
        	$testimonials[$key]['firstname'] = $user['firstname'];
        	$testimonials[$key]['lastname'] = $user['lastname'];
        	$testimonials[$key]['company'] = $user['company'];
        	$testimonials[$key]['logo'] = getResizeImage($user['logo']);
        }
        $data['testimonials'] = $testimonials;
        
        //Form for new testimonial
        $data['forms']['fieldsets']['basic'] = array(
        		'label' => 'Basic',
        		'active' => true,
        		'fields' => array(
        				array(
        						'name' => 'content',
        						'type' => 'textarea',
        						'label' => $this->lang->line('content'),
        						'valid' => array(
        								'require'
        						)
        				),
        				array(
        						'name' => 'captcha',
        						'type' => 'captcha',
        						'label' => 'captcha',
        						'captcha' => $this->captcha,
        						'valid' => array(
        								'require'
        						)
        				)
        		)
        );
        $data['forms']['action'] = site_url('testimonials/testimonial/save');
        
        $this->load->template('testimonials/lists', $data);
    }
}