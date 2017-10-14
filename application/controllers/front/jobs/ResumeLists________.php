<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ResumeLists extends Front_Controller
{

	public function __construct()
	{
		
		parent::__construct();
        $this->load->model('front/jobs_model');
        $this->load->helper('global');
	}
	
    public function index()
    {
        $data = array();
         $resumeid = $this->input->get('id');
         $data['jobs'] = $this->jobs_model->getResume($resumeid);

         $this->load->template('jobs/resumelists', $data);
    }
     public function listresume()
     {
         $data = array();
        
       
         $user = getUser();
         $resumeid = $this->input->get('id');
         $resumeid = (isset($resumeid)) ? $this->input->get('id') : 0; 
          $data['jobs'] = $this->jobs_model->getResume($resumeid);
              /*echo"<>";exit(print_r($data));*/
          $this->load->template('jobs/resumelists', $data);
     }  
    public function delete()
    {

        $cids = $this->input->post('cid');
        if (! empty($cids)) {
            
            $this->jobs_model->deleteresume($cids);
            $this->setFlash('User(s) are deleted!', 'success');
        }
            redirect(site_url('jobs/ResumeLists'));
    }
   
}