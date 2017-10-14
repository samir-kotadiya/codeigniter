<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SliderModule extends CI_Modules
{

    public function html($args = array())
    {
        $this->module = 'Slider';
        
        $this->data['slides'] = array(
            'application/views/assets/images/slider1.jpg',
            'application/views/assets/images/slider2.jpg'
        );
        
        $this->addScript('jquery.bxslider.js');
        $this->addCss('jquery.bxslider.css');
    }
}