<?php

class Users_model extends MY_Model
{

    public function __construct()
    {
        $this->table = 'ci_users';
    }

    public function getUsers($start, $limit)
    {
        $sorting = $this->session->userdata('users_sorting');
        if (! empty($sorting)) {
            $sortquery = "ORDER BY {$sorting['order']} {$sorting['dir']}";
        } else {
            $sortquery = 'ORDER BY id ASC ';
        }
        
        $query = $this->db->query("SELECT u.*,g.name as group_name 
                    FROM ci_users as u 
                    LEFT JOIN ci_user_groups as g ON g.id=u.group_id
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
            FROM ci_users
        ");
        
        $result = $query->result_array();
        return $result[0]['count'];
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

    public function save($data = array())
    {
        if (! empty($data)) {
            if ($data['id'] > 0) {
                
                // Set proper data
                $data['published'] = isset($data['published']) ? 1 : 0;
                if (! empty($data['password'])) {
                    $data['password'] = md5($data['password']);
                } else {
                    unset($data['password']);
                }
                
                // Store data
                $this->db->where('id', $data['id']);
                $this->db->update('ci_users', $data);
                $id = $data['id'];
            } else {
                if (! empty($data['password'])) {
                    $data['password'] = md5($data['password']);
                } else {
                    unset($data['password']);
                }
                $this->db->insert('ci_users', $data);
                $id = $this->db->insert_id();
            }
            return (isset($id)) ? $id : FALSE;
        } else {
            return false;
        }
    }
}