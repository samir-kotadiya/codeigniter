<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mylists extends Front_Controller
{

	public function __construct()
	{
		$this->menuitem = 'employer';
		parent::__construct();
        $this->load->model('front/jobs_model');
        $this->lang->load("jobs", $this->language);
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
    public function publish()
    {
                
        $cids = $this->input->post('cid');
    
        if (! empty($cids)) {
            
            $this->jobs_model->publish($cids);
            $this->setFlash($this->lang->line('job_published'), 'success');
        }
        redirect(site_url('jobs/mylists'));
    }

    public function unpublish()
    {
   
        if(!$this->input->post('cid'))
           $cids[] = $this->input->get('cid');  
        else 
           $cids = $this->input->post('cid');
        
        if (! empty($cids)) {
            
            $this->jobs_model->unpublish($cids);
            $this->setFlash($this->lang->line('job_unpublished'), 'success');
        }
            redirect(site_url('jobs/mylists'));
    }

    public function delete()
    {

        if(!$this->input->post('cid'))
           $cids[] = $this->input->get('cid');  
        else 
           $cids = $this->input->post('cid');
        if (! empty($cids)) {
            
            $this->jobs_model->delete($cids);
            $this->setFlash($this->lang->line('job_delete'), 'success');
        }
            redirect(site_url('jobs/mylists'));
    }
    public function clonejob()
    {
        $cids = $this->input->get('cid');  
        if (! empty($cids)) {
            
            $this->jobs_model->clonejob($cids);
            $this->setFlash($this->lang->line('job_clone'), 'success');
        }
            redirect(site_url('jobs/mylists'));
    }
}