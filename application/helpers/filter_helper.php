<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (! function_exists('sorting_init')) {

    function sorting_init()
    {
        $CIHelper = get_instance();
        $postorder = $CIHelper->input->post('order');
        $postdirection = $CIHelper->input->post('direction');
        $sessionpage=$CIHelper->page.'_sorting';

        if($postorder != '' && $postdirection != ''){
            $CIHelper->session->set_userdata($sessionpage,array('order'=>$postorder,'dir'=>$postdirection));
        }
    }
}

if (! function_exists('sorting_link')) {

    function sorting_link($label,$field_id)
    {
        $CIHelper = get_instance();
        
        $field_id = strtolower($field_id);
        $filters = $CIHelper->session->userdata('filters');
        
        $inputorder = $field_id;
        $inputdirection = 'DESC';
        $inputicon = '';
        
        $sortingsession = $CIHelper->session->userdata($CIHelper->page.'_sorting');
         
        if($sortingsession['order'] == $field_id){
            $inputorder = $field_id;
            $inputdirection = ($sortingsession['dir'] == 'ASC')?'DESC':'ASC';;
            $inputicon = ($sortingsession['dir'] == 'ASC')?'fa-chevron-up':'fa-chevron-down';
        }

        echo '<div><a class="tool-column-order" data-order="'.$field_id.'" data-direction="'.$inputdirection.'" href="">'.$label.'</a><i class="fa '.$inputicon.'"></i></div>';
    }
}
