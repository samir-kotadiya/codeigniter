<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jobseekers extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->page = 'jobseekers';
        $this->addScript('tinymce.min.js');
               $this->addScript('moment.min.js');
        $this->load->helper('global');
         $this->addScript('bootstrap-switch.js');
              $this->addScript('bootstrap-datetimepicker.min.js');
        $this->addCss('datepicker.css');
    }

    public function index()
    {
        $this->page = 'jobseekers';
        $data = array();
        $this->load->model('admin/Jobs/jobseekers_model');
        $this->load->helper('filter');
        sorting_init();
        
        $page = $this->input->get('page');
        $page = (isset($page)) ? $page : 1;
        $limit = 10;
        $start = ($page * $limit) - $limit;
        $jobseekers = $this->jobseekers_model->getJobseekers($start, $limit);
        $total = $this->jobseekers_model->getCount();
        
        $this->pagination(site_url('admin/jobs/jobseekers'), $total, $limit);
        $data['form_list']['actions'] = array(
            'add' => array(
                'href' => site_url('admin/jobs/jobseekers/add')
            ),
            'publish' => array(),
            'unpublish' => array(),
            'delete' => array()
        );
        $data['form_list']['filters'] = array();
        $data['form_list']['lists']['fields'] = array(
            array(
                'label' => '',
                'field' => 'firstname',
                'checkall' => true
            ),
            array(
                'label' => 'Firstname',
                'field' => 'firstname',
                'sort' => true
            ),
            array(
                'label' => 'Lastname',
                'field' => 'lastname',
                'sort' => true
            ),
            array(
                'label' => 'Email',
                'field' => 'email',
                'sort' => true
            ),
            array(
                'label' => 'Status',
                'field' => 'published',
                'sort' => true
            ),
            array(
                'label' => 'Id',
                'field' => 'id',
                'sort' => true
            )
        );
        
        $fieldvalues = array();
        foreach ($jobseekers as $jobseeker) {
            $fieldvalues[] = array(
                array(
                    
                    'value' => $jobseeker['user_id'],
                    'type' => 'checkall'
                ),
                array(
                    'value' => $jobseeker['firstname'],
                    'href' => 'jobseekers/edit/id/',
                    'type' => 'anchore',
                    'id' => $jobseeker['user_id']
                ),
                array(
                    'value' => $jobseeker['lastname'],
                    'href' => '',
                    'type' => ''
                ),
                array(
                    'value' => $jobseeker['email'],
                    'href' => '',
                    'type' => ''
                ),
                array(
                    'value' => 'Status',
                    'publish' => $jobseeker['published'],
                    'type' => 'publishtoggel'
                ),
                array(
                    'value' => $jobseeker['user_id'],
                    'href' => '',
                    'type' => 'label'
                )
            );
        }
        
        $data['form_list']['lists']['values'] = $fieldvalues;
        $data['form_list']['action'] = 'admin/jobs/jobseekers';
        $data['form_list']['pagination'] = array();
        $this->load->template('jobs/jobseekers_list', $data);
    }

    public function add()
    {
        $this->load->model('admin/Jobs/jobseekers_model');
       
        $data = array();
        
        $requestdata = $this->input->post('ciform');
        if (! empty($requestdata)) {
         
            $userid = $this->jobseekers_model->save($requestdata);
            if ($userid) {
                $this->setFlash('User saved!', 'success');
                redirect(site_url('admin/jobs/jobseekers/edit/id/' . $userid));
            } else {
                $this->setFlash('Error!', 'danger');
                redirect(site_url('admin/jobs/jobseekers/edit/id/' . $userid));
            }
        }
        
        $data['jobseeker'] = new stdClass();
        $data['user'] = new stdClass();
        $data['user']->username = (isset($requestdata['username'])) ? $requestdata['username'] : '';
        $data['user']->email = (isset($requestdata['email'])) ? $requestdata['email'] : '';
        $data['user']->password = '';
        $data['user']->published = (isset($requestdata['published'])) ? $requestdata['published'] : 0;
        $data['user']->id = 0;
        $data['user']->group_id = (isset($requestdata['group_id'])) ? $requestdata['group_id'] : 0;
        $data['groups'] = $this->jobseekers_model->getGroups();
        $data['jobseeker']->firstname = (isset($requestdata['firstname'])) ? $requestdata['firstname'] : '';
        $data['jobseeker']->job_category_id = (isset($requestdata['job_category_id'])) ? $requestdata['job_category_id'] : '';
        $data['jobseeker']->lastname = (isset($requestdata['lastname'])) ? $requestdata['lastname'] : '';
        $data['jobseeker']->address = (isset($requestdata['address'])) ? $requestdata['address'] : '';
        $data['jobseeker']->workphone = (isset($requestdata['workphone'])) ? $requestdata['workphone'] : '';
        $data['jobseeker']->city = (isset($requestdata['city'])) ? $requestdata['city'] : 0;
        $data['jobseeker']->state = (isset($requestdata['state'])) ? $requestdata['state'] : 0;
        $data['jobseeker']->country = (isset($requestdata['country'])) ? $requestdata['country'] : 0;
        $data['jobseeker']->zip = (isset($requestdata['zip'])) ? $requestdata['zip'] : "";
        $data['jobseeker']->education = (isset($requestdata['education'])) ? $requestdata['education'] : "";
        $data['jobseeker']->resume = (isset($requestdata['resume'])) ? $requestdata['resume'] : "";
        $data['jobseeker']->skills = (isset($requestdata['skill'])) ? $requestdata['skill'] : "";
        $data['jobseeker']->experience = (isset($requestdata['experience'])) ? $requestdata['experience'] : "";
        $data['jobseeker']->user_id = 0;
        $data['jobseeker']->salary_type_id = (isset($requestdata['salary_type_id'])) ? $requestdata['salary_type_id'] : '';
        $data['jobseeker']->career_type_id = (isset($requestdata['career_type_id'])) ? $requestdata['career_type_id'] : '';
      
        $countryarray = getCounties();

        $data['categories'] = $this->jobseekers_model->getJobCategory(); 
        $data['salary_type'] = $this->jobseekers_model->getSalaryType();    
        $data['career_type'] = $this->jobseekers_model->getCareerType();    

        $educationarray = $this->jobseekers_model->getJobEducationsLevel();
        $educations = array();
        $educations['--Select Education--'] = '';
        foreach ($educationarray as $education) {
            $educations[$education['name']] = $education['id'];
        }
        $data['education']=$educations;

        $skilllevelsarray = $this->jobseekers_model->getSkillLevels();
        $skills = array();
        $skills['Select Skill'] = '';
        foreach ($skilllevelsarray as $skill) {
            $skills[$skill['name']] = $skill['id'];
        }
        $data['skillsarray']=$skills;
        $country = array();
        $country['--Select Country--'] = '';
        
        foreach ($countryarray as $value) {
            
            $country[$value['name']] = $value['id'];
        }
        $data['country'] = $country;
        $this->load->template('jobs/jobseeker_edit', $data);
    }

    public function edit()
    {
        $this->load->model('admin/Jobs/jobseekers_model');

        $data = array();
        
        $requestdata = $this->input->post('ciform');
        if (! empty($requestdata)) {
            // validate form input
       
                $userid = $this->jobseekers_model->save($requestdata);
                if ($userid) {
                    $this->setFlash('User saved!', 'success');
                    redirect(site_url('admin/jobs/jobseekers/edit/id/' . $userid));
                } else {
                    $this->setFlash('Error!', 'danger');
                    redirect(site_url('admin/jobs/jobseekers/edit/id/' . $userid));
                }
            
        }
        
        $userid = $this->input->get('id');
        $userid = (isset($userid)) ? $this->input->get('id') : 0;
        $data['user'] = $this->jobseekers_model->getUser($userid);
        $data['jobseeker'] = $this->jobseekers_model->getJobseeker($userid);
        $userid = $this->input->get('id');
        $data['groups'] = $this->jobseekers_model->getGroups();
        $data['categories'] = $this->jobseekers_model->getJobCategory(); 
        $data['salary_type'] = $this->jobseekers_model->getSalaryType();    
        $data['career_type'] = $this->jobseekers_model->getCareerType();    
       $educationarray = $this->jobseekers_model->getJobEducationsLevel();
        $educations = array();
        $educations['--Select Education--'] = '';
        foreach ($educationarray as $education) {
            $educations[$education['name']] = $education['id'];
        }
        $data['education']=$educations;
        $skilllevelsarray = $this->jobseekers_model->getSkillLevels();
        $skills = array();
        $skills['Select Skill'] = '';
        foreach ($skilllevelsarray as $skill) {
            $skills[$skill['name']] = $skill['id'];
        }
        $data['skillsarray']=$skills;
        $countryarray = getCounties();
        $country = array();
        $country['--Select Types--'] = '';
        foreach ($countryarray as $value) {
            $country[$value['name']] = $value['id'];
        }
        $data['country'] = $country;
        // state get
        $statearray = getState();
        $state = array();
        $state['--Select Types--'] = '';
        
        foreach ($statearray as $value) {
            
            $state[$value['name']] = $value['id'];
        }
        $data['state'] = $state;
        // state get
        $cityarray = getCity();
        $city = array();
        $city['--Select Types--'] = '';
        
        foreach ($cityarray as $value) {
            
            $city[$value['name']] = $value['id'];
        }
        $data['city'] = $city;
        $data['experience'] = $this->jobseekers_model->getexperience($userid);
        $data['skills']=$this->jobseekers_model->getskill($userid);
        $data['educations']=$this->jobseekers_model->geteducations($userid);
        
        if (! empty($data['user'])) {
            $this->load->template('jobs/jobseeker_edit', $data);
        } else {
            show_404();
        }
    }

    public function publish()
    {
        $cids = $this->input->post('cid');
        if (! empty($cids)) {
            $this->load->model('admin/Jobs/jobseekers_model');
            $this->jobseekers_model->publish($cids);
            $this->setFlash('User(s) are published!', 'success');
        }
        redirect(site_url('admin/jobs/jobseekers'));
    }

    public function unpublish()
    {
        $cids = $this->input->post('cid');
        if (! empty($cids)) {
            $this->load->model('admin/Jobs/jobseekers_model');
            $this->jobseekers_model->unpublish($cids);
            $this->setFlash('User(s) are unpublished!', 'success');
        }
        redirect(site_url('admin/jobs/jobseekers'));
    }

    public function delete()
    {
        $cids = $this->input->post('cid');
        if (! empty($cids)) {
            $this->load->model('admin/Jobs/jobseekers_model');
            $this->jobseekers_model->delete($cids);
            $this->setFlash('User(s) are deleted!', 'success');
        }
        redirect(site_url('admin/jobs/jobseekers'));
    }
}
