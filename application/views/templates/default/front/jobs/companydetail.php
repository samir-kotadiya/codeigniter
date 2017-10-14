<?php //echo"<pre>";print_r($jobs);exit(); ?>
<div class="col-md-12 company-detail-page">
	<div class="jobdetail-company-info">
		<div class="description-heading"><?php echo $lbl_company_info; ?></div>
		<div class="jb_company_logo"><img src="<?php echo $company['company_logo']; ?>" alt="" /></div>
		<div class="jb_comp_title"><h3><?php echo $company['company']; ?></h3></div>
		<div class="jb_phn col-md-12">
		<div class="col-md-1">
		<b><?php echo $lbl_phone; ?> </b> </div>
		<div class="col-md-11">
		<?php echo $company['workphone']; ?>
		</div>
		
		</div>
		<div class="jb_comp_website col-md-12">
		<div class="col-md-1">
		<b><?php echo $lbl_website; ?> </b>
		</div>
		<div class="col-md-11">
		 <a target="_blank" href="<?php echo setExternalUrl($company['website']); ?>"><?php echo $company['website']; ?></a>
		</div>
		 </div>
	</div>

	<div class="companies-jobs">
		<h1><?php echo $lbl_jobs; ?></h1>
		<div class="col-md-12 joblist_main_container">
		  <div id="joblists" class="joblists-container">
		    <?php foreach ($jobs as $job) { ?>
		    <div class="joblists col-md-12">
		      <div class="listing-title clearfix">
		        <div class="col-md-4"> <a href="<?php echo $job['link']; ?>">
		          <h2><?php echo $job['title']; ?></h2>
		          </a> </div>
		      </div>
		      <div class="joblistdetail clearfix col-md-12">
		        <div class="listdiv col-md-4">
		          <div class="listdiv joblistdetail-company col-md-12">
		            <div class="jobcaption col-md-6"> <span class="jobdetail-field-caption"><?php echo $lbl_company; ?> </span> </div>
		            <div class="job_detail_val col-md-6"> <span class="jobdetail-field-value"> <?php echo $job['company']; ?> </span> </div>
		          </div>
		          <div class="listdiv joblistdetail-category col-md-12">
		            <div class="jobcaption col-md-6"> <span class="jobdetail-field-caption"><?php echo $lbl_category; ?> </span> </div>
		            <div class="jobcaption col-md-6"> <span class="jobdetail-field-value"> <?php echo $job['titlecategory']; ?> </span> </div>
		          </div>
		          <div class="listdiv joblistdetail-type col-md-12">
		            <div class="jobcaption col-md-6"> <span class="jobdetail-field-caption"> <?php echo $lbl_type; ?>  </span> </div>
		            <div class="jobcaption col-md-6"> <span class="jobdetail-field-value"> <?php echo $job['titletype']; ?> </span> </div>
		          </div>
		          <div class="listdiv joblistdetail-location col-md-12">
		            <div class="jobcaption col-md-6"> <span class="jobdetail-field-caption"><?php echo $lbl_location; ?>  </span> </div>
		            <div class="jobcaption col-md-6"> <span class="jobdetail-field-value"> <?php echo $job['city_name']; ?> <?php echo $job['state_name']; ?>,<?php echo $job['country_name']; ?> </span> </div>
		          </div>
		          <div class="listdiv joblistdetail-tag col-md-12">
		            <div class="jobcaption col-md-6"> <span class="jobdetail-field-caption"> <?php echo $lbl_tags; ?>  </span> </div>
		            <div class="jobcaption col-md-6"> <span class="jobdetail-field-value">
		              <?php $tags = array(); ?>
		              <?php foreach ($job['tags'] as $tag){
		                                $tags[] = '<a href="'.site_url('jobs/lists?tag='.$tag).'">'.$tag.'</a>';
		                            } ?>
		              <?php echo implode(',', $tags); ?> </span> </div>
		          </div>
		        </div>
		        <div class="listdiv joblistdetail-description col-md-8 clearfix">
		          <div class="listdiv joblistdetail-company-logo"> <img width="150" height="150" alt="<?php echo $job['company']; ?>" src="<?php echo $job['company_logo']; ?>"> </div>
		          <?php echo $job['sort_description']; ?> </div>
		      </div>
		    </div>
		    <?php } ?>
		  </div>
		</div>
	</div>
</div>