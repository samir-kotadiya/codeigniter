<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{

    public function login($username, $password)
    {
        $this->load->database();
        $this->db->select('id, username,group_id');
        $this->db->from('ci_users');
        $this->db->where('username', $username);
        $this->db->where('password', MD5($password));
        // $this->db->where('group_id', 1);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }
}