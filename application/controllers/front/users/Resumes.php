<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Resumes extends Front_Controller
{

    public function __construct()
    {
    	$this->menuitem = 'resume';
        parent::__construct();
        $this->lang->load("common", $this->language);
    }

    public function index()
    {
        $this->checklogin();
    	$data = array();
    	$data['title'] = $this->lang->line('resumes_title');
    	$this->load->model('front/resumes_model');
    	
    	$filters = array();
    	$resumes = $this->resumes_model->getResumes($filters);
    	
    	// Format address
    	$locationsearch = array(
    			'{address}',
    			'{city}',
    			'{state}',
    			'{zipcode}',
    			'{country}'
    	);
    	
    	$locationformat = "{address} <br> {city} {state}-{zipcode},{country}";
    	foreach ($resumes as $key=>$resume){
    		$locationreplace = array(
    			$resume['address'],
    			$resume['city_name'],
    			$resume['state_name'],
    			$resume['zip'],
    			$resume['country_name']
    		);
    		$resumes[$key]['location'] = str_replace($locationsearch, $locationreplace, $locationformat);
    	}
    	
    	$data['resumes'] = $resumes;
    	
    	$this->load->template('users/resumes', $data);
    }
    
    public function saved()
    {
    	$this->checklogin();
    	$data = array();
    	$data['title'] = 'Resumes';
    	$this->load->model('front/resumes_model');
    	 
    	$filters = array();
    	$resumes = $this->resumes_model->getMyResumes($filters);
    	
    	// Format address
    	$locationsearch = array(
    			'{address}',
    			'{city}',
    			'{state}',
    			'{zipcode}',
    			'{country}'
    	);
    	 
    	$locationformat = "{address} <br> {city} {state}-{zipcode},{country}";
    	foreach ($resumes as $key=>$resume){
    		$locationreplace = array(
    				$resume['address'],
    				$resume['city_name'],
    				$resume['state_name'],
    				$resume['zip'],
    				$resume['country_name']
    		);
    		$resumes[$key]['location'] = str_replace($locationsearch, $locationreplace, $locationformat);
    	}
    	 
    	$data['resumes'] = $resumes;
    	 
    	$this->load->template('users/myresumes', $data);
    }
}