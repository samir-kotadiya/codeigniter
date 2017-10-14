<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Companies extends Front_Controller
{
    public function __construct()
    {
    	parent::__construct();
        $this->lang->load("common", $this->language);
    }

    public function index()
    {
        $data = array();
    	$data['title'] = $this->lang->line('companies_title');
    	$this->load->model('front/company_model');
    	
    	$filters = array();
    	$companies = $this->company_model->getCompanies($filters);
    	
    	// Format address
    	$locationsearch = array(
    			'{address}',
    			'{city}',
    			'{state}',
    			'{zipcode}',
    			'{country}'
    	);
    	
    	$locationformat = "{address} <br> {city} {state}-{zipcode},{country}";
    	foreach ($companies as $key=>$company){
    		$locationreplace = array(
    			$company['address'],
    			$company['city_name'],
    			$company['state_name'],
    			$company['zip'],
    			$company['country_name']
    		);
    		$companies[$key]['location'] = str_replace($locationsearch, $locationreplace, $locationformat);
    	}
    	
    	$data['companies'] = $companies;
    	
    	$this->load->template('users/companies', $data);
    }
}