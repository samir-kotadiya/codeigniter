<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php //echo '<pre>';print_r($resumes);echo '</pre>'; ?>

<form id="frontForm">

<?php foreach ($companies as $key=>$company){ ?>
<div class="col-md-12" style="border:2px #E77852 dotted;">
	<div class="col-md-12">
		<b><a href="<?php echo base_url('jobs/company/view/id/'.$company['user_id'])?>"><?php echo $company['company']; ?></a></b>
	</div>
	<div class="col-md-12">
		<div class="col-md-1">Location:</div>
		<div class="col-md-11"><?php echo $company['location']; ?></div>
	</div>
	<div class="col-md-12">
		<div class="col-md-1">Phone:</div>
		<div class="col-md-11"><?php echo $company['workphone']; ?></div>
	</div>
	<div class="col-md-12">
		<div class="col-md-1">Website:</div>
		<div class="col-md-11"><a target="_blank" href="<?php echo setExternalUrl($company['website']); ?>"><?php echo $company['website']; ?></a></div>
	</div>
</div>
<?php } ?>
<input type="hidden" name="frmaction" value="<?php echo site_url('jobs/Resumelists/'); ?>" />
</form>