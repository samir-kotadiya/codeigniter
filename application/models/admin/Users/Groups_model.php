<?php

class Groups_model extends MY_Model
{

    public function __construct()
    {
        //$this->load->database();
        $this->table = 'ci_user_groups';
    }

    public function getGroups($start, $limit)
    {
        $query = $this->db->query("SELECT * FROM ci_user_groups LIMIT $start,$limit");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function getCount()
    {
        $query = $this->db->query("SELECT count(*) as count FROM ci_user_groups");
        
        $result = $query->result_array();
        return $result[0]['count'];
    }

    public function getGroup($id)
    {
        $this->db->select('*');
        $this->db->from('ci_user_groups');
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
            if ($data['id'] > 0) {
                // Store data
                $this->db->where('id', $data['id']);
                $this->db->update('ci_user_groups', $data);
                $id = $data['id'];
            } else {
                $this->db->insert('ci_user_groups', $data);
                $id = $this->db->insert_id();
            }
            return (isset($id)) ? $id : FALSE;
        } else {
            return false;
        }
    }
}