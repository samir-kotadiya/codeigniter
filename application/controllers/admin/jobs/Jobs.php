<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jobs extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('global');
        $this->addScript('formValidation.min.js');
        $this->addScript('bootstrap-tagsinput.min.js');
        $this->addScript('moment.min.js');
        $this->addScript('bootstrap-datetimepicker.min.js');
        $this->addCss('datepicker.css');
        $this->addScript('tinymce.min.js');
        $this->addCss('bootstrap-tagsinput.css');
    }

    public function index()
    {
        $data = array();
        $this->load->model('admin/Jobs/jobs_model');
        $this->load->helper('filter');
         $this->page = 'jobs';
        
        sorting_init();
        
        $page = $this->input->get('page');
        $page = (isset($page)) ? $page : 1;
        $limit = 10;
        $start = ($page * $limit) - $limit;
        $jobs = $this->jobs_model->getjobs($start, $limit);
        $total = $this->jobs_model->getCount();
        
        $this->pagination(site_url('admin/jobs/jobs'), $total, $limit);
        $data['jobs'] = $jobs;
        $this->load->template('jobs/jobs_list', $data);
    }

    public function add()
    {

        $this->load->model('admin/Jobs/jobs_model');
        $this->addScript('bootstrap-switch.js');
        $data = array();
        
        $requestdata = $this->input->post('ciform');

        if (! empty($requestdata)) {
       
            
                $jobsid = $this->jobs_model->save($requestdata);
                if ($jobsid) {
                    $this->setFlash('Job saved!', 'success');
                    redirect(site_url('admin/jobs/jobs/edit/id/' . $jobsid));
                } else {
                    $this->setFlash('Error!', 'danger');
                    redirect(site_url('admin/jobs/jobs/edit/id/' . $jobsid));
                }
           
        }        
        $data['jobs'] = new stdClass();
        $data['jobs']->title = (isset($requestdata['title'])) ? $requestdata['title'] : '';
        $data['jobs']->code = (isset($requestdata['code'])) ? $requestdata['code'] : '';
        $data['jobs']->description = (isset($requestdata['description'])) ? $requestdata['description'] : '';
        $data['jobs']->category_id = (isset($requestdata['category_id'])) ? $requestdata['category_id'] : '';
       
        $data['jobs']->max_salary = (isset($requestdata['max_salary'])) ? $requestdata['max_salary'] : '';
        $data['jobs']->min_salary = (isset($requestdata['min_salary'])) ? $requestdata['min_salary'] : '';
        $data['jobs']->city = (isset($requestdata['city'])) ? $requestdata['city'] : '';
        $data['jobs']->created_by = (isset($requestdata['created_by'])) ? $this->session->userdata('created_by') : 1;
        $data['jobs']->state = (isset($requestdata['state'])) ? $requestdata['state'] : '';
        $data['jobs']->country = (isset($requestdata['country'])) ? $requestdata['country'] : 0;
       
        $data['jobs']->zip_code = (isset($requestdata['zip_code'])) ? $requestdata['zip_code'] : '';
        $data['jobs']->tags = (isset($requestdata['tags'])) ? $requestdata['tags'] : '';
        $data['jobs']->job_type_id = (isset($requestdata['job_type_id'])) ? $requestdata['job_type_id'] : '';
        $data['jobs']->career_type_id = (isset($requestdata['career_type_id'])) ? $requestdata['career_type_id'] : 0;
        $data['jobs']->salary_type_id = (isset($requestdata['salary_type_id'])) ? $requestdata['salary_type_id'] : '';
        $data['jobs']->featured = (isset($requestdata['featured'])) ? $requestdata['featured'] : 0;
        $data['jobs']->published = (isset($requestdata['published'])) ? $requestdata['published'] : 0;
        $data['jobs']->id = 0;
        $data['jobs']->published_date = (isset($requestdata['published_date'])) ? $requestdata['published_date'] : 0;    
        $data['category'] = $this->jobs_model->getJobCategory();
        $data['job_type'] = $this->jobs_model->getJobType();
        $data['salary_type'] = $this->jobs_model->getJobSalary();
        $data['career'] = $this->jobs_model->getcareer();
        $data['skillarray'] = $this->jobs_model->getJobskilllevel();

        $countryarray = getCounties();
        $country = array();
        $country['--Select Types--'] = '';
        
        foreach ($countryarray as $value) {
                
            $country[$value['name']] = $value['id'];
        }
      $data['country'] = $country;
     

        $this->load->template('jobs/jobs_edit', $data);
    }

    public function edit()
    {
        $this->load->model('admin/Jobs/jobs_model');
        $this->addScript('bootstrap-switch.js');
        $data = array();        
        $requestdata = $this->input->post('ciform');
        if (! empty($requestdata)) {
           
                      

                $jobsid = $this->jobs_model->save($requestdata);
                if ($jobsid) {
                    $this->setFlash('jobs saved!', 'success');
                    redirect(site_url('admin/jobs/jobs/edit/id/' . $jobsid));
                } else {
                    $this->setFlash('Error!', 'danger');
                    redirect(site_url('admin/jobs/jobs/edit/id/' . $jobsid));
                }
        }        
        $jobsid = $this->input->get('id');
        $jobsid = (isset($jobsid)) ? $this->input->get('id') : 0;
        $data['jobs'] = $this->jobs_model->getjob($jobsid);
        $data['category'] = $this->jobs_model->getJobCategory();
        $data['job_type'] = $this->jobs_model->getJobType();
        $data['salary_type'] = $this->jobs_model->getJobSalary();
        $data['skillarray'] = $this->jobs_model->getJobskilllevel();
        $data['skills'] = $this->jobs_model->getJobskill($jobsid);
        $data['career'] = $this->jobs_model->getcareer();
        $data['skillarray'] = $this->jobs_model->getJobskilllevel();
        //country get

        $countryarray = getCounties();
        $country = array();
        $country['--Select Types--'] = '';
        foreach ($countryarray as $value) {                
            $country[$value['name']] = $value['id'];
        }
        $data['country'] = $country; 
        //state get
        $statearray = getState();
        $state = array();
        $state['--Select Types--'] = '';
        
        foreach ($statearray as $value) {
                
            $state[$value['name']] = $value['id'];
        }
        $data['state'] = $state; 
         //state get
        $cityarray = getCity();
        $city = array();
        $city['--Select Types--'] = '';
        
        foreach ($cityarray as $value) {
                
            $city[$value['name']] = $value['id'];
        }
        $data['city'] = $city; 
        if (! empty($data['jobs'])) {
            $this->load->template('jobs/jobs_edit', $data);
        } else {
            show_404();
        }
    }

    public function publish()
    {
        $cids = $this->input->post('cid');
        if (! empty($cids)) {
            $this->load->model('admin/Jobs/jobs_model');
            $this->jobs_model->publish($cids);
            $this->setFlash('jobs(s) are published!', 'success');
        }
        redirect(site_url('admin/jobs/jobs'));
    }

    public function unpublish()
    {
        $cids = $this->input->post('cid');
        if (! empty($cids)) {
            $this->load->model('admin/Jobs/jobs_model');
            $this->jobs_model->unpublish($cids);
            $this->setFlash('jobs(s) are unpublished!', 'success');
        }
        redirect(site_url('admin/jobs/jobs'));
    }

    public function delete()
    {
        $cids = $this->input->post('cid');
        if (! empty($cids)) {
            $this->load->model('admin/Jobs/jobs_model');
            $this->jobs_model->delete($cids);
            $this->setFlash('jobs(s) are deleted!', 'success');
        }
        redirect(site_url('admin/jobs/jobs'));
    }
}
