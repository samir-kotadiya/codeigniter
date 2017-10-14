<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php //echo '<pre>';print_r($resumes);echo '</pre>'; ?>

<form id="frontForm" class="saved_resume">
  <div class="back_btn">
    <div class="myprofile"> <a class="btn" href="<?php echo base_url("users/dashboard/account")?>"><i class="fa fa-backward"></i>&nbsp; back </a> </div>
  </div>
  <?php foreach ($resumes as $key=>$resume){ ?>
  <div id="joblists" class="joblists col-sm-12">
    <div class="listing-title clearfix">
      <div class="col-sm-4">
        <?php /*?><input type="checkbox" id="cb<?php echo $key+1; ?>" name="cid[]" value="<?php echo $resume['user_id']; ?>" /><?php */ ?>
        <div class="resumelist_title">
          <h2> <a href="<?php echo base_url('jobs/resume/view/id/'.$resume['user_id'])?>"><?php echo $resume['firstname'].' '.$resume['lastname']; ?></a> </h2>
        </div>
      </div>
    </div>
    <div class="col-sm-12">
      <div class="col-sm-1">Location:</div>
      <div class="col-sm-11"><?php echo $resume['location']; ?></div>
    </div>
    <div class="col-sm-12">
      <div class="col-sm-1">Phone:</div>
      <div class="col-sm-11"><?php echo $resume['workphone']; ?></div>
    </div>
    <div class="col-sm-12">
      <div class="col-sm-1">Posted:</div>
      <div class="col-sm-11"><?php echo $resume['created_date']; ?></div>
    </div>
  </div>
  <?php } ?>
  <input type="hidden" name="frmaction" value="<?php echo site_url('jobs/Resumelists/'); ?>" />
</form>
