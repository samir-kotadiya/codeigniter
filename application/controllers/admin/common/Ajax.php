<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax extends Front_Controller
{

    public function getstates()
    {
        $this->load->database();
        $country_id = $this->input->get('country_id');
        $query = $this->db->query("SELECT id,name FROM ci_states WHERE country_id='" . $country_id . "'");
        
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
        } else {
            $data = array();
        }
        
        $this->response($data);
    }

    public function getcities()
    {
        $this->load->database();
        $state_id = $this->input->get('state_id');
        $query = $this->db->query("SELECT id,name FROM ci_cities WHERE state_id='" . $state_id . "'");
        
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
        } else {
            $data = array();
        }
        
        $this->response($data);
    }

    public function validuser()
    {
        $this->load->database();
        $email = $this->input->post('email');
        $query = $this->db->query("SELECT email FROM ci_users WHERE email='" . $email . "'");
        
        $isAvailable = true;
        if ($query->num_rows() > 0) {
            $isAvailable = false;
        }
        
        $this->response(array(
            'valid' => $isAvailable
        ));
    }

    public function response($data = array())
    {
        echo json_encode($data);
    }
}