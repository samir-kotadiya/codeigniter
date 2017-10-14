<div class="col-xs-12 blog_listing">
   <div class="col-xs-1 posting_det">
	  <!--<span class="glyphicon glyphicon-time"></span>-->
	  <?php $date = date_create($blog['created_date']); ?>
      <?php //echo date_format($date, 'l, j F Y, g:ia'); ?>
	  <div class="blog_day blog_post_detail"> <?php echo date_format($date, 'l'); ?></div>
		 <div class="blog_date blog_post_detail"> <?php echo date_format($date, 'j F'); ?></div>
		 <div class="blog_year blog_post_detail"> <?php echo date_format($date, 'Y'); ?></div>
   </div>
      <div class="col-xs-11">
   <div class="col-xs-12">
		<b><span class="text-style"><?php echo ucfirst($blog['name']) ?></span></b>	
	</div>
	
	<div class="col-xs-12">
	   <img class="img-responsive" alt="" src="<?php echo $blog['image']; ?>">	
	</div>
	
	<div class="col-xs-12 written_by">
	  <span class="glyphicon glyphicon-pencil"></span> Written by <b><?php echo  ucfirst($blog['Created_By']) ?></b>
	</div>
	
	<div class="col-xs-12">
        <b><span class="blog-link"><?php echo $blog['description'];  ?></span>
	</div>
	
	<div class="fb-comments" data-href="<?php echo site_url('blogs/blog/view/id/'.$blog['id']); ?>" data-version="v2.3"></div>
	
	<div class="col-xs-12">
		 <hr class="hr-style" />
	</div>
	</div>
</div>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=522695217881435";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>