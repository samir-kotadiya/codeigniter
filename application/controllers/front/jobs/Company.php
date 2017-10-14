<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company extends Front_Controller
{
	public function __construct()
	{
        parent::__construct();
        $this->load->model('front/company_model');
        $this->lang->load("jobs", $this->language);
	}

    public function view()
    {
    	$this->load->helper('text');
    	$this->load->model('front/jobs_model');
    	
        $data = array();
        $id = $this->input->get('id');
        $id = (isset($id)) ? $this->input->get('id') : 0; 
        $data['company'] = $this->company_model->getCompany($id);
        $data['company']['company_logo'] = getResizeImage($data['company']['logo'], array(
        		'width' => 200,
        		'height' => 200
        ));
        
        $filters['employer'] = $id; 
        $jobs = $this->jobs_model->getJobs($filters);
        foreach ($jobs as $key => $job) {
        	$jobs[$key]['link'] = site_url("jobs/job/view/id/{$job['id']}");
        	$jobs[$key]['tags'] = explode(',', $job['tags']);
        	$jobs[$key]['sort_description'] = word_limiter($job['description'], 50);
        	$jobs[$key]['company_logo'] = getResizeImage($job['company_logo'], array(
        			'width' => 150,
        			'height' => 150
        	));
        }
    	$data['jobs'] = $jobs;
        $data['lbl_company_info'] =  $this->lang->line('lbl_company_info');
        $data['lbl_company'] =  $this->lang->line('lbl_company');
        $data['lbl_category'] =  $this->lang->line('lbl_category');
        $data['lbl_type'] =  $this->lang->line('lbl_type');
        $data['lbl_location'] =  $this->lang->line('lbl_location');
        $data['lbl_tags'] =  $this->lang->line('lbl_tags');
        $data['lbl_jobs'] =  $this->lang->line('lbl_jobs');
        $data['lbl_website'] =  $this->lang->line('lbl_website');
        $data['lbl_phone'] =  $this->lang->line('lbl_phone');
        $this->load->template('jobs/companydetail', $data);
    }
 }