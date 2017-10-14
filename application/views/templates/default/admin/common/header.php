<!DOCTYPE html>
<html lang="en">
<head>
<title>Bootstrap Example</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet"
	href="<?php echo base_url(); ?>application/views/assets/css/bootstrap.min.css">
<link
	href="<?php echo base_url(); ?>application/views/assets/css/font-awesome.css"
	rel="stylesheet" />
<link rel="stylesheet"
	href="<?php echo base_url(); ?>application/views/assets/css/admin.css">

<?php foreach ($styles as $style){ ?>
<link rel="stylesheet"
	href="<?php echo base_url(); ?>application/views/assets/css/<?php echo $style; ?>">
<?php } ?>

<script
	src="<?php echo base_url(); ?>application/views/assets/js/jquery.min.js"></script>
<script
	src="<?php echo base_url(); ?>application/views/assets/js/bootstrap.min.js"></script>
<script
	src="<?php echo base_url(); ?>application/views/assets/js/jquery.dcjqaccordion.2.7.js"></script>

<script
	src="<?php echo base_url(); ?>application/views/assets/js/admin.js"></script>
<?php foreach ($scripts as $script){ ?>
<script
	src="<?php echo base_url(); ?>application/views/assets/js/<?php echo $script; ?>"></script>
<?php } ?>
</head>
<body>
	<section id="container">
		<header class="header black-bg">
			<div class="sidebar-toggle-box">
				<div class="fa fa-bars tooltips" data-placement="right"
					data-original-title="Toggle Navigation"></div>
			</div>
			<!--logo start-->
			<a href="<?php echo site_url('admin/common/dashboard'); ?>" class="logo"><b>Admin</b></a>
			<!--logo end-->
			<div class="nav notify-row" id="top_menu">
				<!--  notification start -->
				<ul class="nav top-menu">
					<!-- settings start -->
					<li class="dropdown"><a data-toggle="dropdown"
						class="dropdown-toggle" href="index.html#"> <i class="fa fa-tasks"></i>
							<span class="badge bg-theme">4</span>
					</a>
						<ul class="dropdown-menu extended tasks-bar">
							<div class="notify-arrow notify-arrow-green"></div>
							<li>
								<p class="green">You have 4 pending tasks</p>
							</li>
							<li><a href="index.html#">
									<div class="task-info">
										<div class="desc">DashGum Admin Panel</div>
										<div class="percent">40%</div>
									</div>
									<div class="progress progress-striped">
										<div class="progress-bar progress-bar-success"
											role="progressbar" aria-valuenow="40" aria-valuemin="0"
											aria-valuemax="100" style="width: 40%">
											<span class="sr-only">40% Complete (success)</span>
										</div>
									</div>
							</a></li>
							<li><a href="index.html#">
									<div class="task-info">
										<div class="desc">Database Update</div>
										<div class="percent">60%</div>
									</div>
									<div class="progress progress-striped">
										<div class="progress-bar progress-bar-warning"
											role="progressbar" aria-valuenow="60" aria-valuemin="0"
											aria-valuemax="100" style="width: 60%">
											<span class="sr-only">60% Complete (warning)</span>
										</div>
									</div>
							</a></li>
							<li><a href="index.html#">
									<div class="task-info">
										<div class="desc">Product Development</div>
										<div class="percent">80%</div>
									</div>
									<div class="progress progress-striped">
										<div class="progress-bar progress-bar-info" role="progressbar"
											aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
											style="width: 80%">
											<span class="sr-only">80% Complete</span>
										</div>
									</div>
							</a></li>
							<li><a href="index.html#">
									<div class="task-info">
										<div class="desc">Payments Sent</div>
										<div class="percent">70%</div>
									</div>
									<div class="progress progress-striped">
										<div class="progress-bar progress-bar-danger"
											role="progressbar" aria-valuenow="70" aria-valuemin="0"
											aria-valuemax="100" style="width: 70%">
											<span class="sr-only">70% Complete (Important)</span>
										</div>
									</div>
							</a></li>
							<li class="external"><a href="#">See All Tasks</a></li>
						</ul></li>
					<!-- settings end -->
					<!-- inbox dropdown start-->
					<li id="header_inbox_bar" class="dropdown"><a
						data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
							<i class="fa fa-envelope-o"></i> <span class="badge bg-theme"><?php echo count($notifications); ?> </span>
					</a>
						<ul class="dropdown-menu extended inbox">
							<div class="notify-arrow notify-arrow-green"></div>
							<li>
								<p class="green"><?php echo "You have ".count($notifications)." new messages" ;?> </p>
							</li>

							<?php

							 foreach ($notifications as $key => $value) {

							 ?>
							<li><a href="<?php 	echo base_url('admin/contact/contact/edit/id/'.$value['id'])?>"> <span class="subject">
							<span class="from"><?php echo $value['name']; ?></span> 
								<span class="time">Just now</span>
								</span> <span class="message"> <?php echo  substr($value['message'],3,10)."..."; ?> </span>
							</a></li>


							<?php }?>

							
							<li><a href="<?php 	echo base_url('admin/contact/contact')?>">See all messages</a></li>
						</ul></li>
					<!-- inbox dropdown end -->
				</ul>
				<!--  notification end -->
			</div>
			<div class="top-menu">
				<ul class="nav pull-right top-menu">
				    <li><a href="<?php echo site_url(); ?>" target="blank" class="viewsite tooltips" data-original-title="View site" data-placement="bottom"> <i class="fa fa-home"></i></a></li>
					<li><a class="logout" href="<?php echo site_url('admin/common/user/logout'); ?>"><i class="fa fa-sign-out"></i></a></li>
				</ul>
			</div>
		</header>
		<!--header end-->

		<!--sidebar start-->
		<?php //echo '<pre>';print_r($menus);exit; ?>
		<aside>
			<div id="sidebar" class="nav-collapse ">
				<!-- sidebar menu start-->
				<ul class="sidebar-menu" id="nav-accordion">
				
				    <?php 
				        foreach ($menus as $menu){
				            $submenu = count($menu['childs']);
				            $parentmenu = ($submenu > 0)?'sub-menu':'';
				            $innermenu = ($submenu > 0)?'sub':'';
				            $activeclass = (site_url($this->uri->uri_string) == $menu['url'])?'active':'';
				            ?>
				            <li class="<?php echo $parentmenu; ?>">
				                <a class="<?php echo $activeclass; ?>"  href="<?php echo $menu['url']; ?>"> 
				                    <span><?php echo $menu['label']; ?></span>
				                    <i class="pull-right fa <?php echo $menu['icon']; ?>"></i>
				                </a>
				                <?php 
				                    if(($submenu > 0)){
				                        ?>
				                        <ul class="<?php echo $innermenu; ?>">
				                            <?php 
				                                foreach ($menu['childs'] as $child){
				                                    ?>
				                                    <li><a href="<?php echo $child['url']; ?>"><?php echo $child['label']; ?></a></li>
				                                    <?php 
				                                }
				                            ?>
                						</ul>
				                        <?php
				                    }
				                ?>
				            </li>
				            <?php 
				        }
				    ?>

				</ul>
				<!-- sidebar menu end-->
			</div>
		</aside>
		<!--sidebar end-->