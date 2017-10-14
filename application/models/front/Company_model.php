<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Company_model extends MY_Model {
	
	public function getCompanies()
	{
		$sql = "SELECT e.*,u.created_date,
					jcountry.name as country_name,
                    jstate.name as state_name,
                    jcity.name as city_name
			 	FROM ci_employers as e
					LEFT JOIN ci_users as u ON e.user_id=u.id
					LEFT JOIN ci_countries as jcountry ON jcountry.id=e.country
                    LEFT JOIN ci_states as jstate ON jstate.id=e.state
                    LEFT JOIN ci_cities as jcity ON jcity.id=e.city
				WHERE u.published=1 
				GROUP BY e.user_id";
		
		$query = $this->db->query($sql);
		$results = $query->result_array();

		return $results;
	}

	public function getCompany($userid = 0)
    {
    	$user = getUser();

        $query = $this->db->query(
        			"SELECT e.*,
			            cnt.name as country_name,
			     		st.name as state_name,
			     		ct.name as city_name               	
		            FROM ci_employers as e
			        	LEFT JOIN ci_states as st ON e.state=st.id
						LEFT JOIN ci_cities as ct ON e.city=ct.id
						LEFT JOIN ci_countries as cnt ON e.country=cnt.id
		            where e.user_id = $userid"
        		); 

		$results = $query->row_array();		
			
        if ($results > 0) {
             return $results;
        } else {
             return array();
        }
    }
}