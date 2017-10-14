<!DOCTYPE html>
<html lang="en">
<head>
<title>Bootstrap Example</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<link rel="stylesheet"
	href="<?php echo $baseurl; ?>application/views/assets/css/bootstrap.min.css">
<link rel="stylesheet"
	href="<?php echo $baseurl; ?>application/views/assets/css/font-awesome.min.css">
<link rel="stylesheet"
	href="<?php echo $baseurl; ?>application/views/assets/css/template.css">
<?php foreach ($styles as $style){ ?>
<link rel="stylesheet"
	href="<?php echo $baseurl; ?>application/views/assets/css/<?php echo $style; ?>">
<?php } ?>

<script
	src="<?php echo $baseurl; ?>application/views/assets/js/jquery.min.js" type="text/javascript"></script>
<script
	src="<?php echo $baseurl; ?>application/views/assets/js/bootstrap.min.js" type="text/javascript" defer></script>
<script
	src="<?php echo $baseurl; ?>application/views/assets/js/template.js" type="text/javascript" defer></script>
<?php foreach ($scripts as $script){ ?>
<script
	src="<?php echo $baseurl; ?>application/views/assets/js/<?php echo $script; ?>" type="text/javascript" defer></script>
<?php } ?>
</head>
<body>
<div class="container-fluid">
	<div class="container-fluid topwrapper">
		
		<?php 
		$controller = get_instance();
		?>
		
		<!-- top social area -->
		<div class="col-xs-12 topsocial hidden-print">
			<div id="wrapper">
				<div class="socialico pull-left col-sm-3">
					<ul class="social_list">
						<li class="facebook"><a href="#"><?php echo img(array('src'=>'application/images/facebook.png','width'=>16,'height'=>16));?></a></li>
						<li class="gplus"><a href="#"><?php echo img(array('src'=>'application/images/google_plus.png','width'=>16,'height'=>16));?></a></li>
						<li class="twitter"><a href="#"><?php echo img(array('src'=>'application/images/twitter.png','width'=>16,'height'=>16)); ?></a></li>
					</ul>
				</div>
				<div class="rightlinks pull-right col-sm-6">
					<ul class="toplinks">
						    <?php
							$sessiondata=$this->session->userdata('user');
                			if(isset($sessiondata))
                			{ ?>
                				<li class="login first " ><a href="<?php echo site_url('users/dashboard/account'); ?>">My Profile</a></li>
                				<li><a class="logout" href="<?php echo site_url('common/login/logout'); ?>">Log Out</i></a></li>
                			<?php }else
                			{ ?>
	                			<li class="login first " ><a href=" javascript:void(0);" class="common">Login</a></li>
								<li class="register" ><a href=" javascript:void(0);" class="common">Register</a></li>
						    <?php }	?>
						    <li class="contactus last"><a href="<?php echo site_url('common/contact'); ?>">Contact Us</a></li>
					</ul><br>
					<div class="col-xs-12 dropdowndiv" id="dropdown">
							<form action=" <?php echo site_url('common/login/login') ?>" method="post">
							<div class="col-xs-6">
							<div class="col-xs-12">
								<h2 class="form-signin-heading">Please login</h2>
								<input type="text" class="form-control popup_field" name="username" placeholder="Email Address" required="" autofocus="" />
								<input type="password" class="form-control popup_field" name="password" placeholder="Password" required=""/>      
								<div class="checkbox checkbox-warning">
									<input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe">
									<label for="checkbox2">
									<div class="form_label">Remember me</div>	
								</label>
								</div>

								<button class="btn btn-lg btn-primary btn-block btn-style popup_btn" type="submit">Login</button>   
							</div>
							</div>	
							<div class="col-xs-6">
								<div class="col-xs-12">
								<div class="spacer_bottom_10"></div>
								<a href="<?php echo base_url()?>jobs/user/register/gid/3" class="btn btn-lg btn-primary btn-block btn-style col-xs-12 popup_btn">Job Seeker</a>
								<a href="<?php echo base_url()?>jobs/user/register/gid/2" class="btn btn-lg btn-primary btn-block btn-style col-xs-12 popup_btn">Employers</a>
								
								</div>		
							</div>
						</form>
					</div>
				</div>
				
			</div>
		</div>
		<div class="hidden-print">
		<!-- End of top social area -->
		
		<?php 
			$menus = array (
				array (
						'id' => 1,
						'title' => 'Home',
						'alias' => 'home',
						'link' => site_url () 
				),
				array (
						'id' => 2,
						'title' => 'Jobs',
						'alias' => 'job',
						'link' => site_url ( 'jobs/lists' ) 
				),
				array (
						'id' => 2,
						'title' => 'Resumes',
						'alias' => 'resume',
						'link' => site_url ( 'users/resumes' )
				),
				array (
						'id' => 3,
						'title' => 'Job Seeker Resources',
						'alias' => 'jobseeker',
						'link' => site_url ( 'users/dashboard/account' )
				),
				array (
						'id' => 4,
						'title' => 'Employer Resources',
						'alias' => 'employer',
						'link' => site_url ( 'users/dashboard/account' ),
						/* 'child' => array (
							array (
									'id' => 1,
									'title' => 'Action',
									'alias' => '',
									'link' => site_url ( '#' ) 
							),
							array (
									'id' => 2,
									'title' => 'Another action',
									'alias' => '',
									'link' => site_url ( '#' ) 
							),
							array (
									'id' => 3,
									'title' => 'Something else here',
									'alias' => '',
									'link' => site_url ( '#' ) 
							),
							array (
									'id' => 3,
									'title' => 'Nav header',
									'alias' => '',
									'link' => site_url ( '#' ) 
							),
							array (
									'id' => 3,
									'title' => 'Separated link',
									'alias' => '',
									'link' => site_url ( '#' ) 
							) 
						)  */
				),
				array (
						'id' => 5,
						'title' => 'About Us',
						'alias' => 'aboutus',
						'link' => site_url ( 'common/aboutus' ) 
				),
				array (
						'id' => 6,
						'title' => 'Blog',
						'alias' => 'blog',
						'link' => site_url ( 'blogs/lists' ) 
				) 
		);
		?>
		
		<div id="header_container" class="clearfix">
			<div id="wrapper">
			<div class="logo col-sm-3 pull-left">
			<a href="<?php echo site_url(); ?>"><?php echo img('application/images/logo.png'); ?></a>
			</div>
			<div class="menubar col-sm-9 pull-right back_position">
			<nav class="navbar navbar-inverse menu-back">
				<div class="container-fluid">
				<!-- start -->
				<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>                        
				</button>
			
				</div>
				<!-- end -->
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav ">
						<?php foreach ($menus as $menu){ ?>
							<?php if(isset($menu['child']) && !empty($menu['child'])){ ?>
								<li class="<?php echo ($controller->menuitem == $menu['alias'])?'active':''; ?> dropdown">
									<a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="<?php echo $menu['link']; ?>"><?php echo $menu['title']; ?>
										<span class="caret"></span>
									</a>
									<ul role="menu" class="dropdown-menu">
										<?php foreach ($menu['child'] as $child){ ?>
											<li><a href="<?php echo $child['link']; ?>"><?php echo $child['title']; ?></a></li>
										<?php } ?>
									</ul>								
								</li>
							<?php }else{ ?>
								<li <?php echo ($controller->menuitem == $menu['alias'])?'class="active"':''; ?>><a href="<?php echo $menu['link']; ?>"><?php echo $menu['title']; ?></a></li>
							<?php } ?>
						<?php } ?>
					</ul>
				</div>
			</div>

		</nav>
		</div>
		</div>
		</div>
	</div>
<script> 
$(document).ready(function(){
    $(".common").click(function(){
        $("#dropdown").slideToggle("slow");
    });
});
$(document).ready(function() {

 $('.collapse').clone().removeClass('hidden-xs').appendTo('.mobile-menu');

 });
</script>