<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jobseekers_model extends MY_Model
{

    public function __construct()
    {
        // Set vatriables for publish,unpublish and delete operations
        $this->table = 'ci_users';
        $this->dependents = array(
            array(
                'table' => 'ci_jobseekers',
                'key' => 'user_id'
            )
        );
    }

    public function getJobseekers($start, $limit)
    {
        $sorting = $this->session->userdata('jobseekers_sorting');
        if (! empty($sorting)) {
            $sortquery = "ORDER BY {$sorting['order']} {$sorting['dir']}";
        } else {
            $sortquery = 'ORDER BY id ASC ';
        }
        
        $query = $this->db->query("SELECT j.*,u.* 
                    FROM ci_jobseekers as j 
                    LEFT JOIN ci_users as u ON u.id=j.user_id
                    $sortquery 
                    LIMIT $start,$limit
                ");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function getCount()
    {
        $query = $this->db->query("SELECT count(*) as count
            FROM ci_jobseekers
        ");
        
        $result = $query->result_array();
        return $result[0]['count'];
    }

    public function getJobseeker($id)
    {
        $this->db->select('*');
        $this->db->from('ci_jobseekers');
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function getGroups()
    {
        $query = $this->db->query('SELECT * 
                    FROM ci_user_groups');
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function getCareerType()
    {
        $query = $this->db->query('SELECT * 
                    FROM ci_careers');
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function getSalaryType()
    {
        $query = $this->db->query('SELECT * 
                    FROM ci_salary');
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
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

    public function getUser($id)
    {
        $this->db->select('*');
        $this->db->from('ci_users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function save($data = array())
    {
        if (! empty($data)) {
            /* explode arrray */
            /*echo"<pre>";exit(print_r($data));*/
            $user['username'] = (isset($data['username'])) ? $data['username'] : '';
            $user['email'] = (isset($data['email'])) ? $data['email'] : '';
            $user['password'] = (isset($data['password'])) ? md5($data['password']) : '';
            
            $user['group_id'] = (isset($data['group_id'])) ? $data['group_id'] : '';
            
            $jobseeker['firstname'] = (isset($data['firstname'])) ? $data['firstname'] : '';
            $jobseeker['lastname'] = $data['lastname'];
            $jobseeker['address'] = $data['address'];
            /*$jobseeker['education'] = json_encode($data['education']);*/

            $jobseeker['workphone'] = $data['workphone'];
            $jobseeker['country'] = (isset($data['country'])) ? $data['country'] : '';
            $jobseeker['state'] = (isset($data['state'])) ? $data['state'] : '';
            $jobseeker['city'] = (isset($data['city'])) ? $data['city'] : '';
            $jobseeker['zip'] = $data['zip'];
            $jobseeker['job_category_id'] = $data['job_category_id'];
          /*  $jobseeker['experience'] = json_encode($data['experience']);*/

            $jobseeker['resume'] = $data['resume'];
            $jobseeker['job_category_id'] = $data['job_category_id'];
           /* $jobseeker['skill'] = json_encode($data['skill']);*/
         
      
            $jobseeker['salary_type_id'] = $data['salary_type_id'];
            $jobseeker['career_type_id'] = $data['career_type_id'];
        
            if ($data['user_id'] > 0) {
                // Set proper data
                    
                $user['published'] = isset($data['published']) ? 1 : 0;
           
                 $this->db->query('DELETE FROM ci_jobseekers_experience WHERE jobseeker_id ='.$data['user_id'] .'');
                 $this->db->query('DELETE FROM ci_jobseekers_education WHERE jobseeker_id ='.$data['user_id'] .'');
                 $this->db->query('DELETE FROM ci_jobseekers_skill WHERE jobseeker_id ='.$data['user_id'] .''); 
                       foreach ($data['experience'] as $experience){
                            $startdate=date_create($experience['startdate']);
                            $enddate=date_create($experience['enddate']);
                            $experience['startdate'] = date_format($startdate,"Y-m-d H:i:s");
                            $experience['enddate'] = date_format($enddate,"Y-m-d H:i:s");
                            
                            $experience['jobseeker_id'] = $data['user_id']; 
                            $this->db->insert('ci_jobseekers_experience', $experience);
                        }
                        
                        foreach ($data['education'] as $education){
                            $education['jobseeker_id'] = $data['user_id'];
                            $this->db->insert('ci_jobseekers_education', $education);
                        }
                        
                        foreach ($data['skill'] as $skill){
                            $skill['jobseeker_id'] = $data['user_id'];
                            $this->db->insert('ci_jobseekers_skill', $skill);
                        }


                // Store data
                $this->db->where('id', $data['user_id']);
                $this->db->update('ci_users', $user);
                
                $this->db->where('user_id', $data['user_id']);
                $this->db->update('ci_jobseekers', $jobseeker);
                $id = $data['user_id'];
            } else {
                $user['published'] = isset($data['published']) ? 1 : 0;
                $this->db->set('created_date', 'NOW()', FALSE);
                $this->db->insert('ci_users', $user);
                $id = $this->db->insert_id();
                
                $jobseeker['user_id'] = $id;
                $this->db->insert('ci_jobseekers', $jobseeker);

                foreach ($data['experience'] as $experience){
                            $startdate=date_create($experience['startdate']);
                            $enddate=date_create($experience['enddate']);
                            $experience['startdate'] = date_format($startdate,"Y-m-d H:i:s");
                            $experience['enddate'] = date_format($enddate,"Y-m-d H:i:s");
                            
                            $experience['jobseeker_id'] = $id; 
                            $this->db->insert('ci_jobseekers_experience', $experience);
                        }
                        
                        foreach ($data['education'] as $education){
                            $education['jobseeker_id'] = $id;
                            $this->db->insert('ci_jobseekers_education', $education);
                        }
                        
                        foreach ($data['skill'] as $skill){
                            $skill['jobseeker_id'] = $id;
                            $this->db->insert('ci_jobseekers_skill', $skill);
                        }
            }
            return (isset($id)) ? $id : FALSE;
        } else {
            return false;
        }
    }
    public function getJobEducationsLevel()
    {
        $query = $this->db->query("SELECT * FROM ci_careers");
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
     public function getexperience($id)
    {
        $this->db->select('*');
        $this->db->from('ci_jobseekers_experience');
        $this->db->where('jobseeker_id', $id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
     public function getskill($id)
    {
        $this->db->select('*');
        $this->db->from('ci_jobseekers_skill');
        $this->db->where('jobseeker_id', $id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
     public function geteducations($id)
    {
        $this->db->select('*');
        $this->db->from('ci_jobseekers_education');
        $this->db->where('jobseeker_id', $id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
}