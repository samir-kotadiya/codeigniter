<?php 
defined('BASEPATH') or exit('No direct script access allowed');

foreach ($blogs as $key => $value){
    ?>
    <div class="col-xs-12 blog_listing">
	   <div class="col-xs-1 posting_det">
		  <!--<span class="glyphicon glyphicon-time"></span>-->
		  <?php $date = date_create($value['created_date']); ?>
          <?php //echo date_format($date, 'l, j F Y, g:ia'); ?> 
		 <div class="blog_day blog_post_detail"> <?php echo date_format($date, 'l'); ?></div>
		 <div class="blog_date blog_post_detail"> <?php echo date_format($date, 'j F'); ?></div>
		 <div class="blog_year blog_post_detail"> <?php echo date_format($date, 'Y'); ?></div>
	   </div>
	   <div class="col-xs-11">
	   
	   <div class="col-xs-12 blog_name">
			<a href="<?php echo site_url("blogs/blog/view/id/{$value['id']}"); ?>" class="blog-link"><span class="text-style"><?php echo ucfirst($value['name']) ?></span></a>	
		</div>
		
		<div class="col-xs-12 blog_image">
		  <a href="<?php echo site_url("blogs/blog/view/id/{$value['id']}"); ?>" class="blog-link"><img class="img-responsive" alt="" src="<?php echo $value['image']; ?>">	</a>
    	</div>
    	
    	<div class="col-xs-12 written_by">
		  <span class="glyphicon glyphicon-pencil"></span><?php echo $lbl_writtenby; ?> <b><?php echo  ucfirst($value['Created_By']) ?></b>
    	</div>
    	
    	<div class="col-xs-12">
            <b><span class="blog-link"><?php echo  substr($value['description'],3,200)."...";  ?></span>
            <br>
            <b><a href="<?php echo site_url("blogs/blog/view/id/{$value['id']}"); ?>" class="blog-link btn btn-sm readmore"><?php echo $lbl_readmore ?></a></b>
    	</div>
    	
    	<div class="col-xs-12">
			 <hr class="hr-style" />
		</div>
		</div>
	</div>
    <?php 
}
?>


