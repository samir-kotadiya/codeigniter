<div class="row mt">
	<div class="col-lg-12">
		<div class="form-panel">
			<div class="alert alert-info col-sm-12 clearfix">
				<div class="col-sm-10">
					<h4 class="pull-left">contact Edit</h4>
				</div>
				<div class="col-sm-2">
					<button type="button" onclick="CIForm.submitform();"
						class="btn btn-primary">Save</button>
					<a class="btn btn-default"
						href="<?php echo site_url('admin/contact/contact'); ?>">Cancel</a>
					</button>
				</div>
			</div>
			<?php if(!empty($this->session->flashdata('contact'))){ 
			    $flash = $this->session->flashdata('contact');
			    ?>
                                    <div class="alert alert-<?php echo $flash['type']; ?>"><?php echo $flash['message'];; ?><button
						data-dismiss="alert" class="close" type="button">×</button>
				</div>
                                <?php } ?>
			<form id="adminForm" class="form-horizontal style-form" method="post" enctype="multipart/form-data">
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Name</label>
					<div class="col-sm-10">
						<input type="text" name="ciform[name]" class="form-control" placeholder="Enter Name" value="<?php echo $contact->name; ?>">
							
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10">
						<input type="text" name="ciform[email]" class="form-control" placeholder="Enter Email Address" value="<?php echo $contact->email; ?>">
							
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Phone No</label>
					<div class="col-sm-10">
						<input type="text" name="ciform[phone_no]" class="form-control" placeholder="Enter Phone No" value="<?php echo $contact->phone_no; ?>">
							
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Content</label>
					<div class="col-sm-10">
						<textarea name="ciform[message]" class="form-control" placeholder="message" rows="5"> <?php echo $contact->message; ?> </textarea>
							
					</div>
				</div>
					

				
				<input type="hidden" name="ciform[id]" value="<?php echo $contact->id; ?>" />
			<!-- 	<input type="hidden" name="ciform[user_id]" value="<?php //echo $contact->created_by; ?>" /> -->
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