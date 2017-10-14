<?php

class Front_Controller extends MY_Controller
{
    public $language = 'english';
    public $menuitem = 'home';
    
    function __construct()
    {
        parent::__construct();
        
        $this->load->helper('global');
        
        if ($this->config->item('site_open') === FALSE) {
            show_error('Sorry the site is shut for now.');
        }
    }
    
    function setFlash($message,$type = 'success'){
    	$newmessage = array('message'=>$message,'type'=>$type);
    	$flashes = $this->session->flashdata('flash_messages');
    	$flashes[] = $newmessage;
    
    	$this->session->set_flashdata('flash_messages', $flashes);
    }
    
    function checklogin(){
    	$user = getUser();
    	if($user->id == 0){
    		$this->setFlash('Please login first!','danger');
    		redirect('common/login');
    	}
    }
}