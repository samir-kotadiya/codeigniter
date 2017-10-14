<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('error_reporting', E_ALL);

class Category extends Admin_Controller
{

    public function index()
    {
        $this->load->library('upload');
        $data = array();
        $this->load->model('admin/Blogs/category_model');
        $this->load->helper('filter');
        $this->page = 'category';
        sorting_init();
        
        $page = $this->input->get('page');
        
        $page = (isset($page)) ? $page : 1;
        $limit = 10;
        $start = ($page * $limit) - $limit;
        $users = $this->category_model->getcategory($start, $limit);
        $total = $this->category_model->getCategoryCount();
        
        $this->pagination(site_url('admin/blogs/Category'), $total, $limit);
        $data['blogs'] = $users;
        
        $this->load->template('blogs/category_list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->load->helper(array(
            'form',
            'url'
        ));
          $this->load->model('admin/Blogs/category_model');
        $this->addScript('bootstrap-switch.js');
        $data = array();
        
        $requestdata = $this->input->post('ciform');
        
        if (! empty($requestdata)) {
            
            // validate form input
            $this->form_validation->set_rules('ciform[title]', 'title', 'required');
            
            if ($this->form_validation->run() == TRUE) {
                
                $userid = $this->category_model->savecategory($requestdata);
                if ($userid) {
                    $this->setFlash('User saved!', 'success');
                    redirect(site_url('admin/blogs/category/edit/id/' . $userid));
                } else {
                    $this->setFlash('Error!', 'danger');
                    redirect(site_url('admin/blogs/category/edit/id/' . $userid));
                }
            }
        }
        
        $data['blogs'] = new stdClass();
        
        $data['blogs']->title = (isset($requestdata['title'])) ? $requestdata['title'] : '';
        $data['blogs']->description = (isset($requestdata['description'])) ? $requestdata['description'] : '';
        $data['blogs']->id = 0;
        $data['blogs']->published = (isset($requestdata['published'])) ? $requestdata['published'] : 0;
        $data['blogs']->created_by = (isset($requestdata['created_by'])) ? $this->session->userdata('created_by') : 1;
        
        $this->load->template('blogs/category_edit', $data);
    }

    public function edit()
    {
        $this->load->library('form_validation');
        $this->load->helper(array(
            'form',
            'url'
        ));
     $this->load->model('admin/Blogs/category_model');
        $this->addScript('bootstrap-switch.js');
        $data = array();
        
        $requestdata = $this->input->post('ciform');
        
        if (! empty($requestdata)) {
            // validate form input
            $this->form_validation->set_rules('ciform[title]', 'title', 'required');
            
            if ($this->form_validation->run() == TRUE) {
                
                $blogid = $this->category_model->savecategory($requestdata);
                if ($blogid) {
                    $this->setFlash('User saved!', 'success');
                    redirect(site_url('admin/blogs/category/edit/id/' . $blogid));
                } else {
                    $this->setFlash('Error!', 'danger');
                    redirect(site_url('admin/blogs/category/edit/id/' . $blogid));
                }
            }
        }
        
        $blogid = $this->input->get('id');
        $blogid = (isset($blogid)) ? $this->input->get('id') : 0;
        
        $data['blogs'] = $this->category_model->get_category($blogid);
        
        if (! empty($data['blogs'])) {
            
            $this->load->template('blogs/category_edit', $data);
        } else {
            show_404();
        }
    }

    public function publish()
    {
        $value['database'] = array(
            "value" => "ci_categories"
        );
        $this->session->set_userdata($value);
        $cids = $this->input->post('cid');
        
        if (! empty($cids)) {
            $this->load->model('admin/Blogs/category_model');
            $this->category_model->publish($cids);
            $this->setFlash('Blogs(s) are published!', 'success');
        }
        redirect(site_url('admin/blogs/category'));
    }

    public function unpublish()
    {
        $value['database'] = array(
            "value" => "ci_categories"
        );
        $this->session->set_userdata($value);
        $cids = $this->input->post('cid');
        
        if (! empty($cids)) {
            $this->load->model('admin/Blogs/category_model');
            $this->category_model->unpublish($cids);
            $this->setFlash('Blogs(s) are unpublished!', 'success');
        }
        redirect(site_url('admin/blogs/category'));
    }

    public function delete()
    {
        $value['database'] = array(
            "value" => "ci_categories"
        );
        $this->session->set_userdata($value);
        $cids = $this->input->post('cid');
        if (! empty($cids)) {
            $this->load->model('admin/Blogs/category_model');
            $this->category_model->delete($cids);
            $this->setFlash('Blogs(s) are deleted!', 'success');
        }
        redirect(site_url('admin/blogs/category'));
    }
}