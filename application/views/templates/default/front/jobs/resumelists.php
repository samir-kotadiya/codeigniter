<?php //echo '<pre>';print_r($jobs);exit; ?>
<form id="frontForm" method="post">
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

<div class="col-md-12 joblist_main_container">
  <div class="back_btn">
          <div class="myprofile">
            <a class="btn" href="<?php echo base_url("users/dashboard/account")?>"><i class="fa fa-backward"></i>&nbsp; back </a>
          </div>
      </div>
  <div id="joblists" class="joblists-container">
  	 <?php foreach ($jobs as $key=>$job) { ?>
    <div id="joblists" class="joblists col-md-12">
      <div class="listing-title clearfix">
      	 <div class="col-md-4">
        
        	<div class="resumelist_ch_box">	
           <?php /* ?> <input type="checkbox" id="cb<?php echo $key+1; ?>" name="cid[]"
                value="<?php echo $job['id']; ?>" /><?php */ ?>
			</div>
      <?php

      ?>
			<div class="resumelist_title">
          		<h2><a href="<?php echo base_url('jobs/job/view/id/'.$job['Job_id'])?>"><?php echo $job['Job_title']; ?></a></h2>
          	</div>
      	</div>
		</div>
        <div class="joblistdetail clearfix col-md-12">
        <div class="listdiv col-md-4">
          <div class="listdiv joblistdetail-company col-md-12 clearfix">
            <div class="jobcaption col-md-6"> <span class="jobdetail-field-caption"> Firstname: </span> </div>
            <div class="job_detail_val col-md-6"> <span class="jobdetail-field-value"><a href="<?php echo base_url('jobs/resume/view/id/'.$job['user_id'])?>"> <?php echo $job['firstname']; ?></a> </span> </div>
          </div>
          <div class="listdiv joblistdetail-category col-md-12 clearfix">
            <div class="jobcaption col-md-6"> <span class="jobdetail-field-caption"> Lastname: </span> </div>
            <div class="job_detail_val col-md-6"> <span class="jobdetail-field-value"> <?php echo $job['lastname']; ?> </span> </div>
          </div>
          <div class="listdiv joblistdetail-type col-md-12 clearfix">
            <div class="jobcaption col-md-6"> <span class="jobdetail-field-caption"> Resume: </span> </div>
            <div class="job_detail_val col-md-6"> <span class="jobdetail-field-value"> <?php echo $job['resume']; ?> </span> </div>
          </div>
         
        </div>
       
      </div>
    </div>
   
     
      <?php
  }
      ?>
  </div>
</div>
  <input type="hidden" name="frmaction" value="<?php echo site_url('jobs/Resumelists/'); ?>" />
</form>