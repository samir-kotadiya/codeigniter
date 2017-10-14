<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php //echo '<pre>';print_r($resumes);echo '</pre>'; ?>

<div class="wrapper">
    <div class="row">
        <div class="back_btn col-sm-12">
          <div class="myprofile">
             <a class="btn" href="<?php echo base_url("users/dashboard/account")?>"><i class="fa fa-backward"></i>&nbsp; back </a>
          </div>
      </div>
        <div class="col-md-12">
            <?php $this->load->view('templates/default/front/common/form'); ?>
        </div>
    </div>
</div>
