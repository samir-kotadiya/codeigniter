<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lists extends Front_Controller
{
	public function __construct()
	{
		$this->menuitem = 'blog';
		parent::__construct();
         $this->lang->load("blogs", $this->language);
	}
	
    public function index()
    {
        $data['title'] = 'Blogs';
        $this->load->helper('global');
        $this->load->model('front/Blogs_model');
        $result = $this->Blogs_model->getBlogs();
      
        foreach ($result as $key => $value) {
            $result[$key]['image'] = getResizeImage($value['image']);
        }
        
        $data['blogs'] = $result;
        //language variable for blog
        $data['lbl_readmore'] =  $this->lang->line('readmore');
        $data['lbl_writtenby'] =  $this->lang->line('writtenby');
        $this->load->template('blogs/lists', $data);
    }
}