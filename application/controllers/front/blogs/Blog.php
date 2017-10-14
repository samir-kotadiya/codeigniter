<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends Front_Controller
{
	public function __construct()
	{
		$this->menuitem = 'blog';
		parent::__construct();
         $this->lang->load("blogs", $this->language);
	}

    public function view()
    {
        $this->load->helper('global');
        $id = (int) $this->input->get('id');
        $data['title'] = 'Blog';
        
        if ($id > 0) {
            $this->load->model('front/Blogs_model');
            $result = $this->Blogs_model->getBlog($id);
            $result['image'] = getResizeImage($result['image']);
            
            $data['blog'] = $result;
            $this->load->template('blogs/view', $data);
        } else {
            show_404();
        }
    }
}