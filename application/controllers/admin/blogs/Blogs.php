<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('error_reporting', E_ALL);

class Blogs extends Admin_Controller
{

    public function index()
    {
        $this->page = 'blogs';
        $this->load->library('upload');
        $data = array();
        $this->load->model('admin/Blogs/blogs_model');
        $this->load->helper('filter');
        sorting_init();
        $page = $this->input->get('page');
        $page = (isset($page)) ? $page : 1;
        $limit = 10;
        $start = ($page * $limit) - $limit;
        $users = $this->blogs_model->getBlogs($start, $limit);
        $total = $this->blogs_model->getCount();
        $this->pagination(site_url('admin/blogs/blogs'), $total, $limit);
        $data['blogs'] = $users;
        $this->load->template('blogs/blogs_list', $data);
    }

    public function add()
    {

        $this->load->helper('global');
        $this->load->library('form_validation');
        $this->load->helper(array(
            'form',
            'url'
        ));
        $this->load->model('admin/Blogs/blogs_model');
        $this->addScript('bootstrap-switch.js');
        $data = array();
        $requestdata = $this->input->post('ciform');
        if (! empty($requestdata)) {
            // validate form input
            $this->form_validation->set_rules('ciform[name]', 'name', 'required');
            if ($this->form_validation->run() == TRUE) {
                $config['upload_path'] = APPPATH . "images/blog/";
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '100055';
                $config['max_width'] = '10245';
                $config['max_height'] = '70685';
                $this->load->library('upload', $config);
                $this->upload->do_upload('image');
                $image = "images/blog" . "/" . $_FILES['image']['name'];
                $requestdata['image'] = $image;
                $userid = $this->blogs_model->save($requestdata);
                if ($userid) {
                    $this->setFlash('User saved!', 'success');
                    redirect(site_url('admin/blogs/blogs/edit/id/' . $userid));
                } else {
                    $this->setFlash('Error!', 'danger');
                    redirect(site_url('admin/blogs/blogs/edit/id/' . $userid));
                }
            }
        }
        $data['blogs'] = new stdClass();
        $data['category'] = $this->blogs_model->getCategory();
        $data['blogs']->name = (isset($requestdata['name'])) ? $requestdata['name'] : '';
        $data['blogs']->description = (isset($requestdata['description'])) ? $requestdata['description'] : '';
        $data['blogs']->id = 0;
        $data['blogs']->published = (isset($requestdata['published'])) ? $requestdata['published'] : 0;
        $data['blogs']->created_by = (isset($requestdata['created_by'])) ? $this->session->userdata('created_by') : 1;
        $data['blogs']->category_id = (isset($requestdata['category_id'])) ? $requestdata['category_id'] : 0;
        $this->load->template('blogs/blogs_edit', $data);
    }

    public function edit()
    {
        $this->addScript('tinymce.min.js');
        $this->load->helper('global');
        $this->load->library('form_validation');
        $this->load->helper(array(
            'form',
            'url'
        ));
        $this->load->model('admin/Blogs/blogs_model');
        $this->addScript('bootstrap-switch.js');
        $data = array();
        $requestdata = $this->input->post('ciform');
        if (! empty($requestdata)) {
            // validate form input
            $this->form_validation->set_rules('ciform[name]', 'name', 'required');
            if ($this->form_validation->run() == TRUE) {
                $config['upload_path'] = APPPATH . "images/blog/";
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '100055';
                $config['overwrite'] = true;
                $config['max_width'] = '10245';
                $config['max_height'] = '70685';
                $this->load->library('upload', $config);
                $this->upload->do_upload('image');
                $image = "images/blog" . "/" . $_FILES['image']['name'];
                $requestdata['image'] = $image;
                $blogid = $this->blogs_model->save($requestdata);
                if ($blogid) {
                    $this->setFlash('User saved!', 'success');
                    redirect(site_url('admin/blogs/blogs/edit/id/' . $blogid));
                } else {
                    $this->setFlash('Error!', 'danger');
                    redirect(site_url('admin/blogs/blogs/edit/id/' . $blogid));
                }
            }
        }
        $blogid = $this->input->get('id');
        $blogid = (isset($blogid)) ? $this->input->get('id') : 0;
        $data['blogs'] = $this->blogs_model->getBlog($blogid);
        $data['category'] = $this->blogs_model->getCategory();
        if (! empty($data['blogs'])) {
            
            $this->load->template('blogs/blogs_edit', $data);
        } else {
            show_404();
        }
    }

    public function publish()
    {
       
        $cids = $this->input->post('cid');
        if (! empty($cids)) {
        $this->load->model('admin/Blogs/blogs_model');
            
            $this->blogs_model->publish($cids);
            $this->setFlash('Blogs(s) are published!', 'success');
        }
        redirect(site_url('admin/blogs/blogs'));
    }

    public function unpublish()
    {
 
        $cids = $this->input->post('cid');
        if (! empty($cids)) {
            $this->load->model('admin/Blogs/blogs_model');
            $this->blogs_model->unpublish($cids);
            $this->setFlash('Blogs(s) are unpublished!', 'success');
        }
        redirect(site_url('admin/blogs/blogs'));
    }

    public function delete()
    {
     
        $cids = $this->input->post('cid');
        if (! empty($cids)) {
        $this->load->model('admin/Blogs/blogs_model');
            $this->blogs_model->delete($cids);
            $this->setFlash('Blogs(s) are deleted!', 'success');
        }
        redirect(site_url('admin/blogs/blogs'));
    }
}