<?php

class Contact_model extends MY_Model
{

    public function __construct()
    {


        $this->table = 'ci_contact';
     
    }

    public function getcontacts($start, $limit)
    {
        $sorting = $this->session->userdata('contact_sorting');
   
        if (! empty($sorting)) {
            $sortquery = "ORDER BY {$sorting['order']} {$sorting['dir']}";
        } else {
            $sortquery = 'ORDER BY id ASC ';
        }

        $query = $this->db->query("SELECT * from ci_contact 
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
            FROM ci_contact
        ");        
        $result = $query->result_array();
        return $result[0]['count'];
    }
    public function save($data = array())
    {
        if (! empty($data)) {            
            if ($data['id'] > 0) {
                // Set proper data
                    echo"<pre>";exit(print_r($data));
                // Store data
                $this->db->where('id', $data['id']);
                $this->db->update('ci_contact', $data);
                $id = $data['id'];
            } else {
                
                $this->db->insert('ci_contact', $data);
                $id = $this->db->insert_id();
            }
            return (isset($id)) ? $id : FALSE;
        } else {
            return false;
        }
    }
    public function getcontact($id)
    {
        $query = $this->db->query("select * from ci_contact where id=$id");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }
   
    

    


    //category

}
    
