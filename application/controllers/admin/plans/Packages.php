<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Packages extends Admin_Controller
{

    /*
    *
    *
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
           $this->load->model('admin/Plans/packages_model');
    }

    /*
    *   Function is use to load all packages 
    *   
    */
    public function index()
    {
        
        $data = array();
        //Get a package model
     
        //Get a helper for pagination
        $this->load->helper('filter');
        //set a page name for sorting
        $this->page = 'packages';        
        sorting_init();
        
        $page = $this->input->get('page');
        $page = (isset($page)) ? $page : 1;
        $limit = 10;
        $start = ($page * $limit) - $limit;

        //Get all the packages record from data base
        $packages = $this->packages_model->getPackages($start, $limit);
        //Count total number of record in data base
        $total = $this->packages_model->getCount();
        
        //Get all Plans from data base
        $features = $this->packages_model->getPlanFeatures();


        $this->pagination(site_url('admin/plans/packages'), $total, $limit);
        
        $data['packages'] = $packages;
        $data['plan_features'] = $features;
        //pass data on view 
        
       
        $this->load->template('plans/packages_list', $data);
    }

    /*
    *   Function is use perform add and edit functionality of packages
    *   package id is pass as argument for edit or it will be a 0 by default
    */
    public function edit($id=0)
    {   

        //Get a package model
      
        //load language file for  Package 
        $this->lang->load("packages_lang", $this->language);

        //check request is post or not
        if ($this->input->post()) {


            //define form validation rules
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('price', 'price', 'required');
            $this->form_validation->set_rules('duration', 'duration', 'required');            

            //check form validation
            if ($this->form_validation->run() == TRUE) {

                //get post data
                $post = $this->input->post();            

                //Save package pass post data as argument                              
                $packageId = $this->packages_model->save($post);            
                if ($packageId) {
                    //if package is saved successfuly saved
                    $this->setFlash($this->lang->line('package_success'), 'success');
                    redirect(site_url('admin/plans/packages/edit/' . $packageId));
                } else {
                    //package is not saved successfuly
                    $this->setFlash($this->lang->linr('package_error'), 'danger');
                    redirect(site_url('admin/plans/packages/edit/' . $packageId));
                }

            }else{
                exit('false');
            }        
        }

        //create blank package array
        $package = array();

        if($id > 0)

            $package = $this->packages_model->getPackageById($id); //Get value of package for edit functionality

        //Load a CSS files
        $this->addCss('datepicker.css');
        $this->addCss('build.css');
        $this->addCss('formValidation.min.css');

        //load a jas files
        $this->addScript('moment.min.js');
        $this->addScript('bootstrap-datetimepicker.min.js');
        $this->addScript('formValidation.min.js');
        $this->addScript('jquery.bootstrap.wizard.min.js');
        $this->addScript('tinymce.min.js');

        //create blank array        
        $data = array();
        //get all plan features 
        $features = $this->packages_model->getPlanFeatures();

        //function is call to create view's form
        $data['forms'] = $this->getPackageField($package,$features,$id);
        //set form's action
        $data['forms']['action'] = site_url('admin/plans/packages/edit/'.$id);        
        //load templete
        $data['forms']['cancel_url'] = site_url('admin/plans/packages');
        
        $this->load->template('plans/package_edit', $data);
       
    }

    /*
    *   Function is use to pass argument to generate form        
    *   Package deatil and liast of features are pass as argument
    */
    public function getPackageField($package = array(),$features = array(),$id)
    {    
        

        //load comman global helper
        $this->load->helper('global');
        

        $fields = array(
                array(
                    'name' => 'name',
                    'type' => 'text',
                    'label' => $this->lang->line('package_name'),                    
                    'valid' => array(
                        'require'
                    ),
                    'value' => isset($package['name'])?$package['name']:'',
                ),
                array(
                    'name' => 'price',
                    'type' => 'text',
                    'label' => $this->lang->line('package_price'),
                    'valid' => array(
                        'require'
                    ),
                    'value' => isset($package['price'])?$package['price']:'',
                ),
                array(
                    'name' => 'published',
                    'type' => 'radio',
                    'options' => array('publised'=>1,'unpublished'=>0),
                    'label' => $this->lang->line('package_published'),
                    'valid' => array(
                        'require',                        
                    ),
                    'value' => isset($package['published'])?$package['published']:'1',
                ),
                array(
                    'name' => 'description',
                    'type' => 'textarea',
                    'label' => 'Description',
                    'value' => isset($package['description'])?$package['description']:'',
                    'valid' => array(
                        'require'
                    )                    
                ),
                array(
                    'name' => 'duration',
                    'type' => 'text',
                    'label' => $this->lang->line('package_duration'),
                    'value' => isset($package['duration'])?$package['duration']:'',
                    'valid' => array(
                        'require'
                    )                    
                ),
                array(
                    'name' => 'duration_type',
                    'type' => 'select',
                    'options' => array('Day'=>1,'Month'=>2,'Year'=>3,'Life Time'=>4),
                    'label' => $this->lang->line('package_duration_type'),    
                    'value' => isset($package['duration_type'])?$package['duration_type']:'',                
                    'valid' => array(
                        'require',                        
                    )
                ),                
                array(
                    'name' => 'id',
                    'type' => 'hidden',
                    'value' => isset($package['id'])?$package['id']:'0',
                ),
                array(
                    'name' => 'type',
                    'type' => 'hidden',
                    'value' => 1
                )
            );
                

        /* generate array to create featured box on view start*/
        $fields[] = array(
                    'name' => 'Featurs Group',
                    'type' => 'custom',
                    'html' => '<div class="group_block" style="border:1px solid balck;"><b>Featurs</b><div class="group_content">'
                );

        foreach ($features as $key => $value) {
               
            $ctmarray = array($package);
            $ctmarray['value'] = '';
            if($id > 0)
            {
            foreach ($package['features'] as $pfkey => $pfvalue) {                                
                if($pfvalue['featureId'] == $value['id']){
                    $ctmarray['value'] = $pfvalue['value'];
                }
            }
            }
            $ctmarray['name'] = 'features_'.$value['id'];
            $ctmarray['type'] = 'text';
            $ctmarray['label'] = $value['name'];            
            $ctmarray['valid'] = array('require');
            $fields[] = $ctmarray;
        }        
        $fields[] = array(
                    'name' => 'email',
                    'type' => 'custom',
                    'html' => '</div></div>'
                );
        /* generate array to create featured box on view end*/

        //Pass a form parameter to generate form        
        $return['fieldsets']['edit_packages'] = array(
            'label' => 'Edit Packages',
            'active' => true,            
            'fields' => $fields
        );

       // exit;
        //return form parameters       
        return $return;
    }

    /*
    *   Function is use to make package publish
    *   
    */
    public function publish()
    {
        
        $cids = $this->input->post('cid');
        if (! empty($cids)) {
            $this->load->model('admin/Plans/packages_model');
            $this->packages_model->publish($cids);
            $this->setFlash('Package(s) are published!', 'success');
        }
        redirect(site_url('admin/plans/packages'));
    }

    /*
    *   Function is use to make package unpublish
    *   
    */
    public function unpublish()
    {                
        $cids = $this->input->post('cid');
        if (! empty($cids)) {
            $this->load->model('admin/Plans/packages_model');
            $this->packages_model->unpublish($cids);
            $this->setFlash('Package(s) are unpublished!', 'success');
        }
        redirect(site_url('admin/plans/packages'));
    }

    /*
    *   Function is use to make package delete
    *   
    */
    public function delete()
    {
        $cids = $this->input->post('cid');
        if (! empty($cids)) {
            $this->load->model('admin/Plans/packages_model');
            $this->packages_model->delete($cids);
            $this->setFlash('Package(s) are deleted!', 'success');
        }
        redirect(site_url('admin/plans/packages'));
    }
}
