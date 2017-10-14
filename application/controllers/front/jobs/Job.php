<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Job extends Front_Controller
{

    public function __construct()
    {
    	$this->menuitem = 'job';
        parent::__construct();
         $this->load->helper('global');
        $this->load->model('front/jobs_model');
         $this->addScript('bootstrap-tagsinput.min.js');
        
        $this->addScript('moment.min.js');
        $this->addScript('bootstrap-datetimepicker.min.js');
        $this->addCss('datepicker.css');
        
        $this->lang->load("jobs", $this->language);
        $this->addScript('formValidation.min.js');
        
        $this->addScript('jquery.bootstrap.wizard.min.js');
        $this->addScript('tinymce.min.js');
        $this->addCss('build.css');
        $this->addCss('formValidation.min.css');
        $this->addCss('bootstrap-tagsinput.css');
    }

    public function add()
    {
        $fielddata['statearray'] = array();
        $fielddata['cityarray'] = array();
        
        $data['forms'] = $this->getJobaddFields($fielddata);
        $data['forms']['action'] = site_url('jobs/job/save');
        $this->load->template('jobs/add', $data);
    }

    public function edit()
    {
        $id=$this->input->get('id'); 
        $jobs = $this->jobs_model->getJobdetail($id); 
 		
        // state get
        $statearray = getState();
        $state = array();
        $state['--Select Types--'] = '';
        foreach ($statearray as $value) {
            
            $state[$value['name']] = $value['id'];
        }
        $jobs['statearray'] = $state;
        
        // state city
        $cityarray = getCity();
        $city = array();
        $city['--Select Types--'] = '';
        foreach ($cityarray as $value) {
            $city[$value['name']] = $value['id'];
        }
        $jobs['cityarray'] = $city;

        $data['forms'] = $this->getJobaddFields($jobs); 
        $data['forms']['action'] = site_url('jobs/job/updatejob');
        $this->load->template('jobs/add', $data);
    }
    
    public function getJobaddFields($data = array())
    {
        $countriesarray = getCounties();
        $countries = array();
        $countries['--Select country--'] = '';
        foreach ($countriesarray as $country) {
            $countries[$country['name']] = $country['id'];
        }
        
        $categoryarray = $this->jobs_model->getJobCategory();
        $catogries = array();
        $catogries['--Select Category--'] = '';
        foreach ($categoryarray as $category) {
            $catogries[$category['title']] = $category['id'];
        }

        $salaryarray = $this->jobs_model->getJobSalary();
        $salarys = array();
        $salarys['--Select Salary--'] = '';
        foreach ($salaryarray as $salary) {
            $salarys[$salary['type']] = $salary['id'];
        }
        
        $typearray = $this->jobs_model->getJobType();
        $types = array();
        foreach ($typearray as $type) {
            $types[$type['title']] = $type['id'];
        }
    
        // Job carrer levels
        $careerarray = $this->jobs_model->getJobCareers();
        $careeres = array();
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
        
        // Skill lists
        if(empty($data['skills'])){
        	$skilllists = array(
        			array(
                    'name' => 'skill',
                    'type' => 'group',
                    'label' => $this->lang->line('skill_skill_placehoder_text'),
                    'addmore' => true,
        			'incement'	=> 1,
                    'fields' => array(
                        array(
                            'name' => 'skill[0][skill]',
                            'type' => 'text',
                            'class' => 'col-sm-3',
                            'placeholder' => $this->lang->line('skill_skill_placehoder_text')
                        ),
                        array(
                            'name' => 'skill[0][experience]',
                            'type' => 'text',
                            'placeholder' => $this->lang->line('skill_experience_placehoder_text'),
                            'class' => 'col-sm-3'
                        ),
                        array(
                            'name' => 'skill[0][skilllevel]',
                            'type' => 'select',
                            'options' => $skills,
                            'placeholder' => $this->lang->line('skill_level_placehoder_text'),
                            'class' => 'col-sm-3'
                        )
                    )
                )
        	);
        }else{
        	foreach($data['skills'] as $key=>$skilldetail){
        		$skilllists[] = array(
                    'name' => 'skill',
                    'type' => 'group',
                    'label' => ($key==0)?$this->lang->line('skill_skill_placehoder_text'):'',
                    'addmore' => ($key==0)?true:false,
        			'removable' => ($key==0)?false:true,
        			'incement'	=> count($data['skills']),
                    'fields' => array(
                        array(
                            'name' => "skill[$key][skill]",
                            'type' => 'text',
                            'class' => 'col-sm-3',
                        	'value' => $skilldetail['skill'],
                            'placeholder' => $this->lang->line('skill_skill_placehoder_text')
                        ),
                        array(
                            'name' => "skill[$key][experience]",
                            'type' => 'text',
                        	'value' => $skilldetail['experience'],
                            'placeholder' => $this->lang->line('skill_experience_placehoder_text'),
                            'class' => 'col-sm-3'
                        ),
                        array(
                            'name' => "skill[$key][skilllevel]",
                            'type' => 'select',
                        	'value' => $skilldetail['skilllevel'],
                            'options' => $skills,
                            'placeholder' => $this->lang->line('skill_level_placehoder_text'),
                            'class' => 'col-sm-3'
                        )
                    )
                );
        	}
        }
        
        $fields1 = array(
                array(
                    'name' => 'title',
                    'type' => 'text',
                    'value' => (isset($data['title'])) ? $data['title'] : '',
                    'placeholder' => $this->lang->line('job_title'),
                    'label' => $this->lang->line('job_title'),
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'code',
                    'value' => (isset($data['code'])) ? $data['code'] : '',
                    'type' => 'text',
                    'placeholder' => 'Code',
                    'label' => $this->lang->line('code')
                ),
                array(
                    'name' => 'category_id',
                    'value' => (isset($data['category_id'])) ? $data['category_id'] : '',
                    'type' => 'select',
                    'label' => $this->lang->line('category'),
                    'options' => $catogries,
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'salary_type_id',
                    'type' => 'select',
                    'value' => (isset($data['salary_type_id'])) ? $data['salary_type_id'] : '',
                    'placeholder' => 'Salary Type',
                    'label' => $this->lang->line('salary_type'),
                    'options' => $salarys
                ),
                array(
                    'name' => 'max_salary',
                    'type' => 'text',
                    'placeholder' => 'Maximum Salary',
                    'value' => (isset($data['max_salary'])) ? $data['max_salary'] : '',
                    'label' => $this->lang->line('maximum_salary')
                   
                ),
                
                array(
                    'name' => 'min_salary',
                    'type' => 'text',
                    'placeholder' => 'Minimum Salary',
                    'value' => (isset($data['min_salary'])) ? $data['min_salary'] : '',
                    'label' => $this->lang->line('minimum_salary')
                   
                ),
                array(
                    'name' => 'job_type_id',
                    'type' => 'radio',
                    'value' => (isset($data['job_type_id'])) ? $data['job_type_id'] : '',
                    'label' => $this->lang->line('job_type'),
                    'options' => $types
                ),
                array(
                    'name' => 'address',
                    'type' => 'text',
                    'placeholder' => 'address',
                       'value' => (isset($data['address'])) ? $data['address'] : '',
                    'label' => $this->lang->line('address'),
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'country',
                    'type' => 'select',
                    'class' => 'countrychange',
                    'value' => (isset($data['country'])) ? $data['country'] : '',
                    'label' => $this->lang->line('country'),
                    'options' => $countries,
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'state',
                    'type' => 'select',
                    'class' => 'catchstates statechange',
                    'label' => $this->lang->line('state'),
                    'value' => (isset($data['state'])) ? $data['state'] : '',
                    'options' => (isset($data['statearray'])) ? $data['statearray'] : '',
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'city',
                    'type' => 'select',
                    'class' => 'catchcities',
                    'value' => (isset($data['city'])) ? $data['city'] : '',
                    'options' => (isset($data['cityarray'])) ? $data['cityarray'] : '',
                    'label' => $this->lang->line('city'),
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'zip_code',
                    'type' => 'text',
                    'placeholder' => 'Zip Code',
                    'value' => (isset($data['zip_code'])) ? $data['zip_code'] : '',
                    'label' => $this->lang->line('zip_code'),
                    'valid' => array(
                        'require',
                        'numeric'
                    )
                ),
                array(
                    'name' => 'description',
                    'placeholder' => 'Description',
                    'type' => 'editor',
                    'value' => (isset($data['description'])) ? $data['description'] : '',
                    'label' => $this->lang->line('description')
                ),
                array(
                    'name' => 'career_type_id',
                    'type' => 'radio',
                    'value' => (isset($data['career_type_id'])) ? $data['career_type_id'] : '',
                    'label' => $this->lang->line('career_level_text'),
                    'options' => $careeres,
                    'valid' => array(
                        'require'
                    )
                )
            );
        
        $fields3 = array(
        		array(
        				'name' => 'featured',
        				'type' => 'checkbox',
        				'value' => (isset($data['featured'])) ? $data['featured'] : '',
        				'label' => $this->lang->line('featured'),
        				'options' => array(
        						'' => 1
        				)
        		),
        		array(
        				'name' => 'published_date',
        				'type' => 'datepicker',
        				'value' => (isset($data['published_date'])) ? $data['published_date'] : '',
        				'placeholder' => 'Published date',
        				'label' => $this->lang->line('publish_date'),
        				'valid' => array(
        						'require'
        				)
        		),
        		array(
        				'name' => 'tags',
        				'type' => 'tag',
        				'placeholder' => 'Tags',
        				'value' => (isset($data['tags'])) ? $data['tags'] : '',
        				'label' => $this->lang->line('job_tag')
        		),
        		array(
        				'name' => 'id',
        				'type' => 'hidden',
        				'value' => (isset($data['id'])) ? $data['id'] : ''
        		),
        		array(
        				'name' => 'language',
        				'type' => 'select',
        				'value' => (isset($data['language'])) ? $data['language'] : '',
        				'label' => $this->lang->line('language'),
        				'options' => array(
        						$this->lang->line('language_msg') => 1,
        						$this->lang->line('english') => 2,
        						$this->lang->line('spanish') => 3
        				)
        		)
        );
        
        $fields = array_merge($fields1,$skilllists,$fields3);
        
        $return['fieldsets']['basic'] = array(
            'active' => true,
            'fields' => $fields
        );
        
        return $return;
    }

    public function save()
    {
        $requestdata = $this->input->post();
        
        // Prepare data with compitible to database keys
        $requestdata['job_type_id'] = ($requestdata['job_type_id'][0]) ? $requestdata['job_type_id'][0] : 0;
        $requestdata['featured'] = ($requestdata['featured'][0]) ? $requestdata['featured'][0] : 0;
        $requestdata['skill'] = $requestdata['skill'];
        $requestdata['career_type_id'] = ($requestdata['career_type_id'][0]) ? $requestdata['career_type_id'][0] : 0;
        
        $date = date_create($requestdata['published_date']);
        $date = date_format($date, 'Y-m-d H:i:s ');
        $requestdata['published_date'] = $date;
        $usersession = $this->session->userdata('user');
        $requestdata['created_by'] = $usersession['userid'];
        
        // Store data to database
        $this->jobs_model->save($requestdata);
        
        // Redirect to proper page
        redirect(site_url('jobs/lists'));
    }
    
    public function updatejob()
    {

    	$requestdata = $this->input->post();
    	/*echo"<pre>";exit(print_r($requestdata));*/
        $id['job_id']=$requestdata['id'];
        $postdata = $id;
        $job['title']=$requestdata['title'];
    	$job['description']=$requestdata['description'];
    	$job['code']=$requestdata['code'];
    	$job['code']=$requestdata['code'];
    	$job['category_id']=$requestdata['category_id'];
    	$job['salary_type_id']=$requestdata['salary_type_id'];
    	$job['max_salary']=$requestdata['max_salary'];
    	$job['min_salary']=$requestdata['min_salary'];
    	$job['city']=$requestdata['city'];
    	$job['state']=$requestdata['state'];
    	$job['country']=$requestdata['country'];
    	$job['address']=$requestdata['address'];

    	$job['zip_code']=$requestdata['zip_code'];
    	$job['tags']=$requestdata['tags'];
    	$job['language']=$requestdata['language'];
    	$job['job_type_id']=$requestdata['job_type_id'];
    	$job['career_type_id']=$requestdata['career_type_id'];
        
        $postdata['job'] = $job;
       
        $postdata['skill']=$requestdata['skill'];

        
    	$this->jobs_model->editjob($postdata);
    	$this->setFlash($this->lang->line('lbl_edit_msg'), 'success');
    	redirect(base_url('jobs/mylists'));
    }

    public function view()
    {
        $data = array();
        $data['title'] = $this->lang->line('lbl_job_detail');
        $id = (int) $this->input->get('id');
        
        if ($id > 0) {
            $job = $this->jobs_model->getJob($id);
            
            if(empty($job)){
            	show_404();	
            }
            
            // Add hit for job
            $this->jobs_model->addHit($job['id']);
            
            // Process job
            $job['tags'] = explode(',', $job['tags']);
            $job['company_logo'] = getResizeImage($job['company_logo'], array(
                'width' => 200,
                'height' => 200
            ));
            
            $data['job'] = $job;
            
            // Format address
            $locationsearch = array(
                '{address}',
                '{city}',
                '{state}',
                '{zipcode}',
                '{country}'
            );
            
            $locationreplace = array(
                $job['address'],
                $job['city_name'],
                $job['state_name'],
                $job['zip_code'],
                $job['country_name']
            );
            
            $locationformat = "{address} <br> {city} {state}-{zipcode},{country}";
            
            $data['job']['location'] = str_replace($locationsearch, $locationreplace, $locationformat);
            
            if (empty($data['job'])) {
                show_404();
            }
        } else {
            show_404();
        }
        
        $this->load->template('jobs/view', $data);
    }
    
    public function apply()
    {
        $requestdata = $this->input->post();
        $user = getUser();
        
        if (! empty($user->id) && $user->group_id==3) {
            if (isset($requestdata['jobid'])) {
                $result = $this->jobs_model->apply($requestdata['jobid'], $user->id);
                if ($result) {
                    $response['status'] = $this->lang->line('job_success_msg');
                    $response['message'] =  $this->lang->line('applied_job_success_msg');
                } else {
                    $response['status'] = $this->lang->line('job_error_msg');
                    $response['message'] = $this->lang->line('job_already_applied_msg');
                }
            } else {
                $response['status'] = $this->lang->line('job_error_msg');
                $response['message'] = $this->lang->line('job_something_wrong_msg');
            }
        } else {
            $response['status'] = $this->lang->line('job_error_msg');
            $response['message'] = $this->lang->line('login_apply_job_msg');
        }
        
        echo json_encode($response);
        exit();
    }
    
    public function savejob() {
    	$requestdata = $this->input->post();
        $user = getUser();
        
        if (! empty($user->id) && $user->group_id == 3) {
            if (isset($requestdata['jobid'])) {
                $result = $this->jobs_model->savejob($requestdata['jobid'], $user->id);
                if ($result) {
                    $response['status'] =  $this->lang->line('job_success_msg');
                    $response['message'] = $this->lang->line('applied_job_success_msg');
                } else {
                    $response['status'] = $this->lang->line('job_error_msg');
                    $response['message'] = $this->lang->line('job_already_applied_msg');
                }
            } else {
                $response['status'] = $this->lang->line('job_error_msg');
                $response['message'] = $this->lang->line('job_something_wrong_msg');
            }
        } else {
            $response['status'] = $this->lang->line('job_error_msg');
            $response['message'] = $this->lang->line('login_apply_job_msg');
        }
        
        echo json_encode($response);
        exit();
    }
}