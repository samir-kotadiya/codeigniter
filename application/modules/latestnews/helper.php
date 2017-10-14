<?php
defined('BASEPATH') or exit('No direct script access allowed');

function getLatestNews($limit)
{
    $CIHelper = get_instance();
    $CIHelper->load->database();
    $query = $CIHelper->db->query("SELECT *
                FROM ci_blogs 
                WHERE published=1
                ORDER BY id DESC
                LIMIT $limit
            ");
    
    if ($query->num_rows() > 0) {
        return $query->result_array();
    } else {
        return array();
    }
}