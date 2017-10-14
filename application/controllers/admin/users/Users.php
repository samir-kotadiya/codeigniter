<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = array();
        $this->load->model('admin/Users/users_model');
        $this->load->helper('filter');
         $this->page = 'users';
        
        sorting_init();
        
        $page = $this->input->get('page');
        $page = (isset($page)) ? $page : 1;
        $limit = 10;
        $start = ($page * $limit) - $limit;
        $users = $this->users_model->getUsers($start, $limit);
        $total = $this->users_model->getCount();
        
        $this->pagination(site_url('admin/users/users'), $total, $limit);
        $data['users'] = $users;
        $this->load->template('users/user_list', $data);
    }

    public function add()
    {
        $this->load->model('admin/Users/users_model');
        $this->addScript('bootstrap-switch.js');
        $data = array();
        
        $requestdata = $this->input->post('ciform');

        if (! empty($requestdata)) {
       
            // validate form input
            $this->form_validation->set_rules('ciform[username]', 'username', 'required');
            $this->form_validation->set_rules('ciform[email]', 'email', 'required|valid_email');
            $this->form_validation->set_rules('ciform[password]', 'password', 'required');
            
            if ($this->form_validation->run() == TRUE) {
                $userid = $this->users_model->save($requestdata);
                if ($userid) {
                    $this->setFlash('User saved!', 'success');
                    redirect(site_url('admin/users/users/edit/id/' . $userid));
                } else {
                    $this->setFlash('Error!', 'danger');
                    redirect(site_url('admin/users/users/edit/id/' . $userid));
                }
            }
        }        
        $data['user'] = new stdClass();
        $data['user']->username = (isset($requestdata['username'])) ? $requestdata['username'] : '';
        $data['user']->email = (isset($requestdata['email'])) ? $requestdata['email'] : '';
        $data['user']->password = '';
        $data['user']->published = (isset($requestdata['published'])) ? $requestdata['published'] : 0;
        $data['user']->id = 0;
        $data['user']->group_id = (isset($requestdata['group_id'])) ? $requestdata['group_id'] : 0;    
        $data['groups'] = $this->users_model->getGroups();
        $this->load->template('users/user_edit', $data);
    }

    public function edit()
    {
        $this->load->model('admin/Users/users_model');
        $this->addScript('bootstrap-switch.js');
        $data = array();        
        $requestdata = $this->input->post('ciform');
        if (! empty($requestdata)) {
            // validate form input
            $this->form_validation->set_rules('ciform[username]', 'username', 'required');
            $this->form_validation->set_rules('ciform[email]', 'email', 'required|valid_email');            
            if ($this->form_validation->run() == TRUE) {
                $userid = $this->users_model->save($requestdata);
                if ($userid) {
                    $this->setFlash('User saved!', 'success');
                    redirect(site_url('admin/users/users/edit/id/' . $userid));
                } else {
                    $this->setFlash('Error!', 'danger');
                    redirect(site_url('admin/users/users/edit/id/' . $userid));
                }
            }
        }        
        $userid = $this->input->get('id');
        $userid = (isset($userid)) ? $this->input->get('id') : 0;
        $data['user'] = $this->users_model->getUser($userid);
        $data['groups'] = $this->users_model->getGroups();        
        if (! empty($data['user'])) {
            $this->load->template('users/user_edit', $data);
        } else {
            show_404();
        }
    }

    public function publish()
    {
        $cids = $this->input->post('cid');
        if (! empty($cids)) {
            $this->load->model('admin/Users/users_model');
            $this->users_model->publish($cids);
            $this->setFlash('User(s) are published!', 'success');
        }
        redirect(site_url('admin/users/users'));
    }

    public function unpublish()
    {
        $cids = $this->input->post('cid');
        if (! empty($cids)) {
            $this->load->model('admin/Users/users_model');
            $this->users_model->unpublish($cids);
            $this->setFlash('User(s) are unpublished!', 'success');
        }
        redirect(site_url('admin/users/users'));
    }

    public function delete()
    {
        $cids = $this->input->post('cid');
        if (! empty($cids)) {
            $this->load->model('admin/Users/users_model');
            $this->users_model->delete($cids);
            $this->setFlash('User(s) are deleted!', 'success');
        }
        redirect(site_url('admin/users/users'));
    }
}
