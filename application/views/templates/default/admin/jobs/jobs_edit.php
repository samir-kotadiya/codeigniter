<div class="row mt">
	<div class="col-lg-12">
		<div class="form-panel">
			<div class="alert alert-info col-sm-12 clearfix">
				<div class="col-sm-10">
					<h4 class="pull-left">jobs Edit</h4>
				</div>
				<div class="col-sm-2">
					<button type="button" onclick="CIForm.submitform();"
						class="btn btn-primary">Save</button>
					<a class="btn btn-default"
						href="<?php echo site_url('admin/jobs/jobs'); ?>">Cancel</a>
					</button>
				</div>
			</div>
			<?php if(!empty($this->session->flashdata('jobs'))){ 
			    $flash = $this->session->flashdata('jobs');
			    ?>
                                    <div class="alert alert-<?php echo $flash['type']; ?>"><?php echo $flash['message'];; ?><button
						data-dismiss="alert" class="close" type="button">×</button>
				</div>
                                <?php } ?>
			<form id="adminForm" class="form-horizontal style-form" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sm-2 control-label">Title</label>
					<div class="col-sm-10">
						<input type="text" name="ciform[title]" class="form-control"
							value="<?php echo $jobs->title; ?>" placeholder="Title">

					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Code</label>
					<div class="col-sm-10">
							<input type="text" name="ciform[code]" class="form-control"
							value="<?php echo $jobs->code; ?>" placeholder="Code">
							
							
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Description</label>
					<div class="col-sm-10">
						<textarea name="ciform[description]" class="form-control" placeholder="description" rows="5"> <?php echo $jobs->description; ?> </textarea>
							
					</div>
				</div>
					<div class="form-group">
					<label class="col-sm-2 control-label">Featured</label>
					<div class="col-sm-10">
						<div class="switch switch-square" data-on-label="<i 
							
							class=' fa fa-check'>
							</i>" data-off-label="<i class='fa fa-times'></i>"> <input
								type="checkbox" name="ciform[featured]" value="1"
								<?php echo ($jobs->featured == 1)?'checked="checked"':''; ?> />
						</div>
					</div>
				</div>

			<div class="form-group">
					<label class="col-sm-2 control-label">Category</label>
					<div class="col-sm-10">
						
						<select name="ciform[category_id]" class="form-control m-b">
						  
						    <?php foreach($category as $cat){
						        ?>
						        <option <?php echo ($jobs->category_id == $cat['id'])?'selected="select"':''; ?> value="<?php echo $cat['id']; ?>"><?php echo $cat['title']; ?></option>
						        <?php
						    } ?>	
						</select>
					</div>
				</div>

					<div class="form-group">
					<label class="col-sm-2 control-label">Published</label>
					<div class="col-sm-10">
						<div class="switch switch-square" data-on-label="<i 
							
							class=' fa fa-check'>
							</i>" data-off-label="<i class='fa fa-times'></i>"> <input
								type="checkbox" name="ciform[published]" value="1"
								<?php echo ($jobs->published == 1)?'checked="checked"':''; ?> />
						</div>
					</div>
				</div>
				
					<div class="form-group">
					<label class="col-sm-2 control-label">Salary Type</label>
					<div class="col-sm-10">
						
						<select name="ciform[salary_type_id]" class="form-control m-b">
						  
						    <?php foreach($salary_type as $sal){
						        ?>
						        <option <?php echo ($jobs->salary_type_id == $sal['id'])?'selected="select"':''; ?> value="<?php echo $sal['id']; ?>"><?php echo $sal['type']; ?></option>
						        <?php
						    } ?>	
						</select>
					</div>
				</div>
			
				<div class="form-group">
					<label class="col-sm-2 control-label">Maximum Salary</label>
					<div class="col-sm-10">
						<input type="text" name="ciform[max_salary]" class="form-control"
							value="<?php echo $jobs->max_salary; ?>" placeholder="Maximum Salary">
						
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Minimum Salary</label>
					<div class="col-sm-10">
						<input type="text" name="ciform[min_salary]" class="form-control"
							value="<?php echo $jobs->min_salary; ?>" placeholder="Minimum Salary">
						
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Country </label>
					<div class="col-sm-10">
						
						<select name="ciform[country]" class="form-control m-b countrychange">
						  
						    <?php foreach($country as $key=>$data){
						        ?>
						        <option <?php echo ($jobs->country == $data)?'selected="select"':''; ?>  value="<?php echo $data ?>"><?php echo $key; ?></option>
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
						        <option <?php echo ($jobs->state == $data)?'selected="select"':''; ?>  value="<?php echo $data ?>"><?php echo $key; ?></option>
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
						        <option <?php echo ($jobs->city == $data)?'selected="select"':''; ?>  value="<?php echo $data ?>"><?php echo $key; ?></option>
						        <?php
						    } ?>	
						</select>
					</div>
				</div>
				
			
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Zip_Code </label>
					<div class="col-sm-10">
						<input type="text" name="ciform[zip_code]" class="form-control"
							value="<?php echo $jobs->zip_code; ?>" placeholder="Zip_Code">
							
					
					</div>
				</div>

				<?php
			
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
			                   	  <?php  foreach($skillarray as $keyskill=>$data){ 	
			                   	  
							        ?>
							        <option <?php echo ($skilldata['skilllevel'] == $data['id'])?'selected="select"':''; ?>  value="<?php echo $data['id'] ?>"><?php echo $data['name']; ?></option>
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
			                   	  <?php  

			                   	  foreach($skillarray as $key=>$data){ 	
			                 
							        ?>
							        <option  value="<?php echo $data['id'] ?>"><?php echo $data['name']; ?></option>
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
					<label class="col-sm-2 control-label">Career </label>
					<div class="col-sm-10">
						
						<select name="ciform[career_type_id]" class="form-control">
						  
						    <?php 
						    foreach($career as $key=>$data){
						        ?>
						        <option <?php echo ($jobs->career_type_id == $data['id'])?'selected="select"':''; ?>  value="<?php echo $data['id'] ?>"><?php echo $data['name']; ?></option>
						        <?php
						    } ?>	
						</select>
					</div>
				</div> 
				<div class="form-group">
					<label class="col-sm-2 control-label">Tags </label>
					<div class="col-sm-10">
						  <span class="frontForm label-inf">
						<input type="text" name="ciform[tags]" data-role="tagsinput" class="form-control"
							value="<?php echo $jobs->tags; ?>" placeholder="Tags">
						
						</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Job Type</label>
					<div class="col-sm-10">
				
						<select name="ciform[job_type_id]" class="form-control m-b">
						  
						    <?php foreach($job_type as $type){
						        ?>
						        <option <?php echo ($jobs->job_type_id == $type['id'])?'selected="select"':''; ?> value="<?php echo $type['id']; ?>"><?php echo $type['title']; ?></option>
						        <?php
						    } ?>	
						</select>
					</div>
				</div>
				<div class="form-group">  	
					<label class="col-sm-2 control-label">Published Date </label>
					<div class="col-sm-10">
						   <div class='input-group date'>
                                    <input type='text'  class="form-control datetimepicker " value="<?php echo $jobs->published_date; ?>" name="ciform[published_date]"  placeholder="Published Date" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
					
					</div>
				</div>
					<div class="form-group">
					<label class="col-sm-2 control-label">Language</label>
					<div class="col-sm-10">
				
						<select name="ciform[language]" class="form-control m-b">
						    <option>--Select Language--</option>						     
						    <option value="1">English</option>						     
						    <option value="2">Spanish</option>						     
						</select>
					</div>
				</div>
				<input type="hidden" id="siteurl" name="siteurl" value="<?php echo site_url(); ?>" />
				<input type="hidden" name="ciform[id]" value="<?php echo $jobs->id; ?>" />
				<input type="hidden" name="ciform[created_by]" value="<?php echo $jobs->created_by; ?>" />
			</form>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
 tinymce.init({
        selector: 'textarea',
        setup: function(editor) {
            editor.on('keyup', function(e) {
                $('#adminForm').formValidation('revalidateField', editor.settings.id);
            });
        }
    });

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