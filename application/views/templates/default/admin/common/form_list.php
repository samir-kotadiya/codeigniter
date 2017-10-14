<div class="row mt">
	<div class="col-md-12">
		<div class="content-panel">
			<div class="col-md-12">
				<div class="col-md-6">
					<h4>
						<i class="fa fa-angle-right"></i> Users
					</h4>
				</div>
				<?php


				?>
				<div class="col-md-6">
					<div class="pull-right">
					   <?php if(isset($form_list['actions']['add'])){ ?>
						<a href="<?php echo $form_list['actions']['add']['href']; ?>"
							class="btn btn-success">Add</a>
					   <?php } ?>
					   <?php if(isset($form_list['actions']['publish'])){ ?>
						<button class="btn btn-default"
							onclick="return CIForm.actions('publish');">
							<i class="fa fa-check fa-lg text-success"></i>Publish
						</button>
						<?php } ?>
						<?php if(isset($form_list['actions']['unpublish'])){ ?>
						<button class="btn btn-default"
							onclick="CIForm.actions('unpublish');">
							<i class="fa fa-times fa-lg text-danger"></i>Unpublish
						</button>
						<?php } ?>
						<?php if(isset($form_list['actions']['delete'])){ ?>
						<button class="btn btn-danger"
							onclick="return CIForm.actions('delete');">
							<i class="fa fa-trash-o fa-lg"></i> Delete
						</button>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<hr>
				</div>
			</div>
			<form id="adminForm" method="post" action="<?php echo site_url($form_list['action']); ?>">
				<table class="table table-striped table-advance table-hover">
					<thead>
						<tr>
						  <?php if(!empty($form_list['lists']['fields'])){ ?>
						  <?php foreach ($form_list['lists']['fields'] as $field){
						      if(isset($field['checkall']) && $field['checkall']){
						          ?><th><input type="checkbox" onclick="CIForm.checkall(this);" /></th><?php  
						      }else if(isset($field['sort']) && $field['sort']){
						          ?><th><?php sorting_link($field['label'],$field['field']); ?></th><?php       
						      }else{
						          ?><th><?php echo $field['label']; ?></th><?php
						      }
						  } ?>
						  <?php } ?>
						</tr>
					</thead>
					<tbody>
					<?php if(!empty($form_list['lists']['values'])){ ?>
				    <?php foreach ($form_list['lists']['values'] as $mainkey=>$fields){ ?>
				    <tr>

				    <?php foreach ($fields as $key=>$value){ ?>
					   <?php 
					   switch ($value['type']){
                           case 'checkall':
					           ?>
					           <td><input type="checkbox" id="cb<?php echo $mainkey+1; ?>"
								name="cid[]" value="<?php echo $value['value']; ?>" /></td>
					           <?php 
					           break;
					       case 'anchore':
					           ?>
   					           <td><a
								href="<?php echo $value['href'].$value['id']; ?>"><?php echo $value['value']; ?></a></td>
   					           <?php 
                                break;
                            case 'label':
                                ?>
   					           <td><span class="label label-info label-mini"><?php echo $value['value']; ?></span></td>
   					           <?php
                                break;
                            case 'publishtoggel':
                                ?>
                            
   					           <td>
								<?php if($value['publish']){ ?>
    								<button class="btn btn-success btn-xs"
									onclick="return CIForm.ajaxaction('cb<?php echo $mainkey+1; ?>','unpublish');">
									<i class="fa fa-check"></i>
								</button>
    								<?php }else{ ?>
    								<button class="btn btn-danger btn-xs"
									onclick="return CIForm.ajaxaction('cb<?php echo $mainkey+1; ?>','publish');">
									<i class="fa fa-times"></i>
								</button>
    								<?php } ?> 
							</td>
   					           <?php
                                break;
                            default:
                                ?>
   					           <td><?php echo $value['value']; ?></td>
   					           <?php
                                break;
					   }
					   ?>
                    <?php } ?>
                    </tr>
					<?php } ?>
					<?php } ?>
				    </tbody>
					<div>
						<input type="hidden" name="frmaction"
							value="<?php echo site_url($form_list['action']); ?>" /> <input
							type="hidden" name="order" value="" /> <input type="hidden"
							name="direction" value="" />
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