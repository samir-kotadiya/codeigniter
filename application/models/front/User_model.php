<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class User_model extends MY_Model {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function getEmployerProfile($id)
	{
		$sql = "SELECT je.*,u.*   
			 		FROM ci_employers as je
                    LEFT JOIN ci_users as u ON je.user_id=u.id
				WHERE je.user_id = $id";
		$query = $this->db->query($sql);
		
		$results = $query->row_array();

		return $results;
	}
	
	public function getJobseekerProfile($id)
	{
		$sql = "SELECT je.*,u.*
			FROM ci_jobseekers as je
			LEFT JOIN ci_users as u ON je.user_id=u.id
			WHERE je.user_id = $id";
		$query = $this->db->query($sql);
		
		$results = $query->row_array();
		return $results;
	}
	
	public function getJobseekerEducation($userid)
	{
		$sql = "SELECT *
			FROM ci_jobseekers_education as je
			WHERE je.jobseeker_id = $userid";
		$query = $this->db->query($sql);
		
		$results = $query->result_array();
		return $results;
	}
	
	public function getJobseekerExperience($userid)
	{
		$sql = "SELECT *
			FROM ci_jobseekers_experience as je
			WHERE je.jobseeker_id = $userid";
		$query = $this->db->query($sql);
		
		$results = $query->result_array();
		return $results;
	}
	
	public function getJobseekerSkills($userid)
	{
		$sql = "SELECT *
			FROM ci_jobseekers_skill as js
			WHERE js.jobseeker_id = $userid";
		$query = $this->db->query($sql);
		
		$results = $query->result_array();
		return $results;
	}
	
	// Profile edit for employers
	public function saveemployer($postdata)
	{
  		$user = getUser();
		$this->db->where('user_id', $user->id);
    	$this->db->update('ci_employers', $postdata['employer']);
		
		return true;
	}
	
	// Profile edit for jobseekers
	public function savejobseeker($postdata)
	{
		$user = getUser();
		$this->db->where('user_id', $user->id);
    	$this->db->update('ci_jobseekers', $postdata['jobseeker']);
    	
    	// Delete experience data and save updated data
    	$this->db->delete('ci_jobseekers_experience', array('jobseeker_id' => $user->id));
    	foreach ($postdata['experience'] as $experience){
    		$experience['jobseeker_id'] = $user->id;
			$startdate=date_create($experience['startdate']);
			$enddate=date_create($experience['enddate']);
			$experience['startdate'] = date_format($startdate,"Y-m-d H:i:s");
			$experience['enddate'] = date_format($enddate,"Y-m-d H:i:s");
    		$this->db->insert('ci_jobseekers_experience', $experience);
    	}

    	// Delete education data and save updated data
    	$this->db->delete('ci_jobseekers_education', array('jobseeker_id' => $user->id));
    	foreach ($postdata['education'] as $education){
    		$education['jobseeker_id'] = $user->id;
    		$this->db->insert('ci_jobseekers_education', $education);
    	}
    	 
    	// Delete skills data and save updated data
    	$this->db->delete('ci_jobseekers_skill', array('jobseeker_id' => $user->id));
    	foreach ($postdata['skill'] as $skill){
    		$skill['jobseeker_id'] = $user->id;
    		$this->db->insert('ci_jobseekers_skill', $skill);
    	}
	
		return true;
	}
}