<div class="row mt">
	<div class="col-md-12">
		<div class="content-panel">
			<div class="col-md-12">
				<div class="col-md-6">
					<h4>
						<i class="fa fa-angle-right"></i> Contact
					</h4>
				</div>
				<div class="col-md-6">
					<div class="pull-right">
						<a href="<?php echo site_url('admin/contact/contact/add'); ?>"
							class="btn btn-success">Add</a>
						
						<button class="btn btn-danger" onclick="return CIForm.actions('delete');">
							<i class="fa fa-trash-o fa-lg"></i> Delete
						</button>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<hr>
				</div>
			</div>
			<form id="adminForm" method="post">
				<table class="table table-striped table-advance table-hover">
					<thead>
						<tr>
							<th><input type="checkbox" onclick="CIForm.checkall(this);" /></th>
							<th><?php sorting_link('Name','name',''); ?></th>							
							<th><?php sorting_link('Email','email',''); ?></th>
							<th><?php sorting_link('Phone No','phone_no',''); ?></th>
							<th><?php sorting_link('Message','message',''); ?></th>
						</tr>
					</thead>
					<tbody>
				    	
				<?php foreach ($contact as $key=>$contactarray){ ?>
					<tr><?php
						


					?>
							<td><input type="checkbox" id="cb<?php echo $key+1; ?>" name="cid[]"
								value="<?php echo $contactarray['id']; ?>" /></td>
							<td><a
								href="<?php echo site_url('admin/contact/contact/edit/id/'.$contactarray['id']); ?>"><?php echo $contactarray['name']; ?></a></td>
							<td><span class="label label-info label-mini"><?php echo $contactarray['email']; ?></span></td>
							<td><?php echo $contactarray['phone_no']; ?></td>
							<td><?php echo word_limiter($contactarray['message'],3); ?></td>
							
						</tr>
					<?php } ?>
				</tbody>
					<div>
						<input type="hidden" name="frmaction"
							value="<?php echo site_url('admin/contact/contact'); ?>" />
						<input type="hidden" name="order"
							value="" />
						<input type="hidden" name="direction"
							value="" />
					</div>
				</table>
			</form>
		</div>
		<!-- /content-panel -->
	</div>
	<!-- /col-md-12 -->
</div>
<!-- /row -->
<div class="centered">
<?php echo $this->pagination->create_links(); ?>
</div>