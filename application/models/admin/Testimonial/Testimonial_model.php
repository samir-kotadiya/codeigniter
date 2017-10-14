<?php

class Testimonial_model extends MY_Model
{

    public function __construct()
    {


        $this->table = 'ci_testimonials';
     
    }

    public function getTestimonials($start, $limit)
    {
        $sorting = $this->session->userdata('testimonial_sorting');
   
        if (! empty($sorting)) {
            $sortquery = "ORDER BY {$sorting['order']} {$sorting['dir']}";
        } else {
            $sortquery = 'ORDER BY id ASC ';
        }

        $query = $this->db->query("SELECT t.*,u.username as created_by 
                    FROM ci_testimonials as t 
                    INNER JOIN ci_users as u ON u.id=t.user_id
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
            FROM ci_testimonials
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
                $this->db->update('ci_testimonials', $data);
                $id = $data['id'];
            } else {
                $this->db->set('created', 'NOW()', FALSE);
                $this->db->insert('ci_testimonials', $data);
                $id = $this->db->insert_id();
            }
            return (isset($id)) ? $id : FALSE;
        } else {
            return false;
        }
    }
    public function getTestimonial($id)
    {
        $query = $this->db->query("select * from ci_testimonials where id=$id");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }
    function getusers()
    {
        $return = array();
        $sql = "SELECT u.username,u.id
                FROM  ci_employers as e 
                   LEFT JOIN ci_users as u ON u.id=e.user_id
                    WHERE u.published=1";
        
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $return = $query->result_array();
        }
        return $return;
    
    }
    
    

    


    //category

}
    
