<?php

class Blogs_model extends MY_Model
{

    public function __construct()
    {


        $this->table = 'ci_blogs';
     
    }

    public function getBlogs($start, $limit)
    {
        $sorting = $this->session->userdata('blogs_sorting');
   
        if (! empty($sorting)) {
            $sortquery = "ORDER BY {$sorting['order']} {$sorting['dir']}";
        } else {
            $sortquery = 'ORDER BY id ASC ';
        }

        $query = $this->db->query("SELECT b.*,u.username as createdby 
                    FROM ci_blogs as b 
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
 function getCategory()
    {
        $CIHelper = get_instance();
        $CIHelper->load->database();
        $query = $CIHelper->db->query("SELECT id,title FROM ci_categories where published=1");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
    public function getCount()
    {
        $query = $this->db->query("SELECT count(*) as count
            FROM ci_blogs
        ");        
        $result = $query->result_array();
        return $result[0]['count'];
    }

    public function save($data = array())
    {
        if (! empty($data)) {            
            if ($data['id'] > 0) {
                // Set proper data
                $data['published'] = isset($data['published']) ? 1 : 0;
                // Store data
                $this->db->where('id', $data['id']);
                $this->db->update('ci_blogs', $data);
                $id = $data['id'];
            } else {
                $this->db->set('created_date', 'NOW()', FALSE);
                $this->db->insert('ci_blogs', $data);
                $id = $this->db->insert_id();
            }
            return (isset($id)) ? $id : FALSE;
        } else {
            return false;
        }
    }

    public function getBlog($id)
    {
        $query = $this->db->query("select * from ci_blogs where id=$id");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }


    //category

}
    
