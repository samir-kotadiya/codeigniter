<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Bootstrap Example</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
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
	src="<?php echo $baseurl; ?>application/views/assets/js/jquery.min.js"></script>
<script
	src="<?php echo $baseurl; ?>application/views/assets/js/bootstrap.min.js"></script>
<script
	src="<?php echo $baseurl; ?>application/views/assets/js/template.js"></script>
<?php foreach ($scripts as $script){ ?>
<script
	src="<?php echo $baseurl; ?>application/views/assets/js/<?php echo $script; ?>"></script>
<?php } ?>
</head>
<body>
	<div class="container-fluid">
		<div class="container-fluid topwrapper">
			<div class="page-content">
				<div id="wrapper">
        		<?php echo $content; ?>
            </div>
			</div>
		</div>
	</div>
</body>
</html>
