<?php

class Admin_Controller extends MY_Controller
{
    public $language = 'english';
    
    function __construct()
    {
        parent::__construct();
        
        if(!$this->session->userdata('islogin')){
            if($this->uri->uri_string != 'admin/common/user' && $this->uri->uri_string != 'admin/common/user/process'){
                redirect('admin/common/user');
            }
        }else{
            if($this->uri->uri_string == 'admin/common/user'){
                redirect('admin/common/dashboard');
            }
        }
    }
    
    function setFlash($message,$type = 'success'){
        $newmessage = array('message'=>$message,'type'=>$type);
        $flashes = $this->session->flashdata('flash_messages');
        $flashes[] = $newmessage;
        
        $this->session->set_flashdata('flash_messages', $flashes);
    }
    
    function pagination($url='',$total=0,$limit=20){

        $this->load->library('pagination');
        $config['base_url'] = $url;
        $config['total_rows'] = $total;
        
        $config['per_page'] = $limit;
        $config['num_links'] = 3;
        $config['page_query_string'] = TRUE;
        $config['use_page_numbers'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul><!--pagination-->';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        
        $this->pagination->initialize($config);
    }
}