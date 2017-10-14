<?php

class Category_model extends MY_Model
{

    public function __construct()
    {

        $this->table = 'ci_categories';
    }

    //category
     public function getcategory($start, $limit)
    {
        $sorting = $this->session->userdata('category_sorting');
   
        if (! empty($sorting)) {
            $sortquery = "ORDER BY {$sorting['order']} {$sorting['dir']}";
        } else {
            $sortquery = 'ORDER BY id ASC ';
        }
  
        $query = $this->db->query("SELECT b.*,u.username as createdby 
                    FROM ci_categories as b 
                    INNER JOIN ci_users as u ON u.id=b.created_by
                    $sortquery 
                    LIMIT $start,$limit
                ");
        if ($query->num_rows() > 0) {
           
            return $query->result_array();
        } else {
            return array();
        }
    }
     public function getcategorycount()
    {
        $query = $this->db->query("SELECT count(*) as count
            FROM ci_categories
        ");
        
        $result = $query->result_array();
        return $result[0]['count'];
    }
     public function savecategory($data = array())
    {
        if (! empty($data)) {
       
            if ($data['id'] > 0) {
                
                // Set proper data
                $data['published'] = isset($data['published']) ? 1 : 0;
                
                // Store data
                $this->db->where('id', $data['id']);
                $this->db->update('ci_categories', $data);
                $id = $data['id'];
            } else {
                $this->db->set('created', 'NOW()', FALSE);
                $this->db->insert('ci_categories', $data);
                $id = $this->db->insert_id();
            }
            return (isset($id)) ? $id : FALSE;
        } else {
            return false;
        }
    }
  public function get_category($id)
    {
        $query = $this->db->query("select * from ci_categories where id=$id");
        
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }
}
    
