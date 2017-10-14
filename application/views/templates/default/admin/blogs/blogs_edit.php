<div class="row mt">
	<div class="col-lg-12">
		<div class="form-panel">
			<div class="alert alert-info col-sm-12 clearfix">
				<div class="col-sm-10">
					<h4 class="pull-left">Blogs Edit</h4>
				</div>
				<div class="col-sm-2">
					<button type="button" onclick="CIForm.submitform();"
						class="btn btn-primary">Save</button>
					<a class="btn btn-default"
						href="<?php echo site_url('admin/blogs/blogs'); ?>">Cancel</a>
					</button>
				</div>
			</div>
			<?php if(!empty($this->session->flashdata('blogs'))){ 
			    $flash = $this->session->flashdata('blogs');
			    ?>
                                    <div class="alert alert-<?php echo $flash['type']; ?>"><?php echo $flash['message'];; ?><button
						data-dismiss="alert" class="close" type="button">×</button>
				</div>
                                <?php } ?>
			<form id="adminForm" class="form-horizontal style-form" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sm-2 control-label">Name</label>
					<div class="col-sm-10">
						<input type="text" name="ciform[name]" class="form-control"
							value="<?php echo $blogs->name; ?>" placeholder="Name">
							<?php echo form_error('ciform[name]'); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Description</label>
					<div class="col-sm-10">
						<textarea name="ciform[description]" class="form-control" placeholder="description" rows="5"> <?php echo $blogs->description; ?> </textarea>
							
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Photo</label>
					<div class="col-sm-10">
						<input type="file" name="image" class="form-control file">
							<br>
							<?php
							if(isset($blogs->image))
							{
								$image_properties = array(
								    'src' => 'application/'.$blogs->image,
								    'width' => '70',
								    'height' => '70'
									);
								echo img($image_properties); 
							}	
								?>

					</div>
				</div>

			<div class="form-group">
					<label class="col-sm-2 control-label">Category</label>
					<div class="col-sm-10">
						
						<select name="ciform[category_id]" class="form-control m-b">
						  
						    <?php foreach($category as $group){
						        ?>
						        <option <?php echo ($blogs->category_id == $group['id'])?'selected="select"':''; ?> value="<?php echo $group['id']; ?>"><?php echo $group['title']; ?></option>
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
								<?php echo ($blogs->published == 1)?'checked="checked"':''; ?> />
						</div>
					</div>
				</div>
				
				<input type="hidden" name="ciform[id]" value="<?php echo $blogs->id; ?>" />
				<input type="hidden" name="ciform[created_by]" value="<?php echo $blogs->created_by; ?>" />
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