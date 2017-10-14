<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends Front_Controller
{

    public function __construct()
    {
    	$this->menuitem = '';
        parent::__construct();
                $this->lang->load("common", $this->language);
    }

    public function account()
    {
    	$data = array();
    	$data['title'] = 'Dashboard';
    	$user = getUser();
    	
    	if($user->id == 0){
    		$this->setFlash($this->lang->line('login_first'),'danger');
    		redirect('common/login');
    	}
    	
    	if($user->group_id == 2){
    		$this->menuitem = 'employer';
    		$data['links'] = $this->getEmployerLinks();
    	}else{
    		$this->menuitem = 'jobseeker';
    		$data['links'] = $this->getJobseekerLinks();
    	}
    	
        $this->load->template('users/dashboard', $data);
    }
    
    public function getEmployerLinks()
    {
    	$links = array (
			array (
				'title' => 'My Profile',
				'image' => getResizeImage('images/data/dashboard/profile.png'),
				'link' => site_url('users/profileedit/edit')
			),
    		array (
    			'title' => 'Post Job',
    			'image' => getResizeImage('images/data/dashboard/search.png'),
    			'link' => site_url('jobs/job/add')
			),
			array (
				'title' => 'My Jobs',
				'image' => getResizeImage('images/data/dashboard/jobs.png'),
				'link' => site_url('jobs/mylists')
			),
			array (
				'title' => 'Resume Alerts',
				'image' => getResizeImage('images/data/dashboard/resume.png'),
				'link' => site_url('jobs/resumelists')
			),
			array (
				'title' => 'Saved Resume',
				'image' => getResizeImage('images/data/dashboard/resume.png'),
				'link' => site_url('users/resumes/saved')
			),
			/*array (
				'title' => 'Saved Search',
				'image' => getResizeImage('images/data/dashboard/search.png'),
				'link' => site_url() 
			) */
		);
    	
    	return $links;
    }
    
    public function getJobseekerLinks()
    {
    	$links = array (
    			array (
    				'title' => 'My Profile',
    				'image' => getResizeImage('images/data/dashboard/profile.png'),
					'link' => site_url('users/profileedit/edit')
    			),
    			array (
    				'title' => 'Saved Jobs',
    				'image' => getResizeImage('images/data/dashboard/jobs.png'),
    				'link' => site_url('jobs/lists/savedjobs')
    			),
    			array (
    				'title' => 'Saved Search',
    				'image' => getResizeImage('images/data/dashboard/search.png'),
    				'link' => site_url('jobs/lists/savedsearch')
    			),
    			array (
    				'title' => 'Applied Jobs',
    				'image' => getResizeImage('images/data/dashboard/jobs.png'),
    				'link' => site_url('jobs/lists/applied')
    			)
    	);
    	
    	return $links;
    }
}