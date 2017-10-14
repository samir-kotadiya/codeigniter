<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Load javascripts and stylesheets for form elements and validators
 *
 * @return true and load all files(javascript and stylesheets) 
 */
if (! function_exists('loadFormHelpers')) {

	function loadFormHelpers()
	{
		$CIHelper = get_instance();
		$CIHelper->addScript('jquery.bootstrap.wizard.min.js');
		$CIHelper->addScript('formValidation.min.js');
		$CIHelper->addScript('tinymce.min.js');
		$CIHelper->addScript('bootstrap-tagsinput.min.js');
		$CIHelper->addScript('moment.min.js');
		$CIHelper->addScript('bootstrap-datetimepicker.min.js');
		
		$CIHelper->addCss('formValidation.min.css');
		$CIHelper->addCss('bootstrap-tagsinput.css');
		$CIHelper->addCss('datepicker.css');
		$CIHelper->addCss('build.css');
		
		// Generate Captcha
		$CIHelper->load->helper('captcha');
		$values = array(
				'word' => '',
				'word_length' => 8,
				'img_path' => './application/images/',
				'img_url' => base_url() . 'application/images/',
				'font_path' => base_url() . 'system/fonts/texb.ttf',
				'img_width' => '150',
				'img_height' => 50,
				'expiration' => 3600
		);
		$CIHelper->captcha = create_captcha($values);
		
		$old_captcha_image = $CIHelper->session->userdata('captcha_image');
		if (isset($old_captcha_image) and file_exists(APPPATH . '/images/' . $old_captcha_image)) {
            unlink(APPPATH . '/images/' . $old_captcha_image);
        }
		
        $CIHelper->session->set_userdata('captcha', $CIHelper->captcha['word']);
		$CIHelper->session->set_userdata('captcha_image', $CIHelper->captcha['filename']);
		return true;
	}
}

/**
 * return all countries from countries table as array
 *
 * @return array $imagepath
 */
