<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Resume extends Front_Controller
{

	public function __construct()
	{
		parent::__construct();
        $this->menuitem = 'resume';
        $this->load->model('front/resumes_model');
        $this->load->helper('global');
	}

    public function view()
    {
        $data = array();
       
        $userid = $this->input->get('id');
        $userid = (isset($userid)) ? $this->input->get('id') : 0; 
        $data['resume'] = $this->resumes_model->getResume($userid);
        $this->load->template('jobs/resumedetail', $data);
    }
    
    public function saveresume() {
    	$requestdata = $this->input->post();
    	$user = getUser();
    
    	if (! empty($user->id) && $user->group_id == 2) {
    		if (isset($requestdata['resumeid'])) {
    			$result = $this->resumes_model->saveresume($requestdata['resumeid'], $user->id);
    			if ($result) {
    				$response['status'] = 'success';
    				$response['message'] = $this->lang->line('resume_saved');
    			} else {
    				$response['status'] = 'error';
    				$response['message'] = $this->lang->line('resume_already_saved');
    			}
    		} else {
    			$response['status'] = 'error';
    			$response['message'] = $this->lang->line('job_something_wrong_msg');
    		}
    	} else {
    		$response['status'] = 'error';
    		$response['message'] =$this->lang->line('login_employer_msg');
    	}
    
    	echo json_encode($response);
    	exit();
    }
}