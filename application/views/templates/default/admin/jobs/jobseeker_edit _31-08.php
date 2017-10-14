<div class="row mt">
	<div class="col-lg-12">
		
		<div class="form-panel">
			<div class="alert alert-info col-sm-12 clearfix">
				<div class="col-sm-10">
					<h4 class="pull-left">Jobseeker Edit</h4>
				</div>
				<div class="col-sm-2">
					<button type="button" onclick="CIForm.submitform();"
						class="btn btn-primary">Save</button>
					<a class="btn btn-default"
						href="<?php echo site_url('admin/jobs/jobseekers'); ?>">Cancel</a>
					</button>
				</div>
			</div>
			<?php if(!empty($this->session->flashdata('user'))){ 
			    $flash = $this->session->flashdata('user');
			    ?>
                                    <div class="alert alert-<?php echo $flash['type']; ?>"><?php echo $flash['message'];; ?><button
						data-dismiss="alert" class="close" type="button">×</button>
				</div>
                                <?php } ?>
			<form id="adminForm" class="form-horizontal style-form" method="post">
				<div class="form-group">
					<label class="col-sm-2 control-label">Firstname</label>
					<div class="col-sm-10">
						<input type="text" name="ciform[firstname]" class="form-control"
							value="<?php echo $jobseeker->firstname; ?>" placeholder="Firstname">
							
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Lastname</label>
					<div class="col-sm-10">
						<input type="text" name="ciform[lastname]" class="form-control"
							value="<?php echo $jobseeker->lastname; ?>" placeholder="Lastname">
							
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Username</label>
					<div class="col-sm-10">
						<input type="text" name="ciform[username]" class="form-control"
							value="<?php echo $user->username; ?>" placeholder="username">
							
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10">
						<input type="text" name="ciform[email]" class="form-control"
							value="<?php echo $user->email; ?>" placeholder="jobseeker@host.com">
				
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10">
						<input type="password" name="ciform[password]"
							class="form-control" placeholder="">
							
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label">Published</label>
					<div class="col-sm-10">
						<div class="switch switch-square" data-on-label="<i class=' fa fa-check'>
							</i>" data-off-label="<i class='fa fa-times'></i>"> <input
								type="checkbox" name="ciform[published]" value="1"
								<?php echo ($user->published == 1)?'checked="checked"':''; ?> />
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Group</label>
					<div class="col-sm-10">
					
						<select name="ciform[group_id]" class="form-control m-b">
						    <?php foreach($groups as $group){
						        ?>
						        <option <?php echo ($user->group_id == $group['id'])?'selected="select"':''; ?> value="<?php echo $group['id']; ?>"><?php echo $group['name']; ?></option>
						        <?php
						    } ?>	
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Job Category</label>
					<div class="col-sm-10">
								<select name="ciform[job_category_id]" class="form-control m-b">
						 
						    <?php foreach($categories as $category){
						        ?>
						        <option <?php echo ($jobseeker->job_category_id == $category['id'])?'selected="select"':''; ?> value="<?php echo $category['id']; ?>"><?php echo $category['title']; ?></option>
						        <?php
						    } ?>	
						</select>
					</div>
				</div>
			<!-- education  fields -->	
			<?php
			if(!empty($educations))
			{
			?>
				<div class="form-group">
					<div  class="col-xs-2 ">
						<label class="col-sm-2 control-label">Education</label>
					</div>
					<div  class="col-xs-10 ">
						<?php
				
						foreach ($educations as $key => $educationdata) {
						
					?>
					<div id="education" class="col-sm-10 form-group">
					<div  class="col-xs-12 ">
					<div class="col-sm-3">

  							<select class="form-control m-b" name="ciform[education][<?php echo $key ?>][level]">
		                   	  <?php  foreach($education as $keyedu=>$data){ 	 
						        ?>
						        <option <?php echo ($educationdata['level'] == $data)?'selected="select"':''; ?>  value="<?php echo $data ?>"><?php echo $keyedu; ?></option>
						        <?php
						    } ?>	
		                   </select>
					</div>

					<div class="col-sm-2">
		                    <input type='text'  class="form-control" value="<?php echo $educationdata['institute_name']; ?>"  name="ciform[education][<?php echo $key ?>][institute_name]" placeholder="Institute" />
					</div>  
					<div class="col-sm-2">
		                    <input type='text'  class="form-control" value="<?php echo $educationdata['study']; ?>"  name="ciform[education][<?php echo $key ?>][study]" placeholder="Field Study" />
					</div>  
					<div class="col-sm-2">
		                    <input type='text'  class="form-control" value="<?php echo $educationdata['year']; ?>"  name="ciform[education][<?php echo $key ?>][year]" placeholder="Year" />
					</div> 
						<?php if($key != 0){?>
						<div class="col-sm-2">
							<button data-inc="1" type="button" class="removebtn btn btn-danger btn-xs"><i class="fa fa-minus">&nbsp;&nbsp;</i>Remove</button>
						</div>  
						<?php }else{ ?>
						<div class="col-sm-2"> 
							<div class="col-xs-1"><button id="addmore" data-inc="<?php echo count($educations); ?>" data-template="education" type="button" class="addmorebtn btn btn-primary btn-xs"><i class="fa fa-plus">&nbsp;&nbsp;</i>Add more</button></div>
						</div>

						<?php } ?>    
					</div>
				</div>
				<?php
					
					}
			
				?>
					
				</div>
			</div>
				 <div class="form-group col-xs-12">
				 	<div class="col-xs-2"><label class="col-sm-2 control-label"> </label></div>
				 	<div id="addeducation" class="col-xs-10  fields-group" >
				 	</div>	
				 </div>
				<?php
			}	
			else
			{	
				?>
				<div class="form-group">
					<label class="col-sm-2 control-label">Education</label>
					
					<div id="education" class="col-sm-7">
					<div  class="col-xs-12 ">
					<div class="col-sm-3">

						<?php


					?>
  							<select class="form-control m-b" name="ciform[education][0][level]">
		                   	  <?php  foreach($education as $key=>$data){ 	 
						        ?>
						        <option  value="<?php echo $data ?>"><?php echo $key; ?></option>
						        <?php
						    } ?>	
		                   </select>
					</div>

					<div class="col-sm-3">
		                    <input type='text'  class="form-control"   name="ciform[education][0][institute_name]" placeholder="Institute" />
					</div>  
					<div class="col-sm-3">
		                    <input type='text'  class="form-control"   name="ciform[education][0][study]" placeholder="Field Study" />
					</div>  
					<div class="col-sm-3">
		                    <input type='text'  class="form-control"   name="ciform[education][0][year]" placeholder="Year" />
					</div>     
					</div>
				</div>
					<div class="col-sm-2"> 
						<div class="col-xs-1"><button id="addeducationbtn" data-inc="1" data-template="education" type="button" class="addmorebtn btn btn-primary btn-xs"><i class="fa fa-plus">&nbsp;&nbsp;</i>Add more</button></div>
					</div>
				</div>
				 <div class="form-group col-xs-12">
				 	<div class="col-xs-2"></div>
				 	<div id="addeducation" class="col-xs-7  fields-group" >
				 	</div>	
				 </div>

				 <?php
				}
				 ?>
				<!-- end education fields --> 
				<div class="form-group">
					<label class="col-sm-2 control-label">Resume</label>
					<div class="col-sm-10">
						<textarea name="ciform[resume]" class="form-control" placeholder="Resume" rows="5"> <?php echo $jobseeker->resume; ?> </textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Address</label>
					<div class="col-sm-10">
						<textarea name="ciform[address]" class="form-control" placeholder="Address" rows="5"> <?php echo $jobseeker->address; ?> </textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Workphone Number</label>
					<div class="col-sm-10">
						<input type="text" name="ciform[workphone]" class="form-control"
							value="<?php echo $jobseeker->workphone; ?>" placeholder="WorkPhone Number">
							
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Country </label>
					<div class="col-sm-10">
						
						<select name="ciform[country]" class="form-control m-b countrychange">
						  
						    <?php foreach($country as $key=>$data){
						        ?>
						        <option <?php echo ($jobseeker->country == $data)?'selected="select"':''; ?>  value="<?php echo $data ?>"><?php echo $key; ?></option>
						        <?php
						    } ?>	
						</select>
					</div>
				</div>
					<div class="form-group">
					<label class="col-sm-2 control-label">State </label>
					<div class="col-sm-10">
						
						<select name="ciform[state]" class="form-control m-b catchstates statechange">
							<?php //if(isset($state)){ ?>
						   <?php foreach($state as $key=>$data){
						        ?>
						        <option <?php echo ($jobseeker->state == $data)?'selected="select"':''; ?>  value="<?php echo $data ?>"><?php echo $key; ?></option>
						        <?php
						    } //}?>	
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label">City</label>
					<div class="col-sm-10">
						
						<select name="ciform[city]" class="form-control m-b catchcities">
						  
						  <?php foreach($city as $key=>$data){
						        ?>
						        <option <?php echo ($jobseeker->city == $data)?'selected="select"':''; ?>  value="<?php echo $data ?>"><?php echo $key; ?></option>
						        <?php
						    } ?>	
						</select>
					</div>
				</div>	
				<div class="form-group">
					<label class="col-sm-2 control-label">Zip Code</label>
					<div class="col-sm-10">
						<input type="text" name="ciform[zip]" class="form-control"
							value="<?php echo $jobseeker->zip; ?>" placeholder="Zip code">
					</div>
				</div>
				<?php
				if(!empty($experience))
				{ 
					
				?>
				<div class="form-group">
					<div class="col-sm-2">
						<label class="col-sm-2 control-label">Work Experience</label>
					</div>
					<div class="col-sm-10">	
					<?php
						foreach ($experience as $key => $experiencedata) {
							
					?>
					<div id="experience" class="col-sm-12 form-group">
					<div class="col-sm-3">
						<input type="text" name="ciform[experience][<?php echo $key ?>][title]" class="form-control"
							value="<?php echo $experiencedata['title']; ?>" placeholder="Experience">
							
					</div>
					<div class="col-sm-3">
							 <div class='input-group date'>
		                    <input type='text'  class="form-control datetimepicker"	value="<?php echo $experiencedata['startdate']; ?>"  name="ciform[experience][<?php echo $key ?>][startdate]" placeholder="Start Date" />
		                    <span class="input-group-addon">
		                        <span class="glyphicon glyphicon-calendar"></span>
	                   		 </span>
               				 </div>     
					</div>
					<div class="col-sm-3">
							 <div class='input-group date'>
		                    <input type='text'  class="form-control datetimepicker" value="<?php echo $experiencedata['enddate']; ?>" name="ciform[experience][<?php echo $key ?>][enddate]" placeholder="End Date" />
		                    <span class="input-group-addon">
		                        <span class="glyphicon glyphicon-calendar"></span>
	                   		 </span>
               				 </div>     
					</div>
					<?php if($key != 0){?>
						<div class="col-sm-2">
							<button data-inc="1" type="button" class="removebtn btn btn-danger btn-xs"><i class="fa fa-minus">&nbsp;&nbsp;</i>Remove</button>
						</div>  
						<?php }else{ ?>
						<div class="col-sm-2"> 
							<div class="col-xs-1"><button id="addmore" data-inc="<?php echo count($experience); ?>" data-template="experience" type="button" class="addmorebtn btn btn-primary btn-xs"><i class="fa fa-plus">&nbsp;&nbsp;</i>Add more</button></div>
						</div>

						<?php } ?>
				
				</div>
				<?php
			
				}
			
				?>
			</div>

					
					
				</div>
				 <div class="form-group">
				 	<div class="col-xs-2"></div>
				 	<div id="addexperience" class="col-xs-8  fields-group" >
				 	</div>		
				 </div>
				<?php
			}
			else
			{
				?>
			<div class="form-group">
					<label class="col-sm-2 control-label">Work Experience</label>
					
					<div id="experience" class="col-sm-7">
					<div class="col-sm-4">
						<input type="text" name="ciform[experience][0][title]" class="form-control"
							 placeholder="Experience">
							
					</div>
					<div class="col-sm-4">
							 <div class='input-group date'>
		                    <input type='text'  class="form-control datetimepicker"	  name="ciform[experience][0][startdate]" placeholder="Start Date" />
		                    <span class="input-group-addon">
		                        <span class="glyphicon glyphicon-calendar"></span>
	                   		 </span>
               				 </div>     
					</div>
					<div class="col-sm-4">
							 <div class='input-group date'>
		                    <input type='text'  class="form-control datetimepicker"  name="ciform[experience][0][enddate]" placeholder="End Date" />
		                    <span class="input-group-addon">
		                        <span class="glyphicon glyphicon-calendar"></span>
	                   		 </span>
               				 </div>     
					</div>
				
				</div>
		
					<div class="col-sm-2"> 
						<div class="col-xs-1"><button id="addmore" data-inc="1" data-template="experience" type="button"  class="addmorebtn btn btn-primary btn-xs"><i class="fa fa-plus">&nbsp;&nbsp;</i>Add more</button></div>
					</div>
					
				</div>
				 <div class="form-group">
				 	<div class="col-xs-2"></div>
				 	<div id="addexperience" class="col-xs-8  fields-group" >
				 	</div>		
				 </div>
				<?php
				}	
				if(!empty($skills))	
				{ 

				?> 
				<div class="form-group">
					<div class="col-sm-2">
						<label class="col-sm-2 control-label">Skill</label>
					</div>
					<div class="col-sm-10">	
					<?php

						foreach ($skills as $key => $skilldata) {
							
					?>
					<div id="skill" class="col-sm-10 form-group">
					<div  class="col-xs-12 ">
						<div class="col-sm-3">
			                    <input type='text'  class="form-control" value="<?php echo $skilldata['skill']?>"  name="ciform[skill][<?php echo $key ?>][skill]" placeholder="Skill" />
						</div>  
						<div class="col-sm-3">
			                    <input type='text'  class="form-control" value="<?php echo $skilldata['experience']?>" name="ciform[skill][<?php echo $key ?>][experience]" placeholder="Year of Experience" />
						</div>  
						<div class="col-sm-3">
							    <select class="form-control m-b" name="ciform[skill][<?php echo $key ?>][skilllevel]">
			                   	  <?php  foreach($skillsarray as $keyskill=>$data){ 	
							        ?>
							        <option <?php echo ($skilldata['skilllevel'] == $data)?'selected="select"':''; ?>  value="<?php echo $data ?>"><?php echo $keyskill; ?></option>
							        <?php
							    } ?>	
			                   </select>
						</div>  
						<?php if($key != 0){?>
						<div class="col-sm-3">
							<button data-inc="1" type="button" class="removebtn btn btn-danger btn-xs"><i class="fa fa-minus">&nbsp;&nbsp;</i>Remove</button>
						</div>  
						<?php }else{ ?>
						<div class="col-sm-2"> 
							<div class="col-xs-1"><button id="addskillbtn" data-inc="<?php echo count($skills); ?>" data-template="skill" type="button" class="addmorebtn btn btn-primary btn-xs"><i class="fa fa-plus">&nbsp;&nbsp;</i>Add more</button></div>
						</div>

						<?php } ?>
					</div>

				</div>
				<?php
				}
				?>
				</div>	
				</div>
				 <div class="form-group col-xs-12">
				 	<div class="col-xs-2"></div>
				 	<div id="addskill" class="col-xs-9  fields-group" >
				 	</div>		
				 </div>
				 <?php
				}
				else
				{
				 ?>
				<div class="form-group">
					<label class="col-sm-2 control-label">Skill</label>
					<div id="skill" class="col-sm-7">
					<div  class="col-xs-12 ">
						<div class="col-sm-4">
			                    <input type='text'  class="form-control"   name="ciform[skill][0][skill]" placeholder="Skill" />
						</div>  
						<div class="col-sm-4">
			                    <input type='text'  class="form-control"  name="ciform[skill][0][experience]" placeholder="Year of Experience" />
						</div>  
						<div class="col-sm-4">
							    <select class="form-control m-b" name="ciform[skill][0][skilllevel]">
			                   	  <?php  foreach($skillsarray as $key=>$data){ 	
							        ?>
							        <option  value="<?php echo $data ?>"><?php echo $key; ?></option>
							        <?php
							    } ?>	
			                   </select>
						</div>    
					</div>

				</div>
					<div class="col-sm-2"> 
						<div class="col-xs-1"><button id="addskillbtn" data-inc="1" data-template="skill" type="button" class="addmorebtn btn btn-primary btn-xs"><i class="fa fa-plus">&nbsp;&nbsp;</i>Add more</button></div>
					</div>
				</div>
				 <div class="form-group col-xs-12">
				 	<div class="col-xs-2"></div>
				 	<div id="addskill" class="col-xs-9  fields-group" >
				 	</div>		
				 </div>
				 <?php
				}
				 ?>
				<div class="form-group">
					<label class="col-sm-2 control-label">Salary Type</label>
					<div class="col-sm-10">
								<select name="ciform[salary_type_id]" class="form-control m-b">
						    <?php foreach($salary_type as $salary){
						        ?>
						        <option <?php echo ($jobseeker->salary_type_id == $salary['id'])?'selected="select"':''; ?> value="<?php echo $salary['id']; ?>"><?php echo $salary['type']; ?></option>
						        <?php
						    } ?>	
						</select>
					</div>
				</div>
					<div class="form-group">
					<label class="col-sm-2 control-label">Career Type</label>
					<div class="col-sm-10">
								<select name="ciform[career_type_id]" class="form-control m-b">
						    <?php foreach($career_type as $career){
						        ?>
						        <option <?php echo ($jobseeker->career_type_id == $career['id'])?'selected="select"':''; ?> value="<?php echo $career['id']; ?>"><?php echo $career['name']; ?></option>
						        <?php
						    } ?>	
						</select>
					</div>
				</div>
				<input type="hidden" id="siteurl" name="siteurl" value="<?php echo site_url(); ?>" />
				<input type="hidden" name="ciform[user_id]" value="<?php echo $jobseeker->user_id; ?>" />
			</form>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
		var check =  $(".datetimepicker").length;

        if(check > 0){
        	$('.datetimepicker').datetimepicker().change(function(e) {
                // Revalidate the date field

        	
            });                          
        }           
         
        //start experiance
       	
          jQuery(".addmorebtn").bind('click',function(){

        		var templateid = jQuery(this).attr('data-template');

        		var inc = jQuery(this).attr('data-inc');
        		var id= jQuery(this).attr('id');
     			var $template = $('#'+templateid),
				
 				$clone    = $template
                        .clone().removeClass("col-sm-7") 	
                          .addClass('col-xs-11');
                     var fieldhtml = $clone.html();

                   var htmlprocess = fieldhtml.replace(/[0]/g,inc);
                    	
                    $clone.html(htmlprocess);
                       	$clone.find('#'+id).parent().parent().remove();
                       	console.log($clone);
	                    jQuery("#add"+templateid).append($clone);
                   inc++;
                   	$('.datetimepicker').datetimepicker().change(function(e) {
                	});                          
        		jQuery(this).attr('data-inc',inc);
        		$removebtn = '<div class="col-xs-1"><button data-inc="1" type="button" class="removebtn btn btn-danger btn-xs"><i class="fa fa-minus">&nbsp;&nbsp;</i>Remove</button></div>'
				$wrapperdiv = '<div class="form-group col-xs-12 recentwrapper"></div>';
        		$clone.wrap($wrapperdiv);
				jQuery(".recentwrapper").append($removebtn);
				jQuery(".recentadded").removeClass("recentadded");
				jQuery(".recentwrapper").removeClass("recentwrapper");
          	});
			jQuery(document).on('click','.removebtn',function(){
			jQuery(this).parent().parent().remove();
		
			});
			
});

	 

</script>