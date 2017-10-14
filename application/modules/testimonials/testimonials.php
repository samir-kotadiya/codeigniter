<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TestimonialsModule extends CI_Modules
{

    public function html($args = array())
    {
        $CI = get_instance();
        $CI->lang->load("common", $CI->language);

        $limit=2;
        $CI->load->model('front/testimonials_model');
        $data = array('limit'=>$limit);
        $testimonials = $CI->testimonials_model->getTestimonials($data);

        foreach ($testimonials as $key=>$testimonial){
        	$user = $CI->testimonials_model->getTestimonialUser($testimonial['user_id'],$testimonial['group_id']);
        	$testimonials[$key]['firstname'] = $user['firstname'];
        	$testimonials[$key]['lastname'] = $user['lastname'];
        	$testimonials[$key]['company'] = $user['company'];
        	$testimonials[$key]['logo'] = getResizeImage($user['logo'],array('width'=>124));
        }
		
		$this->data['title'] = $CI->lang->line('testimonials');
        $this->data['tagline'] = $CI->lang->line('tagline');
        $this->data['readall'] = $CI->lang->line('readall');
        $this->data['link'] = site_url('testimonials/lists');
		$this->data['testimonials'] = $testimonials;
        $this->module = 'Testimonials';
    }
}