if (! function_exists('getCounties')) {

    function getCounties()
    {
        $CIHelper = get_instance();
        $CIHelper->load->database();
        $query = $CIHelper->db->query("SELECT * FROM ci_countries");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
}

/**
 * return all states from state table as array
 *
 * @return array $imagepath
 */
if (! function_exists('getState')) {

    function getState()
    {
        $CIHelper = get_instance();
        $CIHelper->load->database();
        $query = $CIHelper->db->query("SELECT * FROM ci_states");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
}

/**
 * return all cities from city table as array
 *
 * @return array $imagepath
 */
if (! function_exists('getCity')) {

    function getCity()
    {
        $CIHelper = get_instance();
        $CIHelper->load->database();
        $query = $CIHelper->db->query("SELECT * FROM ci_cities");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
}

/**
 * Resize image with given width,height in resize folder,
 * if not given default will be there.
 *
 *
 * @param string $path            
 * @param array $inputconfig
 *            (width,height)
 *            
 * @return string $imagepath
 */
if (! function_exists('getResizeImage')) {

    function getResizeImage($path, $inputconfig = array())
    {
        $path = APPPATH . $path;
        if (@getimagesize($path) === false) {
            $path = APPPATH . 'images/img-not-found.png';
        }
        $brokenpath = explode(DIRECTORY_SEPARATOR, $path);
        $imageinfo = pathinfo($path);
        
        $originalimageinfo = (@getimagesize($path));
        
        // Prepare config for resize image with given width,height
        $config = array();
        $config['image_library'] = 'GD2';
        $config['source_image'] = $path;
        $config['create_thumb'] = false;
        $config['quality'] = '100%';
        $config['maintain_ratio'] = (isset($inputconfig['ratio'])) ? $inputconfig['ratio'] : true;
        $config['width'] = (isset($inputconfig['width'])) ? $inputconfig['width'] : $originalimageinfo[0];
        $config['height'] = (isset($inputconfig['height'])) ? $inputconfig['height'] : $originalimageinfo[1];
        $config['new_image'] = APPPATH . 'images/resize/' . $imageinfo['filename'] . "_" . $config['width'] . "_" . $config['height'] . "." . $imageinfo['extension'];
        
        // Create instance of framework
        $CIHelper = get_instance();
        
        // Return image uri path if image already exist with given width height. Time to take tea.
        if (@getimagesize($config['new_image']) !== false) {
            return $CIHelper->config->site_url(str_replace(APPPATH, 'application/', $config['new_image']));
        }
        
        // Finally resize image.
        $CIHelper->load->library('image_lib', $config);
        $CIHelper->image_lib->initialize($config);
        $imageresized = $CIHelper->image_lib->resize();
        
        // Return image path
        if ($imageresized) {
            return $CIHelper->config->site_url(str_replace(APPPATH, 'application/', $config['new_image']));
        } else {
            return '';
        }
    }
}

if (! function_exists('getUser')) {

    function getUser($application = 'site')
    {
        $user = new stdClass();
        $user->id = 0;
        $session = null;
        // Create instance of framework
        $CIHelper = get_instance();
        if ($application == 'site') {
            if (isset($CIHelper->session->userdata['user'])) {
                $session = $CIHelper->session->userdata['user'];
            }
        } else {
            $session = $CIHelper->session->userdata;
        }
        
        if (isset($session['userid'])) {
            $CIHelper->load->database();
            $query = $CIHelper->db->query("SELECT * FROM ci_users
                WHERE id={$session['userid']}
            ");
            
            if ($query->num_rows() > 0) {
                $userresult = $query->row_array();
                
                $user->id = $userresult['id'];
                $user->username = $userresult['username'];
                $user->email = $userresult['email'];
                $user->group_id = $userresult['group_id'];
                
                if ($userresult['group_id'] == 2) {
                    $queryagain = $CIHelper->db->query("SELECT * FROM ci_employers WHERE user_id={$userresult['id']}");
                    $employerresult = $queryagain->row_array();
                    $user->firstname = $employerresult['firstname'];
                    $user->lastname = $employerresult['lastname'];
                } else 
                    if ($userresult['group_id'] == 3) {
                        $queryagain = $CIHelper->db->query("SELECT * FROM ci_jobseekers WHERE user_id={$userresult['id']}");
                        $jobseekerresult = $queryagain->row_array();
                        
                        $user->firstname = $jobseekerresult['firstname'];
                        $user->lastname = $jobseekerresult['lastname'];
                    } else {
                        // No jobseeker or employer
                    }
            }
        } else {
            // User not loged in
        }
        return $user;
    }
}

if (! function_exists('sendMail')) {

    function sendMail($to,$subject,$message,$headers)
    {  
        mail($to,$subject,$message,$headers);
    }
}

if (! function_exists('uploadfile')) {

    function uploadfile($field = '')
    {  
    	if($field == ''){
    		return false;
    	}
    	
    	$CIHelper = get_instance();
    	$new_name = time().'_'.$_FILES[$field]['name'];
    	
    	$config['file_name'] = $new_name;
    	$config['upload_path'] = APPPATH . 'images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '100055';
        $config['max_width'] = '10245';
        $config['max_height'] = '70685';
        $CIHelper->load->library('upload', $config);
        if(!$CIHelper->upload->do_upload($field)){
        	return false;
        }
        
        $image_properity = $CIHelper->upload->data();
        $image = "images" . "/" . $image_properity['file_name'];
        return $image;
    }
}

if (! function_exists('setExternalUrl')) {

	function setExternalUrl($url = '')
	{
		if($url == ''){
			return '';
		}
		
		//if(strpos($url, "http://") !== false);
		$urlarray = parse_url($url);
		if(!in_array("http", $urlarray)) {
			$url = 'http://'.$url;
		}
		
		return $url;
	}
}


if (! function_exists('pagination_segments')) {

    function pagination_segments($url = '')
    {
        $CI =& get_instance();

        $url = $CI->config->site_url($CI->uri->uri_string());

        $linkssegment = $_GET;
        unset($linkssegment['page']);
        $returnlink = http_build_query($linkssegment, '', '&amp;');
        
        return $returnlink ? $url.'?'.$returnlink : $url;
    }
}
