<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php echo $header; ?>

<section id="main-content">
	<section class="wrapper site-min-height">
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
		<?php echo $content; ?>
	</section>
</section>

<?php echo $footer; ?>