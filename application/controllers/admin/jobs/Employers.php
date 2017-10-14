<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employers extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        $this->addScript('tinymce.min.js');
        $this->load->helper('global');
        $this->load->model('admin/Jobs/employers_model');
    }

    public function index()
    {
        $this->page = 'employers';
        $data = array();
        $this->load->helper('filter');
        sorting_init();
        
        $page = $this->input->get('page');
        $page = (isset($page)) ? $page : 1;
        $limit = 10;
        $start = ($page * $limit) - $limit;
        $employers = $this->employers_model->getEmployers($start, $limit);
        $total = $this->employers_model->getCount();
        
        $this->pagination(site_url('admin/jobs/employers'), $total, $limit);
        $data['employers'] = $employers;
        
        $data['form_list']['actions'] = array(
            'add' => array(
                'href' => site_url('admin/jobs/employers/add')
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
        foreach ($employers as $employer) {
            $fieldvalues[] = array(
                array(
                    
                    'value' => $employer['user_id'],
                    'type' => 'checkall'
                ),                
                array(
                    'value' => $employer['firstname'],
                    'href' => 'employers/edit/id/',
                    'type' => 'anchore',
                    'id' => $employer['user_id']
                ),
                array(
                    'value' => $employer['lastname'],
                    'href' => '',
                    'type' => ''
                ),
                array(
                    'value' => $employer['email'],
                    'href' => '',
                    'type' => ''
                ),
                array(
                    'value' => 'Status',
                    'publish' => $employer['published'],
                    'type' => 'publishtoggel'
                ),
                array(
                    'value' => $employer['user_id'],
                    'href' => '',
                    'type' => 'label'
                )
            );
        }
        
        $data['form_list']['lists']['values'] = $fieldvalues;
        $data['form_list']['action'] = 'admin/jobs/employers';
        $data['form_list']['pagination'] = array();
        
        $this->load->template('jobs/employers_list', $data);
    }

    public function add()
    {
        $this->addScript('bootstrap-switch.js');
        $data = array();
        
        $requestdata = $this->input->post('ciform');
        
        if (! empty($requestdata)) {
            /*$config['upload_path'] = APPPATH . "images/";
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '100055';
            $config['max_width'] = '10245';
            $config['max_height'] = '70685';
            $this->load->library('upload', $config);
            $this->upload->do_upload('logo');
            $image = "images" . "/" . $_FILES['logo']['name'];*/

            $requestdata['logo'] =  uploadfile('logo');
         
            $userid = $this->employers_model->save($requestdata);
            if ($userid) {
                
                $this->setFlash('User saved!', 'success');
                redirect(site_url('admin/jobs/employers/edit/id/' . $userid));
            } else {
                
                $this->setFlash('Error!', 'danger');
                redirect(site_url('admin/jobs/employers/edit/id/' . $userid));
            }
        }
        
        $data['employer'] = new stdClass();
        $data['user'] = new stdClass();
        $data['user']->username = (isset($requestdata['username'])) ? $requestdata['username'] : '';
        $data['user']->email = (isset($requestdata['email'])) ? $requestdata['email'] : '';
        $data['user']->password = '';
        $data['user']->published = (isset($requestdata['published'])) ? $requestdata['published'] : 0;
        $data['user']->group_id = (isset($requestdata['group_id'])) ? $requestdata['group_id'] : 0;
        $data['groups'] = $this->employers_model->getGroups();
        $data['employer']->firstname = (isset($requestdata['firstname'])) ? $requestdata['firstname'] : '';
        $data['employer']->lastname = (isset($requestdata['lastname'])) ? $requestdata['lastname'] : '';
        $data['employer']->address = (isset($requestdata['address'])) ? $requestdata['address'] : '';
        $data['employer']->company = (isset($requestdata['company'])) ? $requestdata['company'] : '';
        $data['employer']->workphone = (isset($requestdata['workphone'])) ? $requestdata['workphone'] : '';
        $data['employer']->logo = (isset($requestdata['logo'])) ? $requestdata['logo'] : '';
        $data['employer']->city = (isset($requestdata['city'])) ? $requestdata['city'] : 0;
        $data['employer']->state = (isset($requestdata['state'])) ? $requestdata['state'] : 0;
        $data['employer']->country = (isset($requestdata['country'])) ? $requestdata['country'] : 0;
        $data['employer']->zip = (isset($requestdata['zip'])) ? $requestdata['zip'] : "";
        $data['employer']->phoneno = (isset($requestdata['phoneno'])) ? $requestdata['phoneno'] : "";
        $data['employer']->user_id = 0;
        $data['employer']->website = (isset($requestdata['website'])) ? $requestdata['website'] : '';

        $countryarray = getCounties();
        $country = array();
        $country['--Select Types--'] = '';
        
        foreach ($countryarray as $value) {
            
            $country[$value['name']] = $value['id'];
        }
        $data['country'] = $country;
        $this->load->template('jobs/employer_edit', $data);
    }

    public function edit()
    {
        $this->addScript('bootstrap-switch.js');
        $data = array();
        
        $requestdata = $this->input->post('ciform');
        if (! empty($requestdata)) {
            // validate form input
            $config['upload_path'] = APPPATH . "images/";
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '100055';
            $config['max_width'] = '10245';
            $config['max_height'] = '70685';
            $this->load->library('upload', $config);
            $this->upload->do_upload('logo');
            $image = "images" . "/" . $_FILES['logo']['name'];
            $requestdata['logo'] = $image;
            
            $userid = $this->employers_model->save($requestdata);
            if ($userid) {
                $this->setFlash('User saved!', 'success');
                redirect(site_url('admin/jobs/employers/edit/id/' . $userid));
            } else {
                $this->setFlash('Error!', 'danger');
                redirect(site_url('admin/jobs/employers/edit/id/' . $userid));
            }
        }
        
        $userid = $this->input->get('id');
        $userid = (isset($userid)) ? $this->input->get('id') : 0;
        $data['employer'] = $this->employers_model->getEmployer($userid);
        $data['user'] = $this->employers_model->getUser($userid);
        $data['groups'] = $this->employers_model->getGroups();
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
        if (! empty($data['employer'])) {
            $this->load->template('jobs/employer_edit', $data);
        } else {
            show_404();
        }
    }

    public function publish()
    {
        $cids = $this->input->post('cid');
      
        if (! empty($cids)) {
            
            $this->employers_model->publish($cids);
            $this->setFlash('User(s) are published!', 'success');
        }
        redirect(site_url('admin/jobs/employers'));
    }

    public function unpublish()
    {
   
        $cids = $this->input->post('cid');
        if (! empty($cids)) {
            
            $this->employers_model->unpublish($cids);
            $this->setFlash('User(s) are unpublished!', 'success');
        }
        redirect(site_url('admin/jobs/employers'));
    }

    public function delete()
    {
        $cids = $this->input->post('cid');
        if (! empty($cids)) {
            
            $this->employers_model->delete($cids);
            $this->setFlash('User(s) are deleted!', 'success');
        }
        redirect(site_url('admin/jobs/employers'));
    }
}
