<?php /* Smarty version 3.1.24, created on 2015-09-14 14:38:45
         compiled from "/var/www/projects/Efterfragan/application/modules/testimonials/tmpl/default.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:164832548055f68e9da77f95_96192552%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a1453647dcfdc212a780024310e01d6f9da47110' => 
    array (
      0 => '/var/www/projects/Efterfragan/application/modules/testimonials/tmpl/default.tpl',
      1 => 1438671285,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '164832548055f68e9da77f95_96192552',
  'variables' => 
  array (
    'title' => 0,
    'tagline' => 0,
    'testimonials' => 0,
    'value' => 0,
    'link' => 0,
    'readall' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55f68e9dab48e9_04490643',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55f68e9dab48e9_04490643')) {
function content_55f68e9dab48e9_04490643 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '164832548055f68e9da77f95_96192552';
?>
<div class="row mt col-xs-12 testimonials_module">
	<div id="wrapper">
		<div class="row mt col-xs-12">
			<center>
				<h2><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h2>
				<div class="testimonial_msg"><?php echo $_smarty_tpl->tpl_vars['tagline']->value;?>
</div>
			</center>
		</div>
		<div class="col-xs-12 testimonial_list">
			<?php
$_from = $_smarty_tpl->tpl_vars['testimonials']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['value']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
$foreach_value_Sav = $_smarty_tpl->tpl_vars['value'];
?>
				<div class="col-sm-6">
					<div class="col-sm-3"><img src="<?php echo $_smarty_tpl->tpl_vars['value']->value['logo'];?>
"></div>
					<div class="col-sm-9">
						<div class="testimonial_content"><?php echo $_smarty_tpl->tpl_vars['value']->value['content'];?>
</div>
						<div class="testimonial_authore"><?php echo $_smarty_tpl->tpl_vars['value']->value['firstname'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['value']->value['lastname'];?>
</div>
						<div class="testimonial_company"><?php echo $_smarty_tpl->tpl_vars['value']->value['company'];?>
</div>
					</div>
				</div>
			<?php
$_smarty_tpl->tpl_vars['value'] = $foreach_value_Sav;
}
?>
		</div>
		<div class="col-xs-12">
			<center><a class="btn btn-default" href="<?php echo $_smarty_tpl->tpl_vars['link']->value;?>
" role="button"><?php echo $_smarty_tpl->tpl_vars['readall']->value;?>
</a></center>
		</div>
	</div>
</div>
<?php }
}
?>