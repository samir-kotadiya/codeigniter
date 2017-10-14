<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FeaturedJobsModule extends CI_Modules
{

    public function html($args = array())
    {
        require_once (APPPATH . 'modules/featuredjobs/helper.php');
        $CI = get_instance();
        $CI->lang->load("jobs", $CI->language);
        $this->data['title'] = $CI->lang->line('featured_jobs_title');
        $this->data['show'] = $CI->lang->line('show');
        $CI->load->helper('text');
        $limit = 4;
        $data = getFeaturedJob($limit);
        
        foreach ($data as $key => $value) {
            
            $image = getResizeImage($value['logo'], array(
                'width' => 250,
                'height' => 250
            ));
            $image_properties = array(
                'src' => $image,
                'width' => '300',
                'height' => '180',
                'rel' => 'lightbox'
            );
            $data[$key]['description'] = word_limiter($value['description'], 50);
            $data[$key]['logo'] = img($image_properties);
            $data[$key]['link'] = site_url('jobs/job/view/id/' . $value['id']);
        }
        
        $this->data['featuredjobs'] = $data;
        
        $this->module = 'featuredjobs';
    }
}