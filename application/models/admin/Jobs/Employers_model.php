<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employers_model extends MY_Model
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

    public function getEmployers($start, $limit)
    {
        $sorting = $this->session->userdata('employers_sorting');
        if (! empty($sorting)) {
            $sortquery = "ORDER BY {$sorting['order']} {$sorting['dir']}";
        } else {
            $sortquery = 'ORDER BY id ASC ';
        }
        
        $query = $this->db->query("SELECT e.user_id,e.firstname,e.lastname,u.email,u.published,u.created_date 
                    FROM ci_users as u 
                    JOIN ci_employers as e ON e.user_id=u.id
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
            FROM ci_employers
        ");
        
        $result = $query->result_array();
        return $result[0]['count'];
    }

    public function getEmployer($id)
    {
        $this->db->select('*');
        $this->db->from('ci_employers');
        $this->db->where('user_id', $id);
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
            $user['username'] = (isset($data['username'])) ? $data['username'] : '';
            $user['email'] = (isset($data['email'])) ? $data['email'] : '';
            $user['password'] = (isset($data['password'])) ? md5($data['password']) : '';
            
            $user['group_id'] = (isset($data['group_id'])) ? $data['group_id'] : '';
            
            $employe['firstname'] = (isset($data['firstname'])) ? $data['firstname'] : '';
            $employe['lastname'] = $data['lastname'];
            $employe['address'] = $data['address'];
            $employe['company'] = $data['company'];
            $employe['workphone'] = $data['workphone'];
            $employe['country'] = (isset($data['country'])) ? $data['country'] : '';
            $employe['state'] = (isset($data['state'])) ? $data['state'] : '';
            $employe['city'] = (isset($data['city'])) ? $data['city'] : '';
            $employe['zip'] = $data['zip'];
            $employe['logo'] = $data['logo'];
            $employe['phoneno'] = $data['phoneno'];
            $employe['website'] = $data['website'];
            
            if ($data['user_id'] > 0) {
                // Set proper data
                
                $user['published'] = isset($data['published']) ? 1 : 0;
                
                // Store data
                $this->db->where('id', $data['user_id']);
                $this->db->update('ci_users', $user);
                
                $this->db->where('user_id', $data['user_id']);
                $this->db->update('ci_employers', $employe);
                $id = $data['user_id'];
            } else {
                $this->db->set('created_date', 'NOW()', FALSE);
                   $user['published'] = isset($data['published']) ? 1 : 0;
                $this->db->insert('ci_users', $user);
                $id = $this->db->insert_id();
             
                $employe['user_id'] = $id;
                $this->db->insert('ci_employers', $employe);
            }
            return (isset($id)) ? $id : FALSE;
        } else {
            return false;
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
}