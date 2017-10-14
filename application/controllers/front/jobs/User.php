<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends Front_Controller
{
	
	public function __construct()
	{
		parent::__construct();
	}

    public function register()
    {
        $this->addScript('moment.min.js');
        $this->addScript('bootstrap-datetimepicker.min.js');
        $this->addCss('datepicker.css');
        $this->lang->load("jobs", $this->language);
        $group = $this->input->get('gid');
        $this->addScript('formValidation.min.js');
        $this->addScript('jquery.bootstrap.wizard.min.js');
        $this->addScript('tinymce.min.js');
        $this->addCss('build.css');
        $this->addCss('formValidation.min.css');
        
        $data = array();
        $data['forms'] = array();
        if ($group == 3) {
        	$this->menuitem = 'jobseeker';
            $data['forms'] = $this->getJobseekerFields();
        } else {
        	$this->menuitem = 'employer';
            $data['forms'] = $this->getEmployerFields();
        }
        $data['forms']['action'] = site_url('jobs/user/save');
        
        $this->load->template('jobs/register', $data);
    }

    public function getJobseekerFields()
    {
        $this->load->helper('global');
        $this->load->model('front/jobs_model');
        
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
        
        $return['fieldsets']['basic'] = array(
            'label' => 'Basic',
            'active' => true,
            'fields' => array(
                array(
                    'name' => 'firstname',
                    'type' => 'text',
                    'placeholder' => $this->lang->line('firstname'),
                    'label' => $this->lang->line('firstname'),
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'lastname',
                    'type' => 'text',
                    'placeholder' => $this->lang->line('lastname'),
                    'label' => $this->lang->line('lastname'),
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'email',
                    'type' => 'text',
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
                    'name' => 'password',
                    'type' => 'password',
                    'placeholder' => $this->lang->line('password'),
                    'label' => $this->lang->line('password'),
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'confirm_password',
                    'type' => 'password',
                    'placeholder' => $this->lang->line('confirm_password'),
                    'label' => $this->lang->line('confirm_password'),
                    'identicalfield' => 'password',
                    'valid' => array(
                        'require',
                        'identical'
                    )
                ),
                array(
                    'name' => 'user_id',
                    'type' => 'hidden',
                    'value' => 0
                )
            )
        );
        
        $return['fieldsets']['personal'] = array(
            'label' => 'Personal',
            'active' => false,
            'fields' => array(
                array(
                    'name' => 'experience',
                    'type' => 'group',
                    'label' => $this->lang->line('experience'),
                    'addmore' => true,
                    'fields' => array(
                        array(
                            'name' => 'experience[0][title]',
                            'type' => 'text',
                            'class' => 'col-xs-4',
                            'placeholder' => $this->lang->line('job_title'),
                            'valid' => array(
                                'require'
                            )
                        ),
                        array(
                            'name' => 'experience[0][startdate]',
                            'type' => 'datepicker',
                            'class' => 'col-xs-4',
                            'placeholder' => $this->lang->line('start_date'),
                            'valid' => array(
                                'require'
                            )
                        ),
                        array(
                            'name' => 'experience[0][enddate]',
                            'type' => 'datepicker',
                            'class' => 'col-xs-4',
                            'placeholder' => $this->lang->line('end_date'),
                            'valid' => array(
                                'require'
                            )
                        )
                    )
                ),
                array(
                    'name' => 'job_category_id',
                    'type' => 'select',
                    'label' => $this->lang->line('category_text'),
                    'options' => $categories,
                    'valid' => array(
                        'require'
                    )
                ),
                /*array(
                    'name' => 'salary_type_id',
                    'type' => 'select',
                    'placeholder' => 'Salary Type',
                    'label' => $this->lang->line('salary_type_text'),
                    'options' => $salaries
                ),*/
                array(
                    'name' => 'career_type_id',
                    'type' => 'radio',
                    'label' => $this->lang->line('career_level_text'),
                    'options' => $careeres,
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'educations',
                    'type' => 'group',
                    'label' => $this->lang->line('education'),
                    'addmore' => true,
                    'fields' => array(
                        array(
                            'name' => 'education[0][level]',
                            'type' => 'select',
                            'options' => $educations,
                            'class' => 'col-xs-3'
                        ),
                        array(
                            'name' => 'education[0][institute_name]',
                            'type' => 'text',
                            'placeholder' => $this->lang->line('education_institute_name_placehoder_text'),
                            'class' => 'col-xs-3'
                        ),
                        array(
                            'name' => 'education[0][study]',
                            'type' => 'text',
                            'placeholder' => $this->lang->line('education_study_placehoder_text'),
                            'class' => 'col-xs-3'
                        ),
                        array(
                            'name' => 'education[0][year]',
                            'type' => 'text',
                            'placeholder' => $this->lang->line('education_year_placehoder_text'),
                            'class' => 'col-xs-3'
                        )
                    )
                ),
                array(
                    'name' => 'skill',
                    'type' => 'group',
                    'label' => $this->lang->line('skill_skill_placehoder_text'),
                    'addmore' => true,
                    'fields' => array(
                        array(
                            'name' => 'skill[0][skill]',
                            'type' => 'text',
                            'class' => 'col-xs-3',
                            'placeholder' => $this->lang->line('skill_skill_placehoder_text')
                        ),
                        array(
                            'name' => 'skill[0][experience]',
                            'type' => 'text',
                            'placeholder' => $this->lang->line('skill_experience_placehoder_text'),
                            'class' => 'col-xs-3'
                        ),
                        array(
                            'name' => 'skill[0][skilllevel]',
                            'type' => 'select',
                            'options' => $skills,
                            'placeholder' => $this->lang->line('skill_level_placehoder_text'),
                            'class' => 'col-xs-3'
                        )
                    )
                ),
                array(
                    'name' => 'resume',
                    'type' => 'editor',
                    'label' => $this->lang->line('resume'),
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'address',
                    'type' => 'text',
                    'label' => $this->lang->line('address'),
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'workphone',
                    'type' => 'text',
                    'placeholder' => $this->lang->line('workphone'),
                    'label' => $this->lang->line('workphone')
                ),
                array(
                    'name' => 'country',
                    'type' => 'select',
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
                    'class' => 'catchstates statechange',
                    'label' => $this->lang->line('state'),
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'city',
                    'type' => 'select',
                    'class' => 'catchcities',
                    'label' => $this->lang->line('city'),
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'zip',
                    'type' => 'text',
                    'placeholder' => $this->lang->line('workphone'),
                    'label' => $this->lang->line('zip'),
                    'valid' => array(
                        'require',
                        'numeric'
                    )
                ),
                /* array(
                    'name' => 'terms',
                    'type' => 'checkbox',
                    'showlabel' => false,
                    'label' => '',
                	'class'=> "termsclickable",
                    'options' => array(
                        $this->lang->line('terms') => '1'
                    ),
                    'valid' => array(
                        'require'
                    )
                ), */
                array(
                    'name' => 'terms',
                    'type' => 'custom',
                    'label' => '',
                	'code' => '<div class="col-xs-9" id="terms">                    
								<div class="checkbox checkbox-warning">
							        <input type="checkbox" class="" value="1" name="terms" id="terms1" data-fv-field="terms[]">
							        <label for="terms1">
							         <div class="form_label">By Creating an account, i agree to the <a href="#" data-toggle="modal" data-target="#termsmodal">Terms Of Use and Privacy policy</a></div>    
							        </label>
							    </div>
							</div>',
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'group_id',
                    'type' => 'hidden',
                    'value' => '3'
                )
            )
        );
        return $return;
    }

    public function getEmployerFields()
    {
        $this->load->helper('global');
        $countriesarray = getCounties();
        $countries = array();
        $countries['--Select country--'] = '';
        foreach ($countriesarray as $country) {
            $countries[$country['name']] = $country['id'];
        }
        
        $return['fieldsets']['basic'] = array(
            'label' => 'Basic',
            'active' => true,
            'fields' => array(
                array(
                    'name' => 'firstname',
                    'type' => 'text',
                    'placeholder' => 'Firstname',
                    'label' => $this->lang->line('firstname'),
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'lastname',
                    'type' => 'text',
                    'placeholder' => 'Lastname',
                    'label' => $this->lang->line('lastname'),
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'email',
                    'type' => 'text',
                    'placeholder' => 'Email',
                    'label' => $this->lang->line('email'),
                    'validationurl' => site_url('common/ajax/validuser'),
                    'valid' => array(
                        'require',
                        'email',
                        'remote'
                    )
                ),
                array(
                    'name' => 'password',
                    'placeholder' => 'Password',
                    'type' => 'password',
                    'label' => $this->lang->line('password'),
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'confirm_password',
                    'type' => 'password',
                    'placeholder' => 'Confirm Password',
                    'label' => $this->lang->line('confirm_password'),
                    'identicalfield' => 'password',
                    'valid' => array(
                        'require',
                        'identical'
                    )
                ),
                array(
                    'name' => 'user_id',
                    'type' => 'hidden',
                    'value' => 0
                )
            )
        );
        
        $return['fieldsets']['Personal'] = array(
            'label' => 'Personal',
            'active' => false,
            'fields' => array(
                array(
                    'name' => 'company',
                    'placeholder' => 'Company',
                    'type' => 'text',
                    'label' => $this->lang->line('company'),
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'logo',
                    'type' => 'file',
                    'label' => $this->lang->line('photo'),
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'address',
                    'placeholder' => 'Address',
                    'type' => 'textarea',
                    'label' => $this->lang->line('address'),
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'workphone',
                    'placeholder' => 'Workphone',
                    'type' => 'text',
                    'label' => $this->lang->line('workphone')
                ),
                array(
                    'name' => 'country',
                    'type' => 'select',
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
                    'class' => 'catchstates statechange',
                    'label' => $this->lang->line('state'),
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'city',
                    'type' => 'select',
                    'class' => 'catchcities',
                    'label' => $this->lang->line('city'),
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'zip',
                    'type' => 'text',
                    'placeholder' => 'Zip',
                    'label' => $this->lang->line('zip'),
                    'valid' => array(
                        'require',
                        'numeric'
                    )
                ),
                array(
                    'name' => 'phoneno',
                    'type' => 'text',
                    'placeholder' => 'Phone No',
                    'label' => $this->lang->line('business_phone')
                ),
                array(
                    'name' => 'website',
                    'type' => 'text',
                    'placeholder' => 'Website',
                    'label' => $this->lang->line('website'),
                    'valid' => array(
                        'require',
                        'website'
                    )
                ),
                array(
                    'name' => 'terms',
                    'type' => 'custom',
                    'label' => '',
                	'code' => '<div class="col-xs-9" id="terms">                    
								<div class="checkbox checkbox-warning">
							        <input type="checkbox" class="" value="1" name="terms" id="terms1" data-fv-field="terms[]">
							        <label for="terms1">
							         <div class="form_label">By Creating an account, i agree to the <a href="#" data-toggle="modal" data-target="#termsmodal">Terms Of Use and Privacy policy</a></div>    
							        </label>
							    </div>
							</div>',
                    'valid' => array(
                        'require'
                    )
                ),
                array(
                    'name' => 'group_id',
                    'type' => 'hidden',
                    'value' => '2'
                )
            )
        );
        return $return;
    }

    public function save()
    {
        $this->load->model('front/jobs_model');
        $requestdata = $this->input->post();
        
        // Upload logo for employer
        if ($requestdata['group_id'] == 2) 
        {
        	$image = uploadfile('logo');
        	$requestdata['logo'] = $image;
        }
        
        $return = $this->jobs_model->saveuser($requestdata);
        
        if (! $return) {
            $this->setFlash('User not saved!','danger');
            redirect('common/home');
        } else {
        	$this->setFlash('User saved!');
            redirect('common/home');
        }
    }
}