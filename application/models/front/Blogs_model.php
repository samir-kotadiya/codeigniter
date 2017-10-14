<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blogs_model extends MY_Model
{

    public function getBlogs()
    {
        $query = $this->db->query("select b.*,u.username as Created_By from ci_blogs b,ci_users u where b.created_by=u.id and b.published=1 ORDER BY b.id DESC");
        return $query->result_array();
    }

    public function getBlog($id)
    {
        $query = $this->db->query("select b.*,u.username as Created_By from ci_blogs b,ci_users u where b.id=$id and b.created_by=u.id and b.published=1");
        return $query->row_array();
    }
}