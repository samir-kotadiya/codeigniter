<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lists extends Front_Controller
{

	public function __construct()
	{
		$this->menuitem = 'job';
		parent::__construct();
	    $this->lang->load("jobs", $this->language);
    }
	
	public function savedsearch()
	{
		$user = getUser();
		$this->load->model('front/jobs_model');
		$data = array();
		$data['searches'] = $this->jobs_model->getSavedSearch();
		$this->load->template('jobs/savedsearch', $data);
	}
	
    public function index()
    {	
    	$this->load->library('pagination');
    	 
        $this->load->helper('global');
        $this->load->helper('text');
        $this->load->model('front/jobs_model');
        $searchid = $this->input->get('searchid');
        
        $data = array();
        $filters = array();
        $filters['keywork'] = '';
        $filters['skill'] = '';
        $filters['address'] = '';
        $filters['currency'] = '';
        $filters['salary_picker'] = '';
        $filters['posted_picker'] = '';
        $filters['employmenttype_picker'] = '';
        $filters['career_picker'] = '';
        $filters['distance_picker'] = '';
        $filters['tag'] = $this->input->get('tag');
        if($searchid){
        	$searchfilter = $this->jobs_model->getSavedSearch($searchid);
        	if(!empty($searchfilter)){
        		$filters = json_decode($searchfilter[0]['search'],true);
        	}
        }else{
        	$filters['keywork'] = $this->input->get('keyword');
        	$filters['skill'] = $this->input->get('skill');
        	$filters['address'] = $this->input->get('address');
        	$filters['currency'] = $this->input->get('currency');
        	$filters['salary_picker'] = $this->input->get('salary_picker');
        	$filters['posted_picker'] = $this->input->get('posted_picker');
        	$filters['employmenttype_picker'] = $this->input->get('employmenttype_picker');
        	$filters['career_picker'] = $this->input->get('career_picker');
        	$filters['distance_picker'] = $this->input->get('distance_picker');
        	$filters['category'] = $this->input->get('category');
          
        }
        
        $jobscount = $this->jobs_model->getJobsCount($filters);
        
        // Pagination Start
        $page = $this->input->get('page');
        $page = (isset($page)) ? $page : 1;
        $limit = 5;
        $start = ($page * $limit) - $limit;
        
        $linkssegment = $_GET; 
        unset($linkssegment['page']);
        
        $config['base_url'] = pagination_segments();
        $config['total_rows'] = $jobscount['jobcount'];
        
        $config['per_page'] = $limit;
        $config['num_links'] = 2;
        $config['page_query_string'] = TRUE;
        $config['use_page_numbers'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul><!--pagination-->';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        
        $this->pagination->initialize($config);
        $data['page'] = $page;
        // Pagination End
        
        $data['title'] = 'Jobs';
        
        // Salary type
        $salaryarray = $this->jobs_model->getJobSalary();
        $salarys = array();
        $salarys['None'] = '';
        foreach ($salaryarray as $salary) {
        	$salarys[$salary['type']] = $salary['id'];
        }
        
        // posteddate date
        $posteddate = array();
        $posteddate['None']='';
        $posteddate['3 Days']='3';
        $posteddate['7 Days']='7';
        $posteddate['10 Days']='10';
        $posteddate['20 Days']='20';
        $posteddate['30 Days']='30';
        $posteddate['Last Days']='1';
        
        // distance array
        $distance = array();
        $distance['None']='';
        $distance['5 miles']='5';
        $distance['10 miles']='10';
        $distance['20 miles']='20';
        $distance['30 miles']='30';
        $distance['50 miles']='50';
        $distance['100 miles']='100';
        
        // Job type
        $typearray = $this->jobs_model->getJobType();
        $types = array();
        foreach ($typearray as $type) {
        	$types[$type['title']] = $type['id'];
        }
        
        // Job carrer levels
        $careerarray = $this->jobs_model->getJobCareers();
        $careeres = array();
        $careeres['None'] = '';
        foreach ($careerarray as $career) {
        	$careeres[$career['name']] = $career['id'];
        }
        
        // Skill levels
        $skilllevelsarray = $this->jobs_model->getSkillLevels();
        $skills = array();
        $skills[$this->lang->line('skill_level_placehoder_text')] = '';
        foreach ($skilllevelsarray as $skill) {
        	$skills[$skill['name']] = $skill['id'];
        }
        
        $jobs = $this->jobs_model->getJobs($filters,$start,$limit);
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
        $data['filters'] = $filters;
        $data['salarys'] = $salarys;
        $data['types'] = $types;
        $data['posteddate'] = $posteddate;
        $data['careeres'] = $careeres;
        $data['distance'] = $distance;
        
        $this->load->template('jobs/lists', $data);
    }
    
    public function savesearch(){
    	$user = getUser();
    	
    	if($user->id>0){
    		$filters = array();
    		 
    		$filters['keywork'] = $this->input->post('keyword');
    		$filters['skill'] = $this->input->post('skill');
    		$filters['address'] = $this->input->post('address');
    		$filters['currency'] = $this->input->post('currency');
    		$filters['salary_picker'] = $this->input->post('salary_picker');
    		$filters['posted_picker'] = $this->input->post('posted_picker');
    		$filters['employmenttype_picker'] = (!empty($this->input->post('employmenttype_picker')))?$this->input->post('employmenttype_picker'):array();
    		$filters['career_picker'] = $this->input->post('career_picker');
    		$filters['distance_picker'] = $this->input->post('distance_picker');
    		 
    		$data['filters'] = json_encode($filters);
    		$data['user_id'] = $user->id;
    		 
    		 
    		$this->load->model('front/jobs_model');
    		$result = $this->jobs_model->savesearch($data);
    		
    		if(!$result){
    			$response['status'] = $this->lang->line('job_error_msg');
    			$response['message'] = $this->lang->line('job_list_error_msg');
    		}else{
    			$response['status'] = $this->lang->line('job_success_msg');
    			$response['message'] = $this->lang->line('job_list_sucess_msg');
    		}
    	}else{
    		$response['status'] = $this->lang->line('job_error_msg');
    		$response['message'] = $this->lang->line('job_login_msg');
    	}
    	echo json_encode($response);
    	exit;
    }
    
    public function savedjobs()
    {
    	$this->load->helper('text');
    	$this->load->model('front/jobs_model');
    	$this->checklogin();
    	$user = getUser();
    	$data = array();
    	
    	if($user->group_id == 3){
    		$userjobs = $this->jobs_model->getSavedJobs($user->id);

    		$filters['ids'] = $userjobs['job_ids'];
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
    	}else{
    		$this->setFlash($this->lang->line('job_list_sucess_msg'),'danger');
    	}
    	
    	$this->load->template('jobs/savedlists', $data);
    }
    
    public function applied()
    {
    	$this->load->helper('text');
    	$this->load->model('front/jobs_model');
    	$this->checklogin();
    	$user = getUser();
    	$data = array();
    	 
    	if($user->group_id == 3){
    		$userjobs = $this->jobs_model->getAppliedJobs($user->id);
    
    		$filters['ids'] = $userjobs['id'];
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
    	}else{
    		$this->setFlash($this->lang->line('job_list_sucess_msg'),'danger');
    	}
    	
    	$this->load->template('jobs/appliedlists', $data);
    }
    
    public function deletesavesearch()
    {
    	$this->load->model('front/jobs_model');
        $searchid = $this->input->post('searchid');
        $user = getUser();
         
        if($user->id>0){
        	$data['user_id'] = $user->id;
        	$data['searchid'] = $searchid;
        	 
        	$this->load->model('front/jobs_model');
        	$result = $this->jobs_model->deletesavesearch($data);
        
        	if(!$result){
        		$response['status'] = $this->lang->line('job_error_msg');
        		$response['message'] =  $this->lang->line('job_search_sucess_msg');
        	}else{
        		$response['status'] = $this->lang->line('job_success_msg');
        		$response['message'] = $this->lang->line('job_list_sucess_msg');
        	}
        }else{
        	$response['status'] = $this->lang->line('job_error_msg');
        	$response['message'] = $this->lang->line('job_list_login_msg');
        }
        echo json_encode($response);
        exit;
    	
    }
}