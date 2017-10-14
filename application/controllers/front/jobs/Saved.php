<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Saved extends Front_Controller
{

	public function __construct()
	{
		$this->menuitem = 'jobseeker';
		parent::__construct();
        $this->load->model('front/jobs_model');
	}
	
    public function index()
    {
        $this->load->helper('global');
        $this->load->helper('text');
        $data = array();
        $data['title'] = 'Jobs';
    
        $jobs = $this->jobs_model->getMyJobs();
        foreach ($jobs as $key => $job) {
            $jobs[$key]['link'] = site_url("jobs/job/view/id/{$job['id']}");
            $jobs[$key]['tags'] = explode(',', $job['tags']);
            $jobs[$key]['sort_description'] = word_limiter($job['description'], 50);
            $date=date_create($job['created']);
            $date = date_format($date,"m.d.Y");
            $jobs[$key]['created'] = $date;
        }
        $data['jobs'] = $jobs;

       
        $this->load->template('jobs/mylists', $data);
    }
}