<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LatestNewsModule extends CI_Modules
{

    public function html($args = array())
    {
        require_once (APPPATH . 'modules/latestnews/helper.php');
        $CI = get_instance();
        $CI->lang->load("blogs", $CI->language);
        $CI->load->helper('text');
        /**/
        $this->data['title'] = $CI->lang->line('title');
        $this->data['message'] = $CI->lang->line('message');
        $limit=3;
        $data = getLatestNews($limit);
         foreach ($data as $key => $value) {
            
            $image = getResizeImage($value['image']);
            $image_properties = array(
                'src' => $image,
                'width' => '300',
                'height' => '280',
                'rel' => 'lightbox',
             
            );
            $data[$key]['description'] = word_limiter($value['description'], 40);
            $date=date_create($value['created_date']);
            $data[$key]['images'] = img($image_properties);
            $data[$key]['created_date']=date_format($date, 'd-m-y');
            $data[$key]['link'] = site_url('blogs/blog/view/id/' . $value['id']);
        }


        $this->data['latestnews'] = $data;
        $this->module = 'LatestNews';
    }
}