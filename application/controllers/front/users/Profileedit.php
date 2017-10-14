<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProfileEdit extends Front_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        $this->checklogin();
        
        $this->load->helper('global');
        $this->load->model('front/jobs_model');
        $this->load->model('front/user_model');
        $this->addScript('moment.min.js');
        $this->addScript('bootstrap-datetimepicker.min.js');
        $this->addCss('datepicker.css');
        $this->lang->load("jobs", $this->language);
        $this->addScript('formValidation.min.js');
        $this->addScript('jquery.bootstrap.wizard.min.js');
        $this->addScript('tinymce.min.js');
        $this->addCss('build.css');
        $this->addCss('formValidation.min.css');
    }

    public function edit()
    {
        $data = array();
       
        $user = getUser();
        if($user->group_id==2){
        	$data['forms'] = $this->getEmployerFields($user->id);
        } else {
        	$data['forms'] = $this->getJobseekerFields($user->id);
        }
        
        $data['forms']['action'] = site_url('users/Profileedit/save');
    	$this->load->template('users/profileedit', $data);
    }
    
	public function getEmployerFields($userid)
    {
    	$value = $this->user_model->getEmployerProfile($userid);
    	
        $this->load->helper('global');
        $countriesarray = getCounties();
        $countries = array();
        $countries['--Select country--'] = '';
        foreach ($countriesarray as $country) {
            $countries[$country['name']] = $country['id'];
        }
        $statearray = getState();
        $states = array();
        $states['--Select State--'] = '';
        foreach ($statearray as $state) {
            $states[$state['name']] = $state['id'];
        }

        $cityarray = getCity();
        $cities = array();
        $cities['--Select Citys--'] = '';
        foreach ($cityarray as $city) {
            $cities[$city['name']] = $city['id'];
        }
        
        $return['fieldsets']['basic'] = array(
            'label' => '',
            'active' => true,
            'fields' => array(
                array(
                    'name' => 'firstname',
                    'type' => 'text',
                    'placeholder' => 'Firstname',
                    'label' => $this->lang->line('firstname'),
                    'value' => $value['firstname'],
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'lastname',
                    'type' => 'text',
                    'placeholder' => 'Lastname',
                    'label' => $this->lang->line('lastname'),
                    'value' => $value['lastname'],
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'email',
                    'type' => 'textdisplay',
                    'placeholder' => 'Email',
                    'label' => $this->lang->line('email'),
                       'value' => $value['email'],
                    'validationurl' => site_url('common/ajax/validuser'),
                    'valid' => array(
                        'require',
                        'email'
                    )
                ),
                array(
                    'name' => 'user_id',
                    'type' => 'hidden',
                    'value' => $value['user_id'],
                ),
             	array(
                    'name' => 'company',
                    'placeholder' => 'Company',
                    'type' => 'text',
                    'label' => $this->lang->line('company'),
                    'value' => $value['company'],
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'logo',
                    'type' => 'file',
                    'label' => $this->lang->line('photo'),
                    'value' =>  getResizeImage($value['logo'], 
                              array(
                              'width' => 150,
                              'height' => 150
                            ))
                ),
                array(
                    'name' => 'address',
                    'placeholder' => 'Address',
                    'type' => 'editor',
                    'label' => $this->lang->line('address'),
                      'value' => $value['address'], 
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'workphone',
                    'placeholder' => 'Workphone',
                    'type' => 'text',
                    'label' => $this->lang->line('workphone'),
                    'value' => $value['workphone']
                ),
                array(
                    'name' => 'country',
                    'type' => 'select',
                    'class' => 'countrychange',
                    'label' => $this->lang->line('country'),
                    'options' => $countries,
                    'value' => $value['country'],
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'state',
                    'type' => 'select',
                    'class' => 'catchstates statechange',
                    'label' => $this->lang->line('state'),
                    'value' => $value['state'],
                     'options' => $states,
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'city',
                    'type' => 'select',
                    'class' => 'catchcities',
                    'label' => $this->lang->line('city'),
                    'value' => $value['city'],
                     'options' => $cities,
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'zip',
                    'type' => 'text',
                    'placeholder' => 'Zip',
                    'label' => $this->lang->line('zip'),
                    'value' => $value['zip'],
                    'valid' => array(
                        'require',
                        'numeric'
                    )
                ),
                array(
                    'name' => 'phoneno',
                    'type' => 'text',
                    'placeholder' => 'Phone No',
                    'label' => $this->lang->line('business_phone'),
                    'value' => $value['phoneno']
                ),
                array(
                    'name' => 'website',
                    'type' => 'text',
                    'placeholder' => 'Website',
                    'label' => $this->lang->line('website'),
                        'value' => $value['website'],
                    'valid' => array(
                        'require',
                        'website'
                    )
                )
            )
        );
        return $return;
    }
    
    public function getJobseekerFields($userid)
    {
    	$value = $this->user_model->getJobseekerProfile($userid);
    	
    	$this->load->helper('global');
    	// Job categories
        $categoriesarray = $this->jobs_model->getJobCategory();
        $categories = array();
        $categories['--Select Category--'] = '';
        foreach ($categoriesarray as $category) {
            $categories[$category['title']] = $category['id'];
        }
        
        // Job salary type
        $salaryarray = $this->jobs_model->getJobSalary();
        $salaries = array();
        foreach ($salaryarray as $salary) {
            $salaries[$salary['type']] = $salary['id'];
        }
        
        // Job carrer levels
        $careerarray = $this->jobs_model->getJobCareers();
        $careeres = array();
        foreach ($careerarray as $career) {
            $careeres[$career['name']] = $career['id'];
        }
        
        // Job education levels
        $educationarray = $this->jobs_model->getJobEducationsLevel();
        $educations = array();
        foreach ($educationarray as $education) {
            $educations[$education['name']] = $education['id'];
        }
        
        // Skill levels
        $skilllevelsarray = $this->jobs_model->getSkillLevels();
        $skills = array();
        $skills[$this->lang->line('skill_level_placehoder_text')] = '';
        foreach ($skilllevelsarray as $skill) {
            $skills[$skill['name']] = $skill['id'];
        }
        
        // Countries
        $countriesarray = getCounties();
        $countries = array();
        $countries['--Select country--'] = '';
        foreach ($countriesarray as $country) {
            $countries[$country['name']] = $country['id'];
        }
        
        // States
        $statearray = getState();
        $states = array();
        $states['--Select State--'] = '';
        foreach ($statearray as $state) {
        	$states[$state['name']] = $state['id'];
        }
        
        // City
        $cityarray = getCity();
        $cities = array();
        $cities['--Select Citys--'] = '';
        foreach ($cityarray as $city) {
        	$cities[$city['name']] = $city['id'];
        }
        
        // Get Education
        $JEducations = $this->user_model->getJobseekerEducation($userid);
        // Get Experience
        $JExperiences = $this->user_model->getJobseekerExperience($userid);
        // Get Skill        
        $JSkills = $this->user_model->getJobseekerSkills($userid);
        
        $fields1 = array(
        				array(
    							'name' => 'firstname',
    							'type' => 'text',
    							'value'=> $value['firstname'],
    							'placeholder' => $this->lang->line('firstname'),
    							'label' => $this->lang->line('firstname'),
    							'valid' => array(
    									'require'
    							)
    					),
    					array(
    							'name' => 'lastname',
    							'type' => 'text',
    							'value'=> $value['lastname'],
    							'placeholder' => $this->lang->line('lastname'),
    							'label' => $this->lang->line('lastname'),
    							'valid' => array(
    									'require'
    							)
    					),
    					array(
    							'name' => 'email',
    							'type' => 'textdisplay',
    							'value'=> $value['email'],
    							'placeholder' => $this->lang->line('email'),
    							'label' => $this->lang->line('email'),
    							'validationurl' => site_url('common/ajax/validuser'),
    							'valid' => array(
    									'require',
    									'email',
    									'remote'
    							)
    					),
    					array(
    							'name' => 'user_id',
    							'type' => 'hidden',
    							'value' => $value['user_id']
    					)
        		);
        
        foreach($JExperiences as $key=>$JExperience){
        	$fields2[] = array(
        					'name' => 'experience',
        					'type' => 'group',
        					'label' => ($key==0)?$this->lang->line('experience'):'',
		        			'addmore' => ($key==0)?true:false,
		        			'removable' => ($key==0)?false:true,
		        			'incement'	=> count($JExperiences),
        					'fields' => array(
        							array(
        									'name' => "experience[$key][title]",
        									'type' => 'text',
        									'class' => 'col-sm-4',
        									'value' => $JExperience['title'],
        									'placeholder' => $this->lang->line('job_title'),
        									'valid' => array(
        											'require'
        									)
        							),
        							array(
        									'name' => "experience[$key][startdate]",
        									'type' => 'datepicker',
        									'class' => 'col-sm-4',
        									'value' => $JExperience['startdate'],
        									'placeholder' => $this->lang->line('start_date'),
        									'valid' => array(
        											'require'
        									)
        							),
        							array(
        									'name' => "experience[$key][enddate]",
        									'type' => 'datepicker',
        									'class' => 'col-sm-4',
        									'value' => $JExperience['enddate'],
        									'placeholder' => $this->lang->line('end_date'),
        									'valid' => array(
        											'require'
        									)
        							)
        					)
        			);
        }
        
        $fields3 = array(
        				array(
    							'name' => 'job_category_id',
    							'type' => 'select',
    							'value'=> $value['job_category_id'],
    							'label' => $this->lang->line('category_text'),
    							'options' => $categories,
    							'valid' => array(
    									'require'
    							)
    					),
    					array(
    							'name' => 'career_type_id',
    							'type' => 'radio',
    							'value'=> $value['career_type_id'],
    							'label' => $this->lang->line('career_level_text'),
    							'options' => $careeres,
    							'valid' => array(
    									'require'
    							)
    					)
        		);
        
        foreach($JEducations as $key=>$JEducation){
        	$fields4[] = array(
        					'name' => 'educations',
        					'type' => 'group',
        					'label' => ($key==0)?$this->lang->line('education'):'',
		        			'addmore' => ($key==0)?true:false,
		        			'removable' => ($key==0)?false:true,
		        			'incement'	=> count($JEducations),
        					'fields' => array(
        							array(
        									'name' => "education[$key][level]",
        									'type' => 'select',
        									'options' => $educations,
        									'value' => $JEducation['level'],
        									'class' => 'col-sm-3'
        							),
        							array(
        									'name' => "education[$key][institute_name]",
        									'type' => 'text',
        									'value' => $JEducation['institute_name'],
        									'placeholder' => $this->lang->line('education_institute_name_placehoder_text'),
        									'class' => 'col-sm-3'
        							),
        							array(
        									'name' => "education[$key][study]",
        									'type' => 'text',
        									'value' => $JEducation['study'],
        									'placeholder' => $this->lang->line('education_study_placehoder_text'),
        									'class' => 'col-sm-3'
        							),
        							array(
        									'name' => "education[$key][year]",
        									'type' => 'text',
        									'value' => $JEducation['year'],
        									'placeholder' => $this->lang->line('education_year_placehoder_text'),
        									'class' => 'col-sm-3'
        							)
        					)
        			);
        }
        
        foreach($JSkills as $key=>$JSkill){
        	$fields5[] = array(
        					'name' => 'skill',
        					'type' => 'group',
        					'label' => ($key==0)?$this->lang->line('skill_skill_placehoder_text'):'',
		        			'addmore' => ($key==0)?true:false,
		        			'removable' => ($key==0)?false:true,
		        			'incement'	=> count($JExperiences),
        					'fields' => array(
        							array(
        									'name' => "skill[$key][skill]",
        									'type' => 'text',
        									'class' => 'col-sm-3',
        									'value' => $JSkill['skill'],
        									'placeholder' => $this->lang->line('skill_skill_placehoder_text')
        							),
        							array(
        									'name' => "skill[$key][experience]",
        									'type' => 'text',
        									'value' => $JSkill['experience'],
        									'placeholder' => $this->lang->line('skill_experience_placehoder_text'),
        									'class' => 'col-sm-3'
        							),
        							array(
        									'name' => "skill[$key][skilllevel]",
        									'type' => 'select',
        									'options' => $skills,
        									'value' => $JSkill['skilllevel'],
        									'placeholder' => $this->lang->line('skill_level_placehoder_text'),
        									'class' => 'col-sm-3'
        							)
        					)
        			);
        }
        
        $fields6 = array(
        				array(
    							'name' => 'resume',
    							'type' => 'editor',
    							'value'=> $value['resume'],
    							'label' => $this->lang->line('resume'),
    							'valid' => array(
    									'require'
    							)
    					),
    					array(
    							'name' => 'address',
    							'type' => 'text',
    							'value'=> $value['address'],
    							'label' => $this->lang->line('address'),
    							'valid' => array(
    									'require'
    							)
    					),
    					array(
    							'name' => 'workphone',
    							'type' => 'text',
    							'value'=> $value['workphone'],
    							'placeholder' => $this->lang->line('workphone'),
    							'label' => $this->lang->line('workphone')
    					),
    					array(
    							'name' => 'country',
    							'type' => 'select',
    							'value'=> $value['country'],
    							'class' => 'countrychange',
    							'label' => $this->lang->line('country'),
    							'options' => $countries,
    							'valid' => array(
    									'require'
    							)
    					),
    					array(
    							'name' => 'state',
    							'type' => 'select',
    							'value'=> $value['state'],
    							'class' => 'catchstates statechange',
    							'label' => $this->lang->line('state'),
    							'options' => $states,
    							'valid' => array(
    									'require'
    							)
    					),
    					array(
    							'name' => 'city',
    							'type' => 'select',
    							'value'=> $value['city'],
    							'class' => 'catchcities',
    							'options' => $cities,
    							'label' => $this->lang->line('city'),
    							'valid' => array(
    									'require'
    							)
    					),
    					array(
    							'name' => 'zip',
    							'type' => 'text',
    							'value'=> $value['zip'],
    							'placeholder' => $this->lang->line('workphone'),
    							'label' => $this->lang->line('zip'),
    							'valid' => array(
    									'require',
    									'numeric'
    							)
    					),
    					array(
    							'name' => 'group_id',
    							'type' => 'hidden',
    							'value' => '3'
    					)
        		);
        
        $fields = array_merge($fields1,$fields2,$fields3,$fields4,$fields5,$fields6);
        
    	
    	$return['fieldsets']['basic'] = array(
    			'label' => 'Basic',
    			'active' => true,
    			'fields' => $fields
    	);
    
    	return $return;
    }
    
    public function save()
    {
            $user = getUser();
            $data = $this->input->post();
       		if($user->group_id == 2){ //Save employer
            	if($_FILES['logo']['name'] != ''){
            		$image = uploadfile('logo');
            	}
            	
            	$employer['firstname'] = (isset($data['firstname'])) ? $data['firstname'] : '';
            	$employer['lastname'] = (isset($data['lastname'])) ? $data['lastname'] : '';
            	$employer['address'] = (isset($data['address'])) ? $data['address'] : '';
            	$employer['workphone'] = (isset($data['workphone'])) ? $data['workphone'] : '';
            	$employer['company'] = (isset($data['company'])) ? $data['company'] : '';
            	$employer['country'] = (isset($data['country'])) ? $data['country'] : '';
            	$employer['state'] = (isset($data['state'])) ? $data['state'] : '';
            	$employer['city'] = (isset($data['city'])) ? $data['city'] : '';
            	$employer['zip'] = (isset($data['zip'])) ? $data['zip'] : '';
            	
            	if($_FILES['logo']['name'] != ''){
            		$employer['logo'] = (isset($image)) ? $image : '';
            	}
            	
            	$employer['phoneno'] = (isset($data['phoneno'])) ? $data['phoneno'] : '';
            	$employer['website'] = (isset($data['website'])) ? $data['website'] : '';
            	//$users['password'] = (isset($data['password'])) ? md5($data['password']) : '';
            	 
            	$postdata['employer'] = $employer;
            	
            	$this->user_model->saveemployer($postdata);
            }else{ //Save jobseeker
            	$jobseeker['firstname'] = (isset($data['firstname'])) ? $data['firstname'] : '';
            	$jobseeker['lastname'] = (isset($data['lastname'])) ? $data['lastname'] : '';
            	$jobseeker['address'] = (isset($data['address'])) ? $data['address'] : '';
            	$jobseeker['workphone'] = (isset($data['workphone'])) ? $data['workphone'] : '';
            	$jobseeker['country'] = (isset($data['country'])) ? $data['country'] : '';
            	$jobseeker['state'] = (isset($data['state'])) ? $data['state'] : '';
            	$jobseeker['city'] = (isset($data['city'])) ? $data['city'] : '';
            	$jobseeker['zip'] = (isset($data['zip'])) ? $data['zip'] : '';
            	$jobseeker['resume'] = (isset($data['resume'])) ? $data['resume'] : '';
            	$postdata['jobseeker'] = $jobseeker;
            	$postdata['experience'] = (isset($data['experience'])) ? $data['experience'] : '';
            	$postdata['education'] = (isset($data['education'])) ? $data['education'] : '';
            	$postdata['skill'] = (isset($data['skill'])) ? $data['skill'] : '';
            
            	$this->user_model->savejobseeker($postdata);
            }
         
       		redirect(site_url('users/profileedit/edit'));
    }
}