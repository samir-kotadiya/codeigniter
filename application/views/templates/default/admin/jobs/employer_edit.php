<div class="row mt">
	<div class="col-lg-12">
		<div class="form-panel">
			<div class="alert alert-info col-sm-12 clearfix">
				<div class="col-sm-10">
					<h4 class="pull-left">employer Edit</h4>
				</div>
				<div class="col-sm-2">
					<button type="button" onclick="CIForm.submitform();"
						class="btn btn-primary">Save</button>
					<a class="btn btn-default"
						href="<?php echo site_url('admin/jobs/employers'); ?>">Cancel</a>
					</button>
				</div>
			</div>
			<?php if(!empty($this->session->flashdata('employer'))){ 
			    $flash = $this->session->flashdata('employer');
			    ?>
                                    <div class="alert alert-<?php echo $flash['type']; ?>"><?php echo $flash['message'];; ?><button
						data-dismiss="alert" class="close" type="button">×</button>
				</div>
                                <?php } ?>
			<form id="adminForm" class="form-horizontal style-form" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sm-2 control-label">Firstname</label>
					<div class="col-sm-10">
						<input type="text" name="ciform[firstname]" class="form-control"
							value="<?php echo $employer->firstname; ?>" placeholder="Firstname">
							
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Lastname</label>
					<div class="col-sm-10">
						<input type="text" name="ciform[lastname]" class="form-control"
							value="<?php echo $employer->lastname; ?>" placeholder="Lastname">
							
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
							value="<?php echo $user->email; ?>" placeholder="employer@host.com">
				
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
					<label class="col-sm-2 control-label">Address</label>
					<div class="col-sm-10">
						<textarea name="ciform[address]" class="form-control" placeholder="Address" rows="5"> <?php echo $employer->address; ?> </textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Company</label>
					<div class="col-sm-10">
						<input type="text" name="ciform[company]" class="form-control"
							value="<?php echo $employer->company; ?>" placeholder="Company">
							
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label">Logo</label>
					<div class="col-sm-10">
						<input type="file" name="logo" class="form-control file">	<br/>
													<?php
							if(isset($employer->logo))
							{
								$image_properties = array(
								    'src' => 'application/'.$employer->logo,
								    'width' => '70',
								    'height' => '70'
									);
								echo img($image_properties); 
							}	
								?>				
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Workphone Number</label>
					<div class="col-sm-10">
						<input type="text" name="ciform[workphone]" class="form-control"
							value="<?php echo $employer->workphone; ?>" placeholder="WorkPhone Number">
							
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Country </label>
					<div class="col-sm-10">
						
						<select name="ciform[country]" class="form-control m-b countrychange">
						  
						    <?php foreach($country as $key=>$data){
						        ?>
						        <option <?php echo ($employer->country == $data)?'selected="select"':''; ?>  value="<?php echo $data ?>"><?php echo $key; ?></option>
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
						        <option <?php echo ($employer->state == $data)?'selected="select"':''; ?>  value="<?php echo $data ?>"><?php echo $key; ?></option>
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
						        <option <?php echo ($employer->city == $data)?'selected="select"':''; ?>  value="<?php echo $data ?>"><?php echo $key; ?></option>
						        <?php
						    } ?>	
						</select>
					</div>
				</div>	
				<div class="form-group">
					<label class="col-sm-2 control-label">Zip Code</label>
					<div class="col-sm-10">
						<input type="text" name="ciform[zip]" class="form-control"
							value="<?php echo $employer->zip; ?>" placeholder="Zip code">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Phone No</label>
					<div class="col-sm-10">
						<input type="text" name="ciform[phoneno]" class="form-control"
							value="<?php echo $employer->phoneno; ?>" placeholder="Phone No">
							
					</div>
				</div>
				<div class="form-group websitejob">
					<label class="col-sm-2 control-label">Website</label>
					<div class="col-sm-10">
						<input type="text" name="ciform[website]" class="form-control"
							value="<?php echo $employer->website; ?>" placeholder="website">
							
					</div>
				</div>
				<input type="hidden" id="siteurl" name="siteurl" value="<?php echo site_url(); ?>" />
				<input type="hidden" name="ciform[user_id]" value="<?php echo $employer->user_id; ?>" />
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
 }); 
</script>