<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NewsletterModule extends CI_Modules
{

    public function html($args = array())
    {
        $this->addScript('formValidation.min.js');
        $this->module = 'Newsletter';
        $this->data['url'] = site_url('/common/Miscellaneous/newsletter');
    }
}