<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Resumes_model extends MY_Model {
	
	public function getResumes()
	{
		$sql = "SELECT js.*,u.created_date,
					jcountry.name as country_name,
                    jstate.name as state_name,
                    jcity.name as city_name
			 	FROM ci_jobseekers as js
					LEFT JOIN ci_users as u ON js.user_id=u.id
					/*LEFT JOIN ci_jobseekers_education as ed ON js.user_id=ed.jobseeker_id
					LEFT JOIN ci_jobseekers_experience as ex ON js.user_id=ex.jobseeker_id
					LEFT JOIN ci_jobseekers_skill as s ON js.user_id=s.jobseeker_id*/
					LEFT JOIN ci_countries as jcountry ON jcountry.id=js.country
                    LEFT JOIN ci_states as jstate ON jstate.id=js.state
                    LEFT JOIN ci_cities as jcity ON jcity.id=js.city
				WHERE u.published=1 
				GROUP BY js.user_id";
		
		$query = $this->db->query($sql);
		$results = $query->result_array();

		return $results;
	}
	
	public function getMyResumes()
	{
		$user = getUser();
		 
		if($user->id == 0){
			show_404();
		}
		
		$usersql = "SELECT resume_ids FROM ci_saved_resumes WHERE user_id={$user->id}";
		$userquery = $this->db->query($usersql);
		
		if ($userquery->num_rows() > 0) {
			$resumeids = $userquery->row_array();
			$resumeids = $resumeids['resume_ids']; 
			$sql = "SELECT js.*,u.created_date,
					jcountry.name as country_name,
                    jstate.name as state_name,
                    jcity.name as city_name
			 	FROM ci_jobseekers as js
					LEFT JOIN ci_users as u ON js.user_id=u.id
					LEFT JOIN ci_countries as jcountry ON jcountry.id=js.country
                    LEFT JOIN ci_states as jstate ON jstate.id=js.state
                    LEFT JOIN ci_cities as jcity ON jcity.id=js.city
				WHERE u.published=1
					AND js.user_id IN ({$resumeids})
				GROUP BY js.user_id";
	
			$query = $this->db->query($sql);
			$results = $query->result_array();
		
			return $results;
		}else{
			return array();	
		}
	}

	public function getResume($userid = 0)
    {
    	$user = getUser();

        $query = $this->db->query("SELECT js.*,
                 		
                 		cnt.name as country_name,
                 		st.name as state_name,
                 		ct.name as city_name,
                 		cs.type as salary_type,
                 		cti.name as career_type               	
	                    FROM ci_jobseekers as js
	                  
						LEFT JOIN ci_states as st ON js.state=st.id
						LEFT JOIN ci_cities as ct ON js.city=ct.id
						LEFT JOIN ci_salary as cs ON js.salary_type_id=cs.id
						LEFT JOIN ci_careers as cti ON js.career_type_id=cti.id
						LEFT JOIN ci_countries as cnt ON js.country=cnt.id

	                    where js.user_id = $userid"); 

						$results = $query->row_array();		
						$query = $this->db->query("SELECT je.*,el.name FROM ci_jobseekers_education as je
								LEFT JOIN ci_education_level as el ON el.id=je.level WHERE je.jobseeker_id =$userid");
						$results['educations'] = $query->result_array();

						$query = $this->db->query("SELECT * FROM ci_jobseekers_experience WHERE jobseeker_id=$userid");
						$results['experiences'] = $query->result_array();

						$query = $this->db->query("SELECT jos.*,sk.name FROM ci_jobseekers_skill as jos
								LEFT JOIN ci_skill_levels as sk ON sk.id=jos.skilllevel WHERE jos.jobseeker_id =$userid");
						$results['skills'] = $query->result_array();
					
                    if ($query->num_rows() > 0) {
                         return $results;
                    } else {
                         return array();
                    } return $result;
    }
    
    public function saveresume($resumeid = 0, $userid = 0)
    {
    	$query = $this->db->query("SELECT * FROM ci_saved_resumes WHERE user_id=$userid");
    	if ($query->num_rows() > 0) {
    
    		$savedjobdata = $query->row_array();
    
    		$resume_ids = explode(',', $savedjobdata['resume_ids']);
    		$resume_ids[] = $resumeid;
    		$resume_ids = array_unique($resume_ids);
    
    		$data = array(
    			'resume_ids' => implode(',', $resume_ids)
    		);
    
    		$this->db->where('user_id', $savedjobdata['user_id']);
    		$this->db->update('ci_saved_resumes', $data);
    
    		return true;
    	} else {
    		$data['resume_ids'] = $resumeid;
    		$data['user_id'] = $userid;
    		if ($this->db->insert('ci_saved_resumes', $data)) {
    			return true;
    		} else {
    			return false;
    		}
    	}
    }
}