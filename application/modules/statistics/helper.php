<?php
defined('BASEPATH') or exit('No direct script access allowed');

function gettotaljob($CI)
{
    $CI->load->database();
    $query = $CI->db->query("SELECT * FROM ci_jobs where published = 1");
    
    if ($query->num_rows() > 0) {
        return $query->num_rows();
    } else {
        return 0;
    }
}

function gettotalemployee($CI)
{
    $CI->load->database();
    $query = $CI->db->query("SELECT e.*,u.* 
                    FROM ci_employers  as e 
                    INNER JOIN ci_users as u ON u.id=e.user_id 
                    where u.published=1");
    
    if ($query->num_rows() > 0) {
        return $query->num_rows();
    } else {
        return 0;
    }
}

function gettotaljobseeker($CI)
{
    $CI->load->database();
    $query = $CI->db->query("SELECT j.*,u.*    
                    FROM ci_jobseekers  as j
                    LEFT JOIN ci_users as u ON u.id=j.user_id 
                    where u.published=1");
    
    if ($query->num_rows() > 0) {
        return $query->num_rows();
    } else {
        return 0;
    }
}


