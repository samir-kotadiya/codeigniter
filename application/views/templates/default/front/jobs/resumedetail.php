<?php $inc = 0; $user = getUser(); ?>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js"></script>
<div class="col-sm-12 jobslist_main_container hidden-print">
	<div id="messagestatus"></div>
  <div id="jobslists" class="jobslists-container resumedetailpage">
  	
    <div class="jobslists col-sm-12">
    	 <div class=" col-sm-12">

      <div class="listing-title clearfix">
      	 <div class="col-sm-4">
        
        <div class="resumelist_title">
          		<h2><?php echo $resume['firstname']; ?></h2>
          	</div>
			
      	</div>
		
      	<!-- Personal Details -->
        <div class="jobslistdetail clearfix col-sm-12"><center><h2>Personal Details</h2></center>
        <div class="listdiv col-sm-4">

          <div class="listdiv jobslistdetail-company col-sm-12">
            <div class="jobscaption col-sm-6"> <span class="jobsdetail-field-caption"> <strong>Firstname: </strong></span> </div>
            <div class="jobs_detail_val col-sm-6"> <span class="jobsdetail-field-value"> <?php echo $resume['firstname']; ?> </span> </div>
          </div>
          <div class="listdiv jobslistdetail-category col-sm-12">
            <div class="jobscaption col-sm-6"> <span class="jobsdetail-field-caption"> <strong> Lastname:</strong> </span> </div>
            <div class="jobs_detail_val col-sm-6"> <span class="jobsdetail-field-value"> <?php echo $resume['lastname']; ?> </span> </div>
          </div>
          <div class="listdiv jobslistdetail-type col-sm-12">
            <div class="jobscaption col-sm-6"> <span class="jobsdetail-field-caption"><strong> Resume:</strong> </span> </div>
            <div class="jobs_detail_val col-sm-6"> <span class="jobsdetail-field-value"> <?php echo $resume['resume']; ?> </span> </div>
          </div>
          <div class="listdiv jobslistdetail-type col-sm-12">
            <div class="jobscaption col-sm-6"> <span class="jobsdetail-field-caption"><strong> Address:</strong> </span> </div>
            <div class="jobs_detail_val col-sm-6"> <span class="jobsdetail-field-value"> <?php echo $resume['address']; ?> </span> </div>
          </div>
          <div class="listdiv jobslistdetail-type col-sm-12">
            <div class="jobscaption col-sm-6"> <span class="jobsdetail-field-caption"><strong> Workphone No:</strong> </span> </div>
            <div class="jobs_detail_val col-sm-6"> <span class="jobsdetail-field-value"> <?php echo $resume['workphone']; ?> </span> </div>
          </div>
      </div>
       <div class="listdiv col-sm-4 clearfix">

           <div class="listdiv jobslistdetail-type col-sm-12">
            <div class="jobscaption col-sm-6"> <span class="jobsdetail-field-caption"><strong> Country:</strong> </span> </div>
            <div class="jobs_detail_val col-sm-6"> <span class="jobsdetail-field-value"> <?php echo $resume['country_name']; ?> </span> </div>
          </div>
 		 <div class="listdiv jobslistdetail-type col-sm-12">
            <div class="jobscaption col-sm-6"> <span class="jobsdetail-field-caption"><strong> State:</strong> </span> </div>
            <div class="jobs_detail_val col-sm-6"> <span class="jobsdetail-field-value"> <?php echo $resume['state_name']; ?> </span> </div>
         </div>
          <div class="listdiv jobslistdetail-type col-sm-12">
            <div class="jobscaption col-sm-6"> <span class="jobsdetail-field-caption"><strong> City:</strong> </span> </div>
            <div class="jobs_detail_val col-sm-6"> <span class="jobsdetail-field-value"> <?php echo $resume['city_name']; ?> </span> </div>
          </div>
           <div class="listdiv jobslistdetail-type col-sm-12">
            <div class="jobscaption col-sm-6"> <span class="jobsdetail-field-caption"><strong> Zip:</strong> </span> </div>
            <div class="jobs_detail_val col-sm-6"> <span class="jobsdetail-field-value"> <?php echo $resume['zip']; ?> </span> </div>
          </div>
          <div class="listdiv jobslistdetail-type col-sm-12">
            <div class="jobscaption col-sm-6"> <span class="jobsdetail-field-caption"><strong> Career Type:</strong> </span> </div>
            <div class="jobs_detail_val col-sm-6"> <span class="jobsdetail-field-value"> <?php echo $resume['career_type']; ?> </span> </div>
          </div>
          <div class="listdiv jobslistdetail-type col-sm-12">
            <div class="jobscaption col-sm-6"> <span class="jobsdetail-field-caption"><strong> Salary Type:</strong> </span> </div>
            <div class="jobs_detail_val col-sm-6"> <span class="jobsdetail-field-value"> <?php echo $resume['salary_type']; ?> </span> </div>
          </div>
        </div>
        
        <div class="col-sm-4 job_act_right clearfix">
			<div class="jaction">
				<div class="jobactions">
					<span class="job-action action_btn"><a onClick="window.print(); return false;" href=""><i class="fa fa-print"></i>&nbsp;Print This Resume</a></span>
					<?php if($user->id != 0 && $user->group_id == 2){ ?>
					<span class="job-action action_btn" ><a onClick="saveresume(<?php echo $resume['user_id']; ?>,<?php echo $user->id; ?>);" href="#"><i class="fa fa-save"></i>&nbsp;Save This Resume</a></span>
					<?php } ?>
					<span class="job-action action_btn"><a href="http://www.addthis.com/bookmark.php?v=250" class="addthis_button action_btn"><i class="fa fa-share-alt"></i>&nbsp;Share This Resume</a></span>
				</div>
			</div>
		</div>
		
		<div class="col-xs-12">
		  <hr class="hr-style">
		</div>
       <!-- education details-->
        <div class="jobslistdetail clearfix col-sm-12"><center><h2>Education Details</h2></center>
        <?php foreach ($resume['educations'] as $key => $value) { ?>
        <div class="listdiv col-sm-4"> <h2><center> <?php echo "(".++$key.")  ".$value['name']; ?></center></h2>
          <div class="listdiv jobslistdetail-company col-sm-12">
            <div class="jobscaption col-sm-8"> <span class="jobsdetail-field-caption"> <strong>Institute Name: </strong></span> </div>
            <div class="jobs_detail_val col-sm-2"> <span class="jobsdetail-field-value"> <?php echo $value['institute_name']; ?> </span> </div>
          </div>
          <div class="listdiv jobslistdetail-category col-sm-12">
            <div class="jobscaption col-sm-8"> <span class="jobsdetail-field-caption"> <strong> Study:</strong> </span> </div>
            <div class="jobs_detail_val col-sm-2"> <span class="jobsdetail-field-value"> <?php echo $value['study']; ?> </span> </div>
          </div>
          <div class="listdiv jobslistdetail-type col-sm-12">
            <div class="jobscaption col-sm-8"> <span class="jobsdetail-field-caption"><strong> Year Of Passing:</strong> </span> </div>
            <div class="jobs_detail_val col-sm-2"> <span class="jobsdetail-field-value"> <?php echo $value['year']; ?> </span> </div>
          </div>
        </div>
        <?php }?>
      </div>
      	<div class="col-xs-12">
			<hr class="hr-style">
		</div>
      <!-- Experience details-->
       <div class="jobslistdetail clearfix col-sm-12"><center><h2>Experience Details</h2></center>
        <?php foreach ($resume['experiences'] as $key => $value) { 
        	  $startdate=date_create($value['startdate']);
         	  $startdate = date_format($startdate,"m.d.Y");
         	  $enddate=date_create($value['enddate']);
         	  $enddate = date_format($enddate,"m.d.Y");
        	?>
        <div class="listdiv col-sm-4"> <h2><center> <?php echo "(".++$key.") ".$value['title']; ?></center></h2>
          <div class="listdiv jobslistdetail-company col-sm-12">
            <div class="jobscaption col-sm-10"> <span class="jobsdetail-field-caption"> <strong>Start Date Experience: </strong></span> </div>
            <div class="jobs_detail_val col-sm-2"> <span class="jobsdetail-field-value"> <?php echo $startdate; ?> </span> </div>
          </div>
          <div class="listdiv jobslistdetail-category col-sm-12">
            <div class="jobscaption col-sm-10"> <span class="jobsdetail-field-caption"> <strong> End Date Experience:</strong> </span> </div>
            <div class="jobs_detail_val col-sm-2"> <span class="jobsdetail-field-value"> <?php echo $enddate; ?> </span> </div>
          </div>
          
        </div>
        <?php }?>
      </div>
      <div class="col-xs-12">
		<hr class="hr-style">
	  </div>
      <!-- skills details-->
      <div class="jobslistdetail clearfix col-sm-12"><center><h2>Area Of Skill Details</h2></center>
        <?php foreach ($resume['skills'] as $key => $value) { ?>
        <div class="listdiv col-sm-4"> <h2><center> <?php echo "(".++$key.")  ".$value['skill']; ?></center></h2>
          <div class="listdiv jobslistdetail-company col-sm-12">
            <div class="jobscaption col-sm-8"> <span class="jobsdetail-field-caption"> <strong>Area Experience: </strong></span> </div>
            <div class="jobs_detail_val col-sm-2"> <span class="jobsdetail-field-value"> <?php echo $value['experience']; ?> </span> </div>
          </div>
          <div class="listdiv jobslistdetail-category col-sm-12">
            <div class="jobscaption col-sm-8"> <span class="jobsdetail-field-caption"> <strong> Skill Level:</strong> </span> </div>
            <div class="jobs_detail_val col-sm-2"> <span class="jobsdetail-field-value"> <?php echo $value['name']; ?> </span> </div>
          </div>
          
        </div>
        <?php }?>
      </div>
    </div>
       </div>
     

  		</div>
	</div>
 </div>
