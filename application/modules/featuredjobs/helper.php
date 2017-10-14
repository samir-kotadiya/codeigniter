<?php
defined('BASEPATH') or exit('No direct script access allowed');

function getFeaturedJob($limit)
{
    $CIHelper = get_instance();
    $CIHelper->load->database();
    $query = $CIHelper->db->query("SELECT j.*,c.name as cityname,jt.title as jobtype,e.company,e.logo
                FROM ci_jobs as j 
                LEFT JOIN ci_cities as c ON c.id=j.city
                LEFT JOIN ci_job_types as jt ON jt.id=j.job_type_id  
                LEFT JOIN ci_employers as e ON j.created_by=e.user_id                 
                WHERE j.published=1 and featured=1
                LIMIT $limit
            ");
    
    if ($query->num_rows() > 0) {
        return $query->result_array();
    } else {
        return array();
    }
}