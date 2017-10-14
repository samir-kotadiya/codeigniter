<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Miscellaneous_model extends CI_Model
{

    public function savenewsletter($data)
    {
        $this->load->database();
        $this->db->insert('ci_newsletter', $data);
        return true;
    }
}