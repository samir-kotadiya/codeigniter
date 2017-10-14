<?php //echo '<pre>'; print_r($plan_features); echo '</pre>'; ?>

<div class="row mt">
	<div class="col-md-12">
		<div class="content-panel">
			<div class="col-md-12">
				<div class="col-md-6">
					<h4>
						<i class="fa fa-angle-right"></i> Packages
					</h4>
				</div>
				<div class="col-md-6">
					<div class="pull-right">
						<a href="<?php echo site_url('admin/plans/packages/edit/0'); ?>"
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
							<th><?php sorting_link('name','name','packages'); ?></th>
							<th>Featurs</th>
							<th><?php sorting_link('price','price','packages'); ?></th>
							<th><?php sorting_link('status','published','packages'); ?></th>
							<th><?php sorting_link('id','id','packages'); ?></th>
						</tr>
					</thead>
					<tbody>
				<?php foreach ($packages as $key=>$package){ ?>
					<tr>
							<td><input type="checkbox" id="cb<?php echo $key+1; ?>" name="cid[]"
								value="<?php echo $package['id']; ?>" /></td>
							<td><a
								href="<?php echo site_url('admin/plans/packages/edit/'.$package['id']); ?>"><?php echo $package['name']; ?></a></td>
							<td>								
								<?php 
									$packageArray = explode(',', $package['features']);									
									echo '<ul class="features_block">';
									
									foreach ($plan_features as $fkey => $plan_feature) {
										if(in_array($plan_feature['id'], $packageArray)){
											echo '<li><span class="btn btn-success btn-xs"><i class="fa fa-check"></i></span>'.$plan_feature['name'].'</li>';
										}else{
											echo '<li><span class="btn btn-danger btn-xs"><i class="fa fa-times"></i></span>'.$plan_feature['name'].'</li>';
										}
									}
									echo '</ul>';									
								?>
							</td>
							<td><span class="label label-info label-mini"><?php echo $package['price']; ?></span></td>
							<td>
								<?php if($package['published']){ ?>
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
							<td><?php echo $package['id']; ?></td>
						</tr>
					<?php } ?>
				</tbody>
					<div>
						<input type="hidden" name="frmaction"
							value="<?php echo site_url('admin/plans/packages'); ?>" />
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