<?php /* Smarty version 3.1.24, created on 2015-09-14 14:38:45
         compiled from "/var/www/projects/Efterfragan/application/modules/newsletter/tmpl/default.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:146211614755f68e9daf3991_20482149%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '466cc81bb74b44dbfdbdead866d93c4952e4bec9' => 
    array (
      0 => '/var/www/projects/Efterfragan/application/modules/newsletter/tmpl/default.tpl',
      1 => 1441169785,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '146211614755f68e9daf3991_20482149',
  'variables' => 
  array (
    'url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55f68e9db504a2_72579935',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55f68e9db504a2_72579935')) {
function content_55f68e9db504a2_72579935 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '146211614755f68e9daf3991_20482149';
?>
<div class="newslettermod">
	<div id="wrapper">
		<div class="col-sm-8 pull-left">
			<h3>Newsletter</h3>
			<div class="bottom_border"></div>
			<form class="newsletterform" id="newletterform" action="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
" method="post">
			<div class="form-group">
		
			<div class="col-xs-10">
						<input class="newsbox" type="text" name="email" placeholder="Email Address" />
							<input class="submit" type="submit" name="Sign Up" value="Sign Up" />
			</div>
			</div>
	
			
			</form>
		</div>
		<div class="col-sm-4 pull-right getintouch">
		<h3>Get in touch</h3>
			<div class="bottom_border"></div>
			<div class="gettouch_ico">
				<ul class="touch_ico">
					<li class="first"><a href="#"><div class="social_links facebook_link_image"></div></a></li>
					<li><a href="#"><div class="social_links pintrest_link_image"></div></a></li>
					<li><a href="#"><div class="social_links twitter_link_image"></div></a></li>
					<li class="gplus"><a href="#"><div class="social_links google_plus_link_image"></div></a></li>
				</ul>
			</div>
		</div>
		
	</div>
</div>

<?php echo '<script'; ?>
>
$(document).ready(function() {
    $('#newletterform').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            newsletter: {
                validators: {
                    emailAddress: {
                        message: ' '
                    }
                }
            }
        }
    });
});
<?php echo '</script'; ?>
><?php }
}
?>