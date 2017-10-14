<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StatisticsModule extends CI_Modules
{

    public function html($args = array())
    {
        require_once (APPPATH . 'modules/statistics/helper.php');
        $CI = get_instance();
        
        $CI->lang->load("common", $CI->language);
        $this->data['title'] = $CI->lang->line('title');
        $this->data['desc'] = $CI->lang->line('desc');
        $this->data['desc2'] = $CI->lang->line('desc2');
        $this->data['offers'] = $CI->lang->line('offers');
        $this->data['resume'] = $CI->lang->line('resume');
        $this->data['members'] = $CI->lang->line('members');
        $this->data['company'] = $CI->lang->line('company');
        $this->module = 'Statistics';
        $this->data['totaljobs'] = gettotaljob($CI);
        $this->data['totalemployes'] = gettotalemployee($CI);
        $this->data['totaljobseekers'] = gettotaljobseeker($CI);
        $this->data['totalmembers'] = ($this->data['totalemployes'] + $this->data['totaljobseekers']);
    }
}