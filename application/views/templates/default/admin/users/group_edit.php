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
						href="<?php echo site_url('admin/users/groups'); ?>">Cancel</a>
					</button>
				</div>
			</div>
			<form id="adminForm" class="form-horizontal style-form" method="post">
				<div class="form-group">
					<label class="col-sm-2 control-label">Name</label>
					<div class="col-sm-10">
						<input type="text" name="ciform[name]" class="form-control"
							value="<?php echo $group->name; ?>" placeholder="Name">
							<?php echo form_error('ciform[name]'); ?>
					</div>
				</div>
				<input type="hidden" name="ciform[id]" value="<?php echo $group->id; ?>" />
			</form>
		</div>
	</div>
</div>