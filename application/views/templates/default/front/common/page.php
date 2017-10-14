<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php echo $header; ?>

<div class="bd">
	<div class="page-top-wrapper">
		<div id="wrapper">
			<?php echo $top_wrapper; ?>
		</div>
	</div>
	
	<div class="page-top">
		<?php echo $top; ?>
	</div>

	<div class="main-container">
    	<div class="page-left">
    		<?php echo $left; ?>
    	</div>
    
    	<div class="page-content">
    		<div id="wrapper">
    			<div class="flashcontainer">
			    	<?php $messages = $this->session->flashdata('flash_messages'); ?>
				    <?php 
				       if(!empty($messages)){
				           foreach ($messages as $message){
				           ?>
			    	           <div class="alert alert-<?php echo $message['type']; ?>">
			    	               <?php echo $message['message']; ?> 
			    	           <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button></div>
				           <?php
				           }
				       }
				    ?>
			    </div>
    		
    			<?php if(isset($title)){ ?>
    			 <h1><?php echo $title; ?></h1>
    			<?php } ?>
    			<?php echo $content; ?>
    			<input type="hidden" id="global_site_url" value="<?php echo site_url(); ?>" />
    	    </div>
    	</div>
    
    	<div class="page-right">
    		<?php echo $right; ?>
    	</div>
    </div>

	<div class="page-bottom-wrapper">
		<div id="wrapper">
			<?php echo $bottom_wrapper; ?>
		</div>
	</div>
	
	<div class="page-bottom">
	   <?php echo $bottom; ?>
	</div>
</div>
<a href="#0" class="cd-top cd-is-visible cd-fade-out">Top</a>
<?php echo $footer; ?>