<div class="row mt">
	<div class="col-lg-12">
		<div class="form-panel">
			<div class="alert alert-info col-sm-12 clearfix">
				<div class="col-sm-10">
					<h4 class="pull-left">User Edit</h4>
				</div>
				<div class="col-sm-2">
					<button type="button" onclick="CIForm.submitform();"
						class="btn btn-primary">Save</button>
					<a class="btn btn-default"
						href="<?php echo site_url('admin/users/users'); ?>">Cancel</a>
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
					<label class="col-sm-2 control-label">Username</label>
					<div class="col-sm-10">
						<input type="text" name="ciform[username]" class="form-control"
							value="<?php echo $user->username; ?>" placeholder="Username">
							<?php echo form_error('ciform[username]'); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10">
						<input type="text" name="ciform[email]" class="form-control"
							value="<?php echo $user->email; ?>" placeholder="user@host.com">
							<?php echo form_error('ciform[email]'); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10">
						<input type="password" name="ciform[password]"
							class="form-control" placeholder="">
							<?php echo form_error('ciform[password]'); ?>
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
				<input type="hidden" name="ciform[id]" value="<?php echo $user->id; ?>" />
			</form>
		</div>
	</div>
</div>