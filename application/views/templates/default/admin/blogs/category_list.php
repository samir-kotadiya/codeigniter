<div class="row mt">
	<div class="col-md-12">
		<div class="content-panel">
			<div class="col-md-12">
				<div class="col-md-6">
					<h4>
						<i class="fa fa-angle-right"></i> Category
					</h4>
				</div>
				<div class="col-md-6">
					<div class="pull-right">
						<a href="<?php echo site_url('admin/blogs/category/add'); ?>"
							class="btn btn-success">Add</a>
						<button class="btn btn-default"
							onclick="return CIForm.actions('publish');">
							<i class="fa fa-check fa-lg text-success"></i>Publish
						</button>
						<button class="btn btn-default"
							onclick="CIForm.actions('unpublish');">
							<i class="fa fa-times fa-lg text-danger"></i>Unpublish
						</button>
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
							<th><?php sorting_link('title','title','category'); ?></th>							
					
							<th><?php sorting_link('Created by','created_by','category'); ?></th>
							<th><?php sorting_link('status','published','category'); ?></th>
							<th><?php sorting_link('Created Date','created_date','category'); ?></th>
						</tr>
					</thead>
					<tbody>
				<?php foreach ($blogs as $key=>$category){ ?>
					<tr>
							<td><input type="checkbox" id="cb<?php echo $key+1; ?>" name="cid[]"
								value="<?php echo $category['id']; ?>" /></td>
							<td><a
								href="<?php echo site_url('admin/blogs/category/edit/id/'.$category['id']); ?>"><?php echo $category['title']; ?></a></td>
							
							
							
							<td><span class="label label-info label-mini"><?php echo $category['createdby']; ?></span></td>
							<td>							<?php if($category['published']){ ?>
    								<button class="btn btn-success btn-xs" onclick="return CIForm.ajaxaction('cb<?php echo $key+1; ?>','unpublish');">
									   <i class="fa fa-check"></i>
                                    </button>
    								<?php }else{ ?>
    								<button class="btn btn-danger btn-xs" onclick="return CIForm.ajaxaction('cb<?php echo $key+1; ?>','publish');">
									   <i class="fa fa-times"></i>
								    </button>
    								<?php } ?> 
								<!-- <button class="btn btn-danger btn-xs">
									<i class="fa fa-trash-o "></i>
								</button> -->
							</td>
							<td><?php echo $category['created']; ?></td>
						</tr>
					<?php } ?>
				</tbody>
					<div>
						<input type="hidden" name="frmaction"
							value="<?php echo site_url('admin/blogs/category'); ?>" />
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