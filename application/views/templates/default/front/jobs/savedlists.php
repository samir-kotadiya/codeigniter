<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<form id="frontForm" action="<?php echo site_url('jobs/lists'); ?>">

<div class="col-sm-12 joblist_main_container">
  <div class="back_btn">
          <div class="myprofile">
       <a class="btn" href="<?php echo base_url("users/dashboard/account")?>"><i class="fa fa-backward"></i>&nbsp; back </a>
          </div>
      </div>
  <div id="joblists" class="joblists-container">
    <?php foreach ($jobs as $job) { ?>
    <div class="joblists col-sm-12">
      <div class="listing-title clearfix">
        <div class="col-sm-4"> <a href="<?php echo $job['link']; ?>">
          <h2><?php echo $job['title']; ?></h2>
          </a> </div>
      </div>
      <div class="joblistdetail clearfix col-sm-12">
        <div class="listdiv col-sm-4 clearfix">
          <div class="listdiv joblistdetail-company col-sm-12">
            <div class="jobcaption col-sm-6"> <span class="jobdetail-field-caption"> Company: </span> </div>
            <div class="job_detail_val col-sm-6"> <span class="jobdetail-field-value"> <?php echo $job['company']; ?> </span> </div>
          </div>
          <div class="listdiv joblistdetail-category col-sm-12">
            <div class="jobcaption col-sm-6"> <span class="jobdetail-field-caption"> Category: </span> </div>
            <div class="job_detail_val col-sm-6"> <span class="jobdetail-field-value"> <?php echo $job['titlecategory']; ?> </span> </div>
          </div>
          <div class="listdiv joblistdetail-type col-sm-12">
            <div class="jobcaption col-sm-6"> <span class="jobdetail-field-caption"> Type: </span> </div>
            <div class="job_detail_val col-sm-6"> <span class="jobdetail-field-value"> <?php echo $job['titletype']; ?> </span> </div>
          </div>
          <div class="listdiv joblistdetail-location col-sm-12">
            <div class="jobcaption col-sm-6"> <span class="jobdetail-field-caption"> Location: </span> </div>
            <div class="job_detail_val col-sm-6"> <span class="jobdetail-field-value"> <?php echo $job['city_name']; ?> <?php echo $job['state_name']; ?>,<?php echo $job['country_name']; ?> </span> </div>
          </div>
          <div class="listdiv joblistdetail-tag col-sm-12">
            <div class="jobcaption col-sm-6"> <span class="jobdetail-field-caption"> Tags: </span> </div>
            <div class="job_detail_val col-sm-6"> <span class="jobdetail-field-value">
              <?php $tags = array(); ?>
              <?php foreach ($job['tags'] as $tag){
                                $tags[] = '<a href="'.site_url('jobs/lists?tag='.$tag).'">'.$tag.'</a>';
                            } ?>
              <?php echo implode(',', $tags); ?> </span> </div>
          </div>
        </div>
        <div class="listdiv joblistdetail-description col-sm-8 clearfix">
          <div class="listdiv joblistdetail-company-logo"> <img width="150" height="150" alt="<?php echo $job['company']; ?>" src="<?php echo $job['company_logo']; ?>"> </div>
          <?php echo $job['sort_description']; ?> </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>

</form>
<script>
jQuery(document).ready(function(){
	jQuery(".radiochange").change(function(){
		console.log(this);
		jQuery("#frontForm").submit();
	});

	jQuery(".checkboxchange").change(function(){
		console.log(this);
		jQuery("#frontForm").submit();
	});
});
</script>
