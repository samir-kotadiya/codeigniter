<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php //echo '<pre>';print_r($resumes);echo '</pre>'; ?>

<form id="frontForm" class="resumes_main_list">

<?php /* ?>
<div class="col-md-12 align-right">
  <div class="pull-left">
       <input type="checkbox" onclick="CIForm.checkall(this);" /> 
  </div>
  <div class="pull-right">
	<button class="btn" onclick="return CIForm.actions('delete');">
		Delete
	</button>
  </div>
</div>
<?php */ ?>

<?php foreach ($resumes as $key=>$resume){ ?>
<div id="joblists" class="joblists col-md-12"">
	<div class="listing-title clearfix">
      <div class="col-md-4">
	    <div class="resumelist_title">
		<?php /*?><input type="checkbox" id="cb<?php echo $key+1; ?>" name="cid[]" value="<?php echo $resume['user_id']; ?>" /><?php */ ?>
		<h2><a href="<?php echo base_url('jobs/resume/view/id/'.$resume['user_id'])?>"><?php echo $resume['firstname'].' '.$resume['lastname']; ?></a></h2>
		</div>
	</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-1">Location:</div>
		<div class="col-md-11"><?php echo $resume['location']; ?></div>
	</div>
	<div class="col-md-12">
		<div class="col-md-1">Phone:</div>
		<div class="col-md-11"><?php echo $resume['workphone']; ?></div>
	</div>
	<div class="col-md-12">
		<div class="col-md-1">Posted:</div>
		<div class="col-md-11"><?php echo $resume['created_date']; ?></div>
	</div>
</div>
<?php } ?>
<input type="hidden" name="frmaction" value="<?php echo site_url('jobs/Resumelists/'); ?>" />
</form>