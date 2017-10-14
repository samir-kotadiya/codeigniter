<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Testimonials_model extends MY_Model
{

    public function getTestimonials($data = array())
    {
    	
    	$querymore = '';
    	if(isset($data['limit'])){
    		$querymore .= " LIMIT {$data['limit']}";
    	}
    	
        $return = array();
        $sql = "SELECT t.*,u.group_id FROM ci_testimonials as t
        		LEFT JOIN ci_users as u ON u.id=t.user_id
                WHERE t.published=1
                ORDER BY created
        		$querymore";
        
        $query = $this->db->query($sql);
        
        if ($query->num_rows() > 0) {
            $return = $query->result_array();
        }
        return $return;
    }
    
    public function getTestimonialUser($id=0,$groupid=2){
    	if($groupid == 2){
    		$usertable = 'ci_employers';
    	}else{
    		$usertable = 'ci_jobseekers';
    	}
    	
    	$return = array();
    	$sql = "SELECT u.* FROM $usertable as u WHERE u.user_id=$id";
    	$query = $this->db->query($sql);
    	
    	if ($query->num_rows() > 0) {
    		$return = $query->row_array();
    	}
    	return $return;
    }
    
    public function save($data){
    	$usersession = $this->session->userdata('user');
    	$data['user_id'] = $usersession['userid'];
    	$data['published'] = 0;
    	$data['created'] = date("Y-m-d H:i:s");
    	if (! $this->db->insert('ci_testimonials', $data)) {
			return false;
		} else {
 			return true;
		}
    	return $return;
    }
}