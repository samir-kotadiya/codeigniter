<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jobs_model extends MY_Model
{

    public function __construct()
    {
        $this->table = 'ci_jobs';
    }

    public function getJobs($start, $limit)
    {
        $sorting = $this->session->userdata('jobs_sorting');
        if (! empty($sorting)) {
            $sortquery = "ORDER BY {$sorting['order']} {$sorting['dir']}";
        } else {
            $sortquery = 'ORDER BY id ASC ';
        }
        
        $query = $this->db->query("SELECT j.*,c.title as Category_title,e.firstname as Created_by 
                    FROM ci_jobs as j 
                    LEFT JOIN ci_job_categories as c ON j.category_id=c.id 
                      LEFT JOIN ci_employers as e ON e.user_id = j.created_by
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
            FROM ci_jobs
        ");
        
        $result = $query->result_array();
        return $result[0]['count'];
    }

    public function getJob($id)
    {
        $this->db->select('*');
        $this->db->from('ci_jobs');
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
        $skills=$data['skill'];
        unset($data['skill']);
     
        if (! empty($data)) {
            if ($data['id'] > 0) {
                $id = $data['id'];
                $this->db->query("DELETE FROM ci_job_skills WHERE job_id  = $id");
                foreach ($skills as $skill)
                {
                       
                    $skill['job_id'] = $data['id']; 
                    $this->db->insert('ci_job_skills', $skill);
                }
                $data['published'] = isset($data['published']) ? 1 : 0;
                $data['featured'] = isset($data['featured']) ? 1 : 0;
                // Store data
                $date = date_create($data['published_date']);
                $date = date_format($date, 'Y-m-d H:i:s ');
                $data['published_date'] = $date;
                $this->db->where('id', $data['id']);
                $this->db->update('ci_jobs', $data);
              
            } else {
                $date = date_create($data['published_date']);
                $date = date_format($date, 'Y-m-d H:i:s ');
                $data['published_date'] = $date;
                
                $this->db->set('created', 'NOW()', FALSE);
                $this->db->insert('ci_jobs', $data);
                $id = $this->db->insert_id();
                 foreach ($skills as $skill)
                {
                    $skill['job_id'] =  $id; 
                    $this->db->insert('ci_job_skills', $skill);
                }
            }
            return (isset($id)) ? $id : FALSE;
        } else {
            return false;
        }
    }

    public function getJobCategory()
    {
      
        $query = $this->db->query("SELECT title,id FROM ci_job_categories");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function getJobType()
    {
       
        $query = $this->db->query("SELECT title,id FROM ci_job_types");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function getJobSalary()
    {
      
        $query = $this->db->query("SELECT * FROM ci_salary");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function getJobskilllevel()
    {
        $query = $this->db->query("SELECT * FROM ci_skill_levels");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
    public function getcareer()
    {
        $query = $this->db->query("SELECT * FROM ci_careers");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
    public function getJobskill($id)
    {
        $query = $this->db->query("SELECT * FROM ci_job_skills where job_id = $id");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
}