</div>

<!-- ================================================================================== -->
<div class="col-sm-12 jobslist_main_container visible-print-block">
  <div id="jobslists" class="jobslists-container">
  	
    <div class="jobslists col-sm-12">
    	 <div class=" col-sm-12">

      <div class="listing-title clearfix">
      	 <div class="col-sm-4">
        
        <div class="resumelist_title">
          		<h2><?php echo $resume['firstname']; ?></h2>
          	</div>
			
      	</div>
      	<!-- Personal Details -->
        <div class="jobslistdetail clearfix col-sm-12"><center><h2>Personal Details</h2></center>
        <div class="listdiv col-sm-4">

          <div class="listdiv jobslistdetail-company col-sm-12">
            <div class="jobscaption col-sm-6"> <span class="jobsdetail-field-caption"> <strong>Firstname: </strong></span> </div>
            <div class="jobs_detail_val col-sm-6"> <span class="jobsdetail-field-value"> <?php echo $resume['firstname']; ?> </span> </div>
          </div>
          <div class="listdiv jobslistdetail-category col-sm-12">
            <div class="jobscaption col-sm-6"> <span class="jobsdetail-field-caption"> <strong> Lastname:</strong> </span> </div>
            <div class="jobs_detail_val col-sm-6"> <span class="jobsdetail-field-value"> <?php echo $resume['lastname']; ?> </span> </div>
          </div>
          <div class="listdiv jobslistdetail-type col-sm-12">
            <div class="jobscaption col-sm-6"> <span class="jobsdetail-field-caption"><strong> Resume:</strong> </span> </div>
            <div class="jobs_detail_val col-sm-6"> <span class="jobsdetail-field-value"> <?php echo $resume['resume']; ?> </span> </div>
          </div>
          <div class="listdiv jobslistdetail-type col-sm-12">
            <div class="jobscaption col-sm-6"> <span class="jobsdetail-field-caption"><strong> Address:</strong> </span> </div>
            <div class="jobs_detail_val col-sm-6"> <span class="jobsdetail-field-value"> <?php echo $resume['address']; ?> </span> </div>
          </div>
          <div class="listdiv jobslistdetail-type col-sm-12">
            <div class="jobscaption col-sm-6"> <span class="jobsdetail-field-caption"><strong> Workphone No:</strong> </span> </div>
            <div class="jobs_detail_val col-sm-6"> <span class="jobsdetail-field-value"> <?php echo $resume['workphone']; ?> </span> </div>
          </div>
      </div>
       <div class="listdiv col-sm-4">

           <div class="listdiv jobslistdetail-type col-sm-12">
            <div class="jobscaption col-sm-6"> <span class="jobsdetail-field-caption"><strong> Country:</strong> </span> </div>
            <div class="jobs_detail_val col-sm-6"> <span class="jobsdetail-field-value"> <?php echo $resume['country_name']; ?> </span> </div>
          </div>
 		 <div class="listdiv jobslistdetail-type col-sm-12">
            <div class="jobscaption col-sm-6"> <span class="jobsdetail-field-caption"><strong> State:</strong> </span> </div>
            <div class="jobs_detail_val col-sm-6"> <span class="jobsdetail-field-value"> <?php echo $resume['state_name']; ?> </span> </div>
         </div>
          <div class="listdiv jobslistdetail-type col-sm-12">
            <div class="jobscaption col-sm-6"> <span class="jobsdetail-field-caption"><strong> City:</strong> </span> </div>
            <div class="jobs_detail_val col-sm-6"> <span class="jobsdetail-field-value"> <?php echo $resume['city_name']; ?> </span> </div>
          </div>
           <div class="listdiv jobslistdetail-type col-sm-12">
            <div class="jobscaption col-sm-6"> <span class="jobsdetail-field-caption"><strong> Zip:</strong> </span> </div>
            <div class="jobs_detail_val col-sm-6"> <span class="jobsdetail-field-value"> <?php echo $resume['zip']; ?> </span> </div>
          </div>
          <div class="listdiv jobslistdetail-type col-sm-12">
            <div class="jobscaption col-sm-6"> <span class="jobsdetail-field-caption"><strong> Career Type:</strong> </span> </div>
            <div class="jobs_detail_val col-sm-6"> <span class="jobsdetail-field-value"> <?php echo $resume['career_type']; ?> </span> </div>
          </div>
          <div class="listdiv jobslistdetail-type col-sm-12">
            <div class="jobscaption col-sm-6"> <span class="jobsdetail-field-caption"><strong> Salary Type:</strong> </span> </div>
            <div class="jobs_detail_val col-sm-6"> <span class="jobsdetail-field-value"> <?php echo $resume['salary_type']; ?> </span> </div>
          </div>
        </div>
        
		<div class="col-xs-12">
		  <hr class="hr-style">
		</div>
       <!-- education details-->
        <div class="jobslistdetail clearfix col-sm-12"><center><h2>Education Details</h2></center>
        <?php foreach ($resume['educations'] as $key => $value) { ?>
        <div class="listdiv col-sm-4"> <h2><center> <?php echo "(".++$key.")  ".$value['name']; ?></center></h2>
          <div class="listdiv jobslistdetail-company col-sm-12">
            <div class="jobscaption col-sm-8"> <span class="jobsdetail-field-caption"> <strong>Institute Name: </strong></span> </div>
            <div class="jobs_detail_val col-sm-2"> <span class="jobsdetail-field-value"> <?php echo $value['institute_name']; ?> </span> </div>
          </div>
          <div class="listdiv jobslistdetail-category col-sm-12">
            <div class="jobscaption col-sm-8"> <span class="jobsdetail-field-caption"> <strong> Study:</strong> </span> </div>
            <div class="jobs_detail_val col-sm-2"> <span class="jobsdetail-field-value"> <?php echo $value['study']; ?> </span> </div>
          </div>
          <div class="listdiv jobslistdetail-type col-sm-12">
            <div class="jobscaption col-sm-8"> <span class="jobsdetail-field-caption"><strong> Year Of Passing:</strong> </span> </div>
            <div class="jobs_detail_val col-sm-2"> <span class="jobsdetail-field-value"> <?php echo $value['year']; ?> </span> </div>
          </div>
        </div>
        <?php }?>
      </div>
      	<div class="col-xs-12">
			<hr class="hr-style">
		</div>
      <!-- Experience details-->
       <div class="jobslistdetail clearfix col-sm-12"><center><h2>Experience Details</h2></center>
        <?php foreach ($resume['experiences'] as $key => $value) { 
        	  $startdate=date_create($value['startdate']);
         	  $startdate = date_format($startdate,"m.d.Y");
         	  $enddate=date_create($value['enddate']);
         	  $enddate = date_format($enddate,"m.d.Y");
        	?>
        <div class="listdiv col-sm-4"> <h2><center> <?php echo "(".++$key.") ".$value['title']; ?></center></h2>
          <div class="listdiv jobslistdetail-company col-sm-12">
            <div class="jobscaption col-sm-10"> <span class="jobsdetail-field-caption"> <strong>Start Date Experience: </strong></span> </div>
            <div class="jobs_detail_val col-sm-2"> <span class="jobsdetail-field-value"> <?php echo $startdate; ?> </span> </div>
          </div>
          <div class="listdiv jobslistdetail-category col-sm-12">
            <div class="jobscaption col-sm-10"> <span class="jobsdetail-field-caption"> <strong> End Date Experience:</strong> </span> </div>
            <div class="jobs_detail_val col-sm-2"> <span class="jobsdetail-field-value"> <?php echo $enddate; ?> </span> </div>
          </div>
          
        </div>
        <?php }?>
      </div>
      <div class="col-xs-12">
		<hr class="hr-style">
	  </div>
      <!-- skills details-->
      <div class="jobslistdetail clearfix col-sm-12"><center><h2>Area Of Skill Details</h2></center>
        <?php foreach ($resume['skills'] as $key => $value) { ?>
        <div class="listdiv col-sm-4"> <h2><center> <?php echo "(".++$key.")  ".$value['skill']; ?></center></h2>
          <div class="listdiv jobslistdetail-company col-sm-12">
            <div class="jobscaption col-sm-8"> <span class="jobsdetail-field-caption"> <strong>Area Experience: </strong></span> </div>
            <div class="jobs_detail_val col-sm-2"> <span class="jobsdetail-field-value"> <?php echo $value['experience']; ?> </span> </div>
          </div>
          <div class="listdiv jobslistdetail-category col-sm-12">
            <div class="jobscaption col-sm-8"> <span class="jobsdetail-field-caption"> <strong> Skill Level:</strong> </span> </div>
            <div class="jobs_detail_val col-sm-2"> <span class="jobsdetail-field-value"> <?php echo $value['name']; ?> </span> </div>
          </div>
          
        </div>
        <?php }?>
      </div>
    </div>
       </div>
     

  		</div>
	</div>
 </div>
</div>