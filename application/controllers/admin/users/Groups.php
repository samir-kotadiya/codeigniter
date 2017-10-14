<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Groups extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = array();
        $this->load->model('admin/Users/groups_model');
        
        $page = $this->input->get('page');
        $page = (isset($page)) ? $page : 1;
        $limit = 10;
        $start = ($page * $limit) - $limit;
        $groups = $this->groups_model->getGroups($start, $limit);
        $total = $this->groups_model->getCount();
        
        $this->pagination(site_url('admin/users/groups'), $total, $limit);
        $data['groups'] = $groups;
        $this->load->template('users/group_list', $data);
    }

    public function add()
    {
        $this->load->model('admin/Users/groups_model');
        $this->addScript('bootstrap-switch.js');
        $data = array();
        
        $requestdata = $this->input->post('ciform');
        if (! empty($requestdata)) {
            // validate form input
            $this->form_validation->set_rules('ciform[name]', 'name', 'required');
            
            if ($this->form_validation->run() == TRUE) {
                $gid = $this->groups_model->save($requestdata);
                if ($gid) {
                    $this->setFlash('Group saved!', 'success');
                    redirect(site_url('admin/users/groups/edit/id/' . $gid));
                } else {
                    $this->setFlash('Error!', 'danger');
                    redirect(site_url('admin/users/groups/edit/id/' . $gid));
                }
            }
        }
        
        $data['group'] = new stdClass();
        $data['group']->name = (isset($requestdata['name'])) ? $requestdata['name'] : '';
        $data['group']->id = 0;
        
        $this->load->template('users/group_edit', $data);
    }

    public function edit()
    {
        $this->load->model('admin/Users/groups_model');
        $this->addScript('bootstrap-switch.js');
        $data = array();
        
        $requestdata = $this->input->post('ciform');
        if (! empty($requestdata)) {
            // validate form input
            $this->form_validation->set_rules('ciform[name]', 'name', 'required');
            
            if ($this->form_validation->run() == TRUE) {
                $gid = $this->groups_model->save($requestdata);
                if ($gid) {
                    $this->setFlash('Group saved!', 'success');
                    redirect(site_url('admin/users/groups/edit/id/' . $gid));
                } else {
                    $this->setFlash('Error!', 'danger');
                    redirect(site_url('admin/users/groups/edit/id/' . $gid));
                }
            }
        }
        
        $gid = $this->input->get('id');
        $gid = (isset($gid)) ? $this->input->get('id') : 0;
        $data['group'] = $this->groups_model->getGroup($gid);
        if (! empty($data['group'])) {
            $this->load->template('users/group_edit', $data);
        } else {
            show_404();
        }
    }
    
    public function delete()
    {
        $cids = $this->input->post('cid');
        if (! empty($cids)) {
            $this->load->model('admin/Users/groups_model');
            $this->groups_model->delete($cids);
            $this->setFlash('Group(s) are deleted!', 'success');
        }
        redirect(site_url('admin/users/groups'));
    }
}
