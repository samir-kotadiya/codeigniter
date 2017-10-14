<?php
defined('BASEPATH') or exit('No direct script access allowed');

class contact_model extends CI_Model
{

    function save($data)
    {

        $this->load->database();
        $values = array(
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_no' => $data['phone_no'],
            'message' => $data['message']
        );
        $this->db->insert('ci_contact', $values);
        return true;
    }
}

?>
