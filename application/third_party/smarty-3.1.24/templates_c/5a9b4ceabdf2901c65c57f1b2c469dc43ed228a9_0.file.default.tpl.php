<?php /* Smarty version 3.1.24, created on 2015-06-20 18:22:24
         compiled from "/var/www/projects/codeIgniter/application/modules/newsletter/tmpl/default.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:564787254558562083b1ef6_49022635%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5a9b4ceabdf2901c65c57f1b2c469dc43ed228a9' => 
    array (
      0 => '/var/www/projects/codeIgniter/application/modules/newsletter/tmpl/default.tpl',
      1 => 1434365233,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '564787254558562083b1ef6_49022635',
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_558562083b4e95_03573601',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_558562083b4e95_03573601')) {
function content_558562083b4e95_03573601 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '564787254558562083b1ef6_49022635';
?>
<div class="newslettermod">
	<div id="wrapper">
		<div class="col-sm-8 pull-left">
			<h3>Newsletter</h3>
			<div class="bottom_border"></div>
			<form class="newsletterform">
				<input class="newsbox" type="text" name="newsletter" placeholder="Email Address" />
				<input class="submit" type="submit" name="Sign Up" value="Sign Up" />
			</form>
		</div>
		<div class="col-sm-4 pull-right">
		<h3>Get in touch</h3>
			<div class="bottom_border"></div>
			<div class="gettouch_ico">
				<ul class="touch_ico">
					<li class="first"><a href="#"><img src="application/images/facebook_orange.png" /></a></li>
					<li><a href="#"><img src="application/images/pintrest_orange.png" /></a></li>
					<li><a href="#"><img src="application/images/twitter_orange.png" /></a></li>
					<li><a href="#"><img src="application/images/google_plus_orange.png" /></a></li>
					<li class="last"><a href="#"><img src="application/images/rss_orange.png" /></a></li>
				</ul>
			</div>
		</div>
		
	</div>
</div><?php }
}
?>