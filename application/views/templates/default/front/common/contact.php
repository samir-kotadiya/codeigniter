<div class="wrapper">
<div class="row">
<div class="col-xs-6 leftcontact">
		
<?php if(!empty($this->session->flashdata('success_message'))){ ?>
                                    <div class="alert alert-success">
									<?php echo $this->session->flashdata('success_message'); ?>
                                    <button data-dismiss="alert" class="close" type="button">×</button>
									</div>
                                    
                                <?php } ?>
<?php if(!empty($this->session->flashdata('fail_message'))){ ?>
                <div class="alert alert-danger">
					<i class="fa fa-exclamation-circle"></i> <?php echo $this->session->flashdata('fail_message'); ?><button
						data-dismiss="alert" class="close" type="button">×</button>
				</div>
                                <?php } ?>

								<?php $this->load->view('templates/default/front/common/form'); ?>
		
	</div>
    
    
<div class="col-xs-6 googlemapright">
<?php
	
echo $map['js'];
echo $map['html'];
?>
</div>
</div>
</div>
</div>



