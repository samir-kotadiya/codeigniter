<div class="row mt">
	<div class="col-lg-12">
		<div class="form-panel">
			<div class="alert alert-info col-sm-12 clearfix">
				<div class="col-sm-10">
					<h4 class="pull-left">Tstimonial Edit</h4>
				</div>
				<div class="col-sm-2">
					<button type="button" onclick="CIForm.submitform();"
						class="btn btn-primary">Save</button>
					<a class="btn btn-default"
						href="<?php echo site_url('admin/testimonial/testimonial'); ?>">Cancel</a>
					</button>
				</div>
			</div>
			<?php if(!empty($this->session->flashdata('testimonial'))){ 
			    $flash = $this->session->flashdata('testimonial');
			    ?>
                                    <div class="alert alert-<?php echo $flash['type']; ?>"><?php echo $flash['message'];; ?><button
						data-dismiss="alert" class="close" type="button">×</button>
				</div>
                                <?php } ?>
			<form id="adminForm" class="form-horizontal style-form" method="post" enctype="multipart/form-data">
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Content</label>
					<div class="col-sm-10">
						<textarea name="ciform[content]" class="form-control" placeholder="description" rows="5"> <?php echo $testimonial->content; ?> </textarea>
							
					</div>
				</div>
					<div class="form-group">
					<label class="col-sm-2 control-label">User </label>
					<div class="col-sm-10">
						
						<select name="ciform[user_id]" class="form-control m-b">
						  
						    <?php foreach($users as $cat){   

						        ?>
						        <option <?php echo ($testimonial->user_id == $cat['id'])?'selected="select"':''; ?> value="<?php echo $cat['id']; ?>"><?php echo $cat['username']; ?></option>
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
								<?php echo ($testimonial->published == 1)?'checked="checked"':''; ?> />
						</div>
					</div>
				</div>
				
				<input type="hidden" name="ciform[id]" value="<?php echo $testimonial->id; ?>" />
			<!-- 	<input type="hidden" name="ciform[user_id]" value="<?php //echo $testimonial->created_by; ?>" /> -->
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