<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jobs_model extends MY_Model
{

    public function saveuser($data)
    {
        if (isset($data['group_id'])) {
            
            $this->db->where('email', $data['email']);
            $query = $this->db->get('ci_users');
            $count_row = $query->num_rows();
            
            if ($count_row > 0) {
                return false;
            }
            
            // Save to users table
            $userdata = array(
                'username' => $data['email'],
                'password' => md5($data['password']),
                'email' => $data['email'],
                'published' => 1,
                'group_id' => $data['group_id'],
                'created_date' => date("Y-m-d H:i:s")
            );
            $this->db->insert('ci_users', $userdata);
            
            // save to employer or job seeker
            $user_id = $this->db->insert_id();
            if ($user_id) {
                if ($data['group_id'] == 2) {
                    $savedata = array(
                        'user_id' => $user_id,
                        'firstname' => $data['firstname'],
                        'lastname' => $data['lastname'],
                        'address' => $data['address'],
                        'company' => $data['company'],
                        'logo' => $data['logo'],
                        'workphone' => $data['workphone'],
                        'city' => $data['city'],
                        'state' => $data['state'],
                        'country' => $data['country'],
                        'zip' => $data['zip'],
                        'phoneno' => $data['phoneno'],
                        'website' => $data['website']
                    );
                                        
                    if (! $this->db->insert('ci_employers', $savedata)) {
                    	$this->db->query("DELETE FROM ci_users WHERE id='" . $user_id . "'");
                    	return false;
                    } else {
                    	return true;
                    }
                    
                } else {
                	$data['career_type_id'] = ($data['career_type_id']) ? $data['career_type_id'] : '';
                	/* $data['experience'] = json_encode($data['experience']);
                	$data['education'] = json_encode($data['education']);
                	$data['skill'] = json_encode($data['skill']); */
                	
                    $savedata = array(
                        'user_id' => $user_id,
                        'firstname' => $data['firstname'],
                        'lastname' => $data['lastname'],
                        'address' => $data['address'],
                        /* 'education' => $data['education'], */
                        'resume' => $data['resume'],
                        'job_category_id' => $data['job_category_id'],
                        /*'salary_type_id' => $data['salary_type_id'],*/
                        'career_type_id' => $data['career_type_id'],
                        /* 'experience' => $data['experience'], */
                        /* 'skill' => $data['skill'], */
                        'address' => $data['address'],
                        'workphone' => $data['workphone'],
                        'city' => $data['city'],
                        'state' => $data['state'],
                        'country' => $data['country'],
                        'zip' => $data['zip']
                    );
                                        
                    if (! $this->db->insert('ci_jobseekers', $savedata)) {
                    	$this->db->query("DELETE FROM ci_users WHERE id='" . $user_id . "'");
                    	return false;
                    } else {
                    	foreach ($data['experience'] as $experience){
                    		$experience['jobseeker_id'] = $user_id; 
                            $startdate=date_create($experience['startdate']);
                            $enddate=date_create($experience['enddate']);
                            $experience['startdate'] = date_format($startdate,"Y-m-d H:i:s");
                            $experience['enddate'] = date_format($enddate,"Y-m-d H:i:s");
                    		$this->db->insert('ci_jobseekers_experience', $experience);
                    	}
                    	
                    	foreach ($data['education'] as $education){
                    		$education['jobseeker_id'] = $user_id;
                    		$this->db->insert('ci_jobseekers_education', $education);
                    	}
                    	
                    	foreach ($data['skill'] as $skill){
                    		$skill['jobseeker_id'] = $user_id;
                    		$this->db->insert('ci_jobseekers_skill', $skill);
                    	}
                    	
                    	return true;
                    }
                }
            }
        } else {
            return false;
        }
    }

    public function save($data)
    {
        $storedata = array();
        $storedata['title'] = $data['title'];
        $storedata['code'] = $data['code'];
        $storedata['description'] = $data['description'];
        $storedata['featured'] = $data['featured'];
        $storedata['category_id'] = $data['category_id'];
        $storedata['salary_type_id'] = $data['salary_type_id'];
        $storedata['max_salary'] = $data['max_salary'];
        $storedata['min_salary'] = $data['min_salary'];
        $storedata['city'] = $data['city'];
        $storedata['state'] = $data['state'];
        $storedata['country'] = $data['country'];
        $storedata['address'] = $data['address'];
        $storedata['zip_code'] = $data['zip_code'];
        $storedata['tags'] = $data['tags'];
        $storedata['language'] = $data['language'];
        $storedata['job_type_id'] = $data['job_type_id'];
        $storedata['career_type_id'] = $data['career_type_id'];
        //$storedata['skill'] = $data['skill'];
        $storedata['published_date'] = $data['published_date'];
        $storedata['created_by'] = $data['created_by'];
        
        if(!$data['id']){
	        $this->db->set('created', 'NOW()', FALSE);
	        $this->db->insert('ci_jobs', $storedata);
	        $job_id = $this->db->insert_id();
        }else{
        	$this->db->where('id', $data['id']);
    		$this->db->update('ci_jobs', $storedata);
    		$job_id = $data['id'];
    		
    		//Remove existing skills for job to edit
    		$this->db->query("DELETE FROM ci_job_skills WHERE job_id = '$job_id'");
        }
        
        // Store skilles
        $skilldata = array();
        $skills = array_values($data['skill']);
        
        foreach ($skills as $key=>$skill){
        	$skills[$key]['job_id'] = $job_id;
        }
        
        $this->db->insert_batch('ci_job_skills', $skills);
        
        return true;
    }
    
    public function editjob($data)
    { 
        $id =$data['job_id'];
        
        $this->db->query("DELETE FROM ci_job_skills WHERE job_id  = $id");

        foreach ($data['skill'] as $skill){
            $skill['job_id'] = $data['job_id']; 
     
            $this->db->insert('ci_job_skills', $skill);
        }
                
    	$this->db->where('id', $data['job_id']);
    	$this->db->update('ci_jobs', $data['job']);
    }

    public function getJobs($filters,$start=0,$limit=100)
    {
    	$querymore = array();
    	$joinmore = '';
    	
    	if(!empty($filters['ids'])){
    		$querymore[] = " j.id IN ({$filters['ids']}) ";
    	}
    	
    	if(!empty($filters['employer'])){
    		$querymore[] = " je.user_id = ({$filters['employer']}) ";
    	}
    	
    	if(!empty($filters['keywork'])){
    		$querymore[] = " (j.title LIKE '%{$filters['keywork']}%' or j.description LIKE '%{$filters['keywork']}%') ";
    	}
    	
    	if(!empty($filters['skill'])){
    		$querymore[] = " s.skill LIKE '%{$filters['skill']}%' ";
    	}
    	
    	if(!empty($filters['address'])){
    		$querymore[] = " jcity.name LIKE '%{$filters['address']}%' or jstate.name LIKE '%{$filters['address']}%' or jcountry.name LIKE '%{$filters['address']}%' ";
    	}
    	
    	if(!empty($filters['currency'])){
            $querymore[] = " (j.min_salary<={$filters['currency']} AND j.max_salary>={$filters['currency']}) ";   
        }

    	if(!empty($filters['salary_picker'])){
            $querymore[] = " st.id = '{$filters['salary_picker']}' ";
        }

    	if(!empty($filters['posted_picker'])){
            $querymore[] = " DATEDIFF(now(),j.published_date) <= '{$filters['posted_picker']}' ";
        }

    	if(!empty($filters['employmenttype_picker'])){
            $emptype = implode(',', $filters['employmenttype_picker']);
            $querymore[] = " jt.id IN ({$emptype}) ";
        }

    	if(!empty($filters['career_picker'])){
            $querymore[] = " c.id = '{$filters['career_picker']}' ";
        }
        
        if(!empty($filters['category'])){
        	$querymore[] = " j.category_id = '{$filters['category']}' ";
        }

    	if(!empty($filters['distance_picker'])){
    		$user = getUser();
    		if($user->id != 0){
	    		if($user->group_id == 2){
	    			$usertable = 'ci_employers'; 
	    		}else{
	    			$usertable = 'ci_jobseekers';
	    		}
	    		$query = $this->db->query("SELECT zip FROM $usertable WHERE user_id={$user->id}");
	    		$result = $query->result_array();
	    		if(!empty($result)){
	    			$zip = 	$result[0]['zip'];
	    			echo $zip;exit;
	    		}
    		}
        }
        
        if(!empty($filters['tag'])){
        	$querymore[] = " FIND_IN_SET('{$filters['tag']}', j.tags) ";
        }
		
    	$isquerymore = count($querymore);
    	$whereclause = '';
    	if($isquerymore){
    		$whereclause = ' AND '.implode(' AND ', $querymore);
    	}
    	
        $return = array();
        $sql = "SELECT j.*,
                    jc.title as titlecategory,
                    jt.title as titletype,
                    jcountry.name as country_name,
                    jstate.name as state_name,
                    jcity.name as city_name,
                    je.company,je.logo as company_logo,je.website as company_website,je.firstname as employer_firstname,je.lastname as employer_lastname 
                FROM ci_jobs as j
                    LEFT JOIN ci_employers as je ON je.user_id=j.created_by
                    LEFT JOIN ci_job_categories as jc ON jc.id=j.category_id
                    LEFT JOIN ci_job_types as jt ON jt.id=j.job_type_id
                    LEFT JOIN ci_countries as jcountry ON jcountry.id=j.country
                    LEFT JOIN ci_states as jstate ON jstate.id=j.state
                    LEFT JOIN ci_cities as jcity ON jcity.id=j.city
                    LEFT JOIN ci_job_skills as s ON s.job_id=j.id 
                    LEFT JOIN ci_salary as st ON st.id=j.salary_type_id
                    LEFT JOIN ci_careers as c ON c.id=j.career_type_id
                    $joinmore
                WHERE j.published=1 $whereclause
                    AND jc.published=1
                GROUP BY j.id
        		ORDER BY j.id DESC
        		LIMIT $start,$limit";
        
        $query = $this->db->query($sql);
        //echo '<pre>';print_r($query->result_array());exit;
        if ($query->num_rows() > 0) {
            $return = $query->result_array();
        }
        return $return;
    }
    
    public function getJobsCount($filters)
    {
    	$querymore = array();
    	$joinmore = '';
    	
    	if(!empty($filters['ids'])){
    		$querymore[] = " j.id IN ({$filters['ids']}) ";
    	}
    	 
    	if(!empty($filters['employer'])){
    		$querymore[] = " je.user_id = ({$filters['employer']}) ";
    	}
    	 
    	if(!empty($filters['keywork'])){
    		$querymore[] = " (j.title LIKE '%{$filters['keywork']}%' or j.description LIKE '%{$filters['keywork']}%') ";
    	}
    	 
    	if(!empty($filters['skill'])){
    		$querymore[] = " s.skill LIKE '%{$filters['skill']}%' ";
    	}
    	 
    	if(!empty($filters['address'])){
    		$querymore[] = " jcity.name LIKE '%{$filters['address']}%' or jstate.name LIKE '%{$filters['address']}%' or jcountry.name LIKE '%{$filters['address']}%' ";
    	}
    	 
    	if(!empty($filters['currency'])){
    		$querymore[] = " (j.min_salary<={$filters['currency']} AND j.max_salary>={$filters['currency']}) ";
    	}
    
    	if(!empty($filters['salary_picker'])){
    		$querymore[] = " st.id = '{$filters['salary_picker']}' ";
    	}
    	
    	if(!empty($filters['posted_picker'])){
    		$querymore[] = " DATEDIFF(now(),j.published_date) <= '{$filters['posted_picker']}' ";
    	}
    	
    	if(!empty($filters['employmenttype_picker'])){
    		$emptype = implode(',', $filters['employmenttype_picker']);
    		$querymore[] = " jt.id IN ({$emptype}) ";
    	}
    	
    	if(!empty($filters['career_picker'])){
    		$querymore[] = " c.id = '{$filters['career_picker']}' ";
    	}
    	
    	if(!empty($filters['category'])){
    		$querymore[] = " j.category_id = '{$filters['category']}' ";
    	}
    	
    	if(!empty($filters['distance_picker'])){
    		$user = getUser();
    		if($user->id != 0){
    			if($user->group_id == 2){
    				$usertable = 'ci_employers';
    			}else{
    				$usertable = 'ci_jobseekers';
    			}
    			$query = $this->db->query("SELECT zip FROM $usertable WHERE user_id={$user->id}");
    			$result = $query->result_array();
    			if(!empty($result)){
    				$zip = 	$result[0]['zip'];
    				echo $zip;exit;
    			}
    		}
    	}
    
    	if(!empty($filters['tag'])){
        	$querymore[] = " FIND_IN_SET('{$filters['tag']}', j.tags) ";
        }
		
    	$isquerymore = count($querymore);
    	$whereclause = '';
    	if($isquerymore){
    		$whereclause = ' AND '.implode(' AND ', $querymore);
    	}
    		 
    	$return = array();
    	$sql = "SELECT count(j.id) as jobcount
                FROM ci_jobs as j
                    LEFT JOIN ci_employers as je ON je.user_id=j.created_by
                    LEFT JOIN ci_job_categories as jc ON jc.id=j.category_id
                    LEFT JOIN ci_job_types as jt ON jt.id=j.job_type_id
                    LEFT JOIN ci_countries as jcountry ON jcountry.id=j.country
                    LEFT JOIN ci_states as jstate ON jstate.id=j.state
                    LEFT JOIN ci_cities as jcity ON jcity.id=j.city
                    LEFT JOIN ci_job_skills as s ON s.job_id=j.id 
                    LEFT JOIN ci_salary as st ON st.id=j.salary_type_id
                    LEFT JOIN ci_careers as c ON c.id=j.career_type_id
                WHERE j.published=1 $whereclause
                    AND jc.published=1";

    	$query = $this->db->query($sql);
        return $query->row_array();
	}
    
    public function getMyJobs()
    {
    	$user = getUser();
    	
    	if($user->id == 0){
    		show_404();
    	}
    	
    	$return = array();
    	$sql = "SELECT j.*,COUNT(ja.job_id) as application
                   FROM ci_jobs as j
	               LEFT JOIN  ci_job_applications as ja ON ja.job_id=j.id
               	WHERE j.created_by=$user->id
				GROUP BY ja.job_id,j.id order by j.id asc
                    ";
    
    	$query = $this->db->query($sql);
    
    	if ($query->num_rows() > 0) {
    		$return = $query->result_array();
    	}
    	return $return;
    }

    public function getJob($id = 0)
    {
        $return = array();
        $sql = "SELECT j.*,
                    jc.title as titlecategory,
                    jt.title as titletype,
                    jcountry.name as country_name,
                    jstate.name as state_name,
                    jcity.name as city_name,
                    je.company,je.workphone,je.logo as company_logo,je.website as company_website,je.firstname as employer_firstname,je.lastname as employer_lastname 
                FROM ci_jobs as j
                    LEFT JOIN ci_employers as je ON je.user_id=j.created_by
                    LEFT JOIN ci_job_categories as jc ON jc.id=j.category_id
                    LEFT JOIN ci_job_types as jt ON jt.id=j.job_type_id
                    LEFT JOIN ci_countries as jcountry ON jcountry.id=j.country
                    LEFT JOIN ci_states as jstate ON jstate.id=j.state
                    LEFT JOIN ci_cities as jcity ON jcity.id=j.city
                WHERE j.published=1 
                    AND jc.published=1 
                    AND j.id={$id}";
        
        $query = $this->db->query($sql);
        
        if ($query->num_rows() > 0) {
            $return = $query->row_array();
        }
          
        return $return;
    }
    /**
     * job_detail
     *
     * @param number $jobid             
     *
     * @return array
     */
    public function getJobdetail($id = 0)
    {
        
        $return = array();
        $sql = "SELECT j.*,
                    jc.title as titlecategory,
                    jt.title as titletype,
                    jca.name as careername,
                    js.type as salarytype,
                    jcountry.name as country_name,
                    jstate.name as state_name,
                    jcity.name as city_name
                FROM ci_jobs as j
                    LEFT JOIN ci_job_categories as jc ON jc.id=j.category_id
                    LEFT JOIN ci_careers as jca ON jca.id=j.career_type_id
                    LEFT JOIN ci_job_types as jt ON jt.id=j.job_type_id
                    LEFT JOIN ci_salary as js ON js.id=j.salary_type_id  
                    LEFT JOIN ci_countries as jcountry ON jcountry.id=j.country
                    LEFT JOIN ci_states as jstate ON jstate.id=j.state
                    LEFT JOIN ci_cities as jcity ON jcity.id=j.city
                WHERE j.id={$id}";
        
        $query = $this->db->query($sql);
        
        if ($query->num_rows() > 0) {
            $return = $query->row_array();
            
            $skillquery = $this->db->query("SELECT * FROM ci_job_skills WHERE job_id='{$return['id']}'");
            if ($skillquery->num_rows() > 0) {
            	$return['skills'] = $skillquery->result_array();
            }else{
            	$return['skills'] = array();
            }
        }
	
        return $return;
    }
    
    /**
     * Apply for job
     *
     * @param number $jobid            
     * @param number $userid            
     *
     * @return bool
     */
    public function apply($jobid = 0, $userid = 0)
    {
        $query = $this->db->query("SELECT * FROM ci_job_applications WHERE user_id=$userid AND job_id=$jobid");
        if ($query->num_rows() > 0) {
            return false;
        } else {
            $data['job_id'] = $jobid;
            $data['user_id'] = $userid;
            if ($this->db->insert('ci_job_applications', $data)) {
                return true;
            } else {
                return false;
            }
        }
    }
    
    /**
     * Save job for profile
     *
     * @param number $jobid
     * @param number $userid
     *
     * @return bool
     */
    public function savejob($jobid = 0, $userid = 0)
    {
    	$query = $this->db->query("SELECT * FROM ci_saved_jobs WHERE user_id=$userid");
    	if ($query->num_rows() > 0) {
    		
    		$savedjobdata = $query->row_array();
    		
    		$job_ids = explode(',', $savedjobdata['job_ids']);
    		$job_ids[] = $jobid;
    		$job_ids = array_unique($job_ids);
    		
    		$data = array(
    			'job_ids' => implode(',', $job_ids)
    		);
    		
    		$this->db->where('user_id', $savedjobdata['user_id']);
    		$this->db->update('ci_saved_jobs', $data);
    		
    		return true;
    	} else {
    		$data['job_ids'] = $jobid;
    		$data['user_id'] = $userid;
    		if ($this->db->insert('ci_saved_jobs', $data)) {
    			return true;
    		} else {
    			return false;
    		}
    	}
    }
    
    public function addHit($id)
    {
	    $query = $this->db->query("SELECT hits FROM ci_jobs WHERE id={$id}");
	    $result = $query->row_array();
	    
    	$data = array(
 			'hits' => $result['hits']+1
    	);
    	
    	$this->db->where('id', $id);
    	$this->db->update('ci_jobs', $data);
		return true;
    }

    public function getJobCategory()
    {
        $CIHelper = get_instance();
        $CIHelper->load->database();
        $query = $CIHelper->db->query("SELECT title,id FROM ci_job_categories");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function getJobType()
    {
        $CIHelper = get_instance();
        $CIHelper->load->database();
        $query = $CIHelper->db->query("SELECT title,id FROM ci_job_types");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function getJobSalary()
    {
        $CIHelper = get_instance();
        $CIHelper->load->database();
        $query = $CIHelper->db->query("SELECT * FROM ci_salary");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function getJobCareers()
    {
        $query = $this->db->query("SELECT * FROM ci_careers");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function getJobEducationsLevel()
    {
        $query = $this->db->query("SELECT * FROM ci_education_level");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function getSkillLevels()
    {
        $query = $this->db->query("SELECT * FROM ci_skill_levels");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
  /* start my jobs published */  
    public function publish($cids)
    {   
        $this->db->query('UPDATE ci_jobs SET published=1 WHERE id IN(' . implode(",", $cids) . ')');
        return true;
    }
 
    public function unpublish($cids)
    {
        $this->db->query('UPDATE ci_jobs SET published=0 WHERE id IN(' . implode(",", $cids) . ')');
        return true;
    }
    
    public function delete($cids)
    {
        
       	$this->db->query('DELETE FROM ci_jobs WHERE id IN (' . implode(",", $cids) . ')');
        $this->db->query('DELETE FROM ci_job_applications WHERE job_id IN (' . implode(",", $cids) . ')');
        $this->db->query('DELETE FROM ci_job_skills WHERE job_id IN (' . implode(",", $cids) . ')');
          
        return true;
    }
    /* end my jobs published */  
     public function getResume($resumeid = 0)
    {
        if($resumeid == '')
        {
            
            $appendquery='';
        }
        else
        {
             $appendquery = " AND jo.id =".$resumeid;
        }
        $user = getUser();
        $query = $this->db->query("SELECT js.*, 
                    jo.id as Job_id,
                    jo.title as Job_title,
                    jo.code as Job_Code,
                    ja.id,
                    ja.user_id
                    FROM ci_job_applications as ja
                    INNER JOIN ci_jobs  as jo  ON ja.job_id=jo.id
                    INNER JOIN ci_jobseekers as js ON ja.user_id=js.user_id
                    where jo.created_by = $user->id $appendquery");   
                
                    if ($query->num_rows() > 0) {
                         return $query->result_array();
                    } else {
                         return array();
                    } return $result;
 
    }
    
    public function deleteresume($cids)
    {
        $this->db->query('DELETE FROM ci_job_applications WHERE id IN (' . implode(",", $cids) . ')');
        return true;
    }
    
	public function savesearch($data){
		$savedata = array();
		$savedata['user_id'] = $data['user_id'];
		$savedata['search'] = $data['filters'];
		$savedata['title'] = 'Saved search';
		if(!$this->db->insert('ci_saved_search', $savedata)){
			return false;
		}else{
			return true;
		}
	}
	
	public function deletesavesearch($data){
		$searchdata = array();
		$searchdata['user_id'] = $data['user_id'];
		$searchdata['id'] = $data['searchid'];
		
		if(!$this->db->delete('ci_saved_search', $searchdata)){
			return false;
		}else{
			return true;
		}
	}

	public function getSavedSearch($id=0){
		$data = array();
		$data['user_id'] = getUser()->id;
		if($id != 0){
			$data['id'] = $id;
		}
		
		$query = $this->db->get_where('ci_saved_search', $data);
		$results = $query->result_array();
		return $results;
	}
	
	public function getSavedJobs($id=0){
		$data = array();
		$data['user_id'] = $id;
		
		$query = $this->db->get_where('ci_saved_jobs', $data);
		$results = $query->row_array();
		return $results;
	}
	
	public function getAppliedJobs($id=0){
		$data = array();
		$data['user_id'] = $id;
	
		//$query = $this->db->get_where('ci_job_applications', $data);
		$query = $this->db->query("SELECT GROUP_CONCAT(job_id) as id FROM ci_job_applications where user_id= $id");
		$results = $query->row_array();
		
		return $results;
	}
	
    public function clonejob($id)
    {
       $query = $this->db->query("SELECT * FROM ci_jobs where id= $id");
        $results = $query->result_array();
        foreach ($results as $key => $value) {
            $value['id']='';
            $value['title'] = $value['title']."_copy" ; 
            $value['hits'] = 0;    
        }
        $this->db->insert('ci_jobs', $value);
        $lastid = $this->db->insert_id();
        $query = $this->db->query("SELECT * FROM ci_job_skills where job_id = $id");
        $results = $query->result_array();
        foreach ($results as $key => $value) {
         $value['job_id'] = $lastid;
         $this->db->insert('ci_job_skills', $value);           
        }
 
       return ;
    }
}