<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<form id="frontForm" action="<?php echo site_url('jobs/lists'); ?>">
<div class="col-md-3 joblist_left_col">
  <!-- job search -->
  <div class="col-md-12 jobsearch_mod left_mod">
    <h2>Jobs Search</h2>
    <div class="col-md-12 job_search_mod_form">
        <input type="text" name="keyword" placeholder="keyword" value="<?php echo $filters['keywork']; ?>" />
        <input type="text" name="skill" placeholder="skill" value="<?php echo $filters['skill']; ?>" />
        <input type="text" name="address" placeholder="City,State or Country" value="<?php echo $filters['address']; ?>" />
        <input type="submit" value="Search" class="btn btn_submit" />
    </div>
  </div>
  <!-- End of job search-->
  
  <!-- Salary/income -->
  <div class="col-md-12 salary_income left_mod">
    <h2>Salary/Income </h2>
    <div class="col-md-12 job_search_mod_form">
      <form>
        <input type="text" name="currency" placeholder="$" value="<?php echo $filters['currency']; ?>" />
        <div class="radio_btn">
          <?php
          foreach ($salarys as $key=>$value) {
			$checked = ($filters['salary_picker']==$value)?'checked="checked"':'';
            ?>
            <input type="radio" <?php echo $checked; ?> class="radiochange" name="salary_picker" value="<?php echo $value; ?>" id="salary_<?php echo strtolower($key); ?>">
            <label for="salary_<?php echo strtolower($key); ?>"><?php echo $key; ?></label>
            <br />
            <?php
          }
          ?>
        </div>
    </div>
  </div>
  <!-- End of Salary/income -->
  
  <!-- Posted -->
  <div class="col-md-12 posted left_mod">
    <h2>Posted</h2>
    <div class="col-md-12 job_search_mod_form">
      <div class="radio_btn">
          <?php
            foreach ($posteddate as $key => $value) {
			  $checked = ($filters['posted_picker']==$value)?'checked="checked"':'';
              ?>
              <div class="col-md-6">
                <input type="radio" <?php echo $checked; ?> class="radiochange" name="posted_picker" value="<?php echo $value; ?>" id="posted_<?php echo strtolower($key); ?>">
                <label for="posted_<?php echo strtolower($key); ?>"><?php echo $key; ?></label>
              </div>
              <?php
            }
          ?>
        </div>
    </div>
  </div>
  <!-- End of Posted -->
  
   <!-- Employment Type -->
	  <div class="col-md-12 emp_type left_mod">
    <h2>Employment Type</h2>
    <div class="col-md-12 job_search_mod_form">
      <div class="checkbox">
          <?php
          foreach ($types as $key => $value) {
			$checked = '';
			if(!empty($filters['employmenttype_picker'])){
				$checked = (in_array($value, $filters['employmenttype_picker']))?'checked="checked"':'';
			}
            ?>
            <input type="checkbox" <?php echo $checked; ?> class="checkboxchange" id="employment_<?php echo strtolower($key); ?>" name="employmenttype_picker[]" value="<?php echo $value; ?>">
            <label for="employment_<?php echo strtolower($key); ?>"><?php echo $key; ?></label>
            <br>
            <?php  
          }
          ?>
         </div>
    </div>
  </div>
  <!-- End of Employment -->

  <!-- Career Level -->
 	 <div class="col-md-12 career_level left_mod">
    <h2>Career Level </h2>
    <div class="col-md-12 job_search_mod_form">
      <div class="radio_btn careerradio_check">
          <?php
          foreach ($careeres as $key => $value) {
			$checked = ($filters['career_picker']==$value)?'checked="checked"':'';
            ?>
            <input type="radio" <?php echo $checked; ?> class="radiochange" name="career_picker" value="<?php echo $value; ?>" id="career_<?php echo strtolower($key); ?>">
            <label for="career_<?php echo strtolower($key); ?>"><?php echo $key; ?></label>
            <br />
            <?php
          }
          ?>
        </div>
    </div>
  </div>
  <!-- End of Career Level -->
  
  <!-- Distance -->
  <?php if(getUser()->id != 0){ ?>
  	<div class="col-md-12 distance left_mod">
    <h2>Distance</h2>
    <div class="col-md-12 job_search_mod_form">
      <div class="radio_btn">
          <?php
          foreach ($distance as $key => $value) {
			$checked = ($filters['distance_picker']==$value)?'checked="checked"':'';
            ?>
            <div class="col-md-6">
              <input type="radio" <?php echo $checked; ?> class="radiochange" name="distance_picker" value="<?php echo $value; ?>" id="distance_<?php echo strtolower($key); ?>">
              <label for="distance_<?php echo strtolower($key); ?>"><?php echo $key; ?></label>
            </div>
            <?php
          }
          ?>
        </div>
    </div>
  </div>
  <?php } ?>
  <!-- End of Distance -->
  
</div>
<div class="col-md-9 joblist_main_container">
  <div id="joblists" class="joblists-container">
    <?php foreach ($jobs as $job) { ?>
    <div class="joblists col-md-12">
      <div class="listing-title clearfix">
        <div class="col-md-4"> <a href="<?php echo $job['link']; ?>">
          <h2><?php echo $job['title']; ?></h2>
          </a> </div>
      </div>
      <div class="joblistdetail clearfix col-md-12">
        <div class="listdiv col-md-4 clearfix">
          <div class="listdiv joblistdetail-company col-md-12">
            <div class="jobcaption col-md-6"> <span class="jobdetail-field-caption"> Company: </span> </div>
            <div class="job_detail_val col-md-6"> <span class="jobdetail-field-value"> <?php echo $job['company']; ?> </span> </div>
          </div>
          <div class="listdiv joblistdetail-category col-md-12">
            <div class="jobcaption col-md-6"> <span class="jobdetail-field-caption"> Category: </span> </div>
            <div class="job_detail_val col-md-6"> <span class="jobdetail-field-value"> <?php echo $job['titlecategory']; ?> </span> </div>
          </div>
          <div class="listdiv joblistdetail-type col-md-12">
            <div class="jobcaption col-md-6"> <span class="jobdetail-field-caption"> Type: </span> </div>
            <div class="job_detail_val col-md-6"> <span class="jobdetail-field-value"> <?php echo $job['titletype']; ?> </span> </div>
          </div>
          <div class="listdiv joblistdetail-location col-md-12">
            <div class="jobcaption col-md-6"> <span class="jobdetail-field-caption"> Location: </span> </div>
            <div class="job_detail_val col-md-6"> <span class="jobdetail-field-value"> <?php echo $job['city_name']; ?> <?php echo $job['state_name']; ?>,<?php echo $job['country_name']; ?> </span> </div>
          </div>
          <div class="listdiv joblistdetail-tag col-md-12">
            <div class="jobcaption col-md-6"> <span class="jobdetail-field-caption"> Tags: </span> </div>
            <div class="job_detail_val col-md-6"> <span class="jobdetail-field-value">
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

<div class="pagination col-md-9 pull-right ">
	<?php echo $this->pagination->create_links(); ?>
</div>

<div class="savesearchdiv">
	<a class="btn" href="#" onclick="return savesearch();">Save this search</a>
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
