<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Login</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="<?php echo $baseurl; ?>application/views/assets/css/bootstrap.min.css">
<link rel="stylesheet"
	href="<?php echo $baseurl; ?>application/views/assets/css/font-awesome.css">
<link rel="stylesheet"
	href="<?php echo $baseurl; ?>application/views/assets/css/admin.css">

<script
	src="<?php echo $baseurl; ?>application/views/assets/js/jquery.min.js"></script>
<script
	src="<?php echo $baseurl; ?>application/views/assets/js/bootstrap.min.js"></script>
<script
	src="<?php echo $baseurl; ?>application/views/assets/js/template.js"></script>
</head>
<body>
	<div id="login-page">
		<div class="container">
	  	                        <?php
                            
                            $attributes = array(
                                "class" => "form-login",
                                "id" => "loginform",
                                "name" => "loginform"
                            );
                            ?>
		      <?php echo form_open("admin/common/user/process", $attributes); ?>
				<h2 class="form-login-heading">sign in now</h2>

			<div class="login-wrap">
			<?php if(!empty($this->session->flashdata('login'))){ ?>
                                    <div class="alert alert-danger">
					<i class="fa fa-exclamation-circle"></i> <?php echo $this->session->flashdata('login'); ?><button
						data-dismiss="alert" class="close" type="button">×</button>
				</div>
                                <?php } ?>
				<input type="text" class="form-control" name="username"
					placeholder="User ID" autofocus> <br> <input type="password"
					name="password" class="form-control" placeholder="Password"> <label
					class="checkbox"> <span class="pull-right"> <a data-toggle="modal"
						href="#myModal"> Forgot Password?</a>

				</span>
				</label>
				<button class="btn btn-theme btn-block" href="index.html"
					type="submit">
					<i class="fa fa-lock"></i> SIGN IN
				</button>

			</div>

			<!-- Modal -->
			<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog"
				tabindex="-1" id="myModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">&times;</button>
							<h4 class="modal-title">Forgot Password ?</h4>
						</div>
						<div class="modal-body">
							<p>Enter your e-mail address below to reset your password.</p>
							<input type="text" name="email" placeholder="Email"
								autocomplete="off" class="form-control placeholder-no-fix">

						</div>
						<div class="modal-footer">
							<button data-dismiss="modal" class="btn btn-default"
								type="button">Cancel</button>
							<button class="btn btn-theme" type="button">Submit</button>
						</div>
					</div>
				</div>
			</div>
			<!-- modal -->

			</form>

		</div>
	</div>
</body>
</html>