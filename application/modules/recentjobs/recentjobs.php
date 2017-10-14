<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RecentJobsModule extends CI_Modules
{

    public function html($args = array())
    {
        require_once (APPPATH . 'modules/recentjobs/helper.php');
        $CI = get_instance();
        $CI->lang->load("jobs", $CI->language);
        $this->data['title'] = $CI->lang->line('recent_jobs_title');
        $this->data['show'] = $CI->lang->line('show');
        $CI->load->helper('text');
        $limit = 4;
        $data = getRecentJob($limit);
        
        foreach ($data as $key => $value) {
            
            $image = getResizeImage($value['logo'], array(
                'width' => 80,
                'height' => 80
            ));
            $image_properties = array(
                'src' => $image,
                'width' => '80',
                'height' => '80',
                'rel' => 'lightbox',
                'class' => 'img-circle'
            );
            $data[$key]['logo'] = img($image_properties);
            $data[$key]['link'] = base_url('/jobs/job/view/id/' . $value['id']);
        }
        $this->data['btnurl'] = base_url('/jobs/lists');
        $this->data['recentjobs'] = $data;
        $this->module = 'RecentJobs';
    }
}