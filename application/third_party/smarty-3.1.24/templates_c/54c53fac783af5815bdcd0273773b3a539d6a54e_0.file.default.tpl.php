<?php /* Smarty version 3.1.24, created on 2015-06-20 18:22:24
         compiled from "/var/www/projects/codeIgniter/application/modules/slider/tmpl/default.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:8870397215585620838c959_58895117%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '54c53fac783af5815bdcd0273773b3a539d6a54e' => 
    array (
      0 => '/var/www/projects/codeIgniter/application/modules/slider/tmpl/default.tpl',
      1 => 1434432518,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8870397215585620838c959_58895117',
  'variables' => 
  array (
    'randomno' => 0,
    'slides' => 0,
    'slide' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_558562083adbf8_82727496',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_558562083adbf8_82727496')) {
function content_558562083adbf8_82727496 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '8870397215585620838c959_58895117';
ob_start();
echo rand(500,1000);
$_tmp1=ob_get_clean();
$_smarty_tpl->tpl_vars["randomno"] = new Smarty_Variable($_tmp1, null, 0);?> 
<ul class="bxslider<?php echo $_smarty_tpl->tpl_vars['randomno']->value;?>
">
	<?php
$_from = $_smarty_tpl->tpl_vars['slides']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['slide'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['slide']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['slide']->value) {
$_smarty_tpl->tpl_vars['slide']->_loop = true;
$foreach_slide_Sav = $_smarty_tpl->tpl_vars['slide'];
?>
		<li><img src="<?php echo base_url();
echo $_smarty_tpl->tpl_vars['slide']->value;?>
" alt="" /></li>	
	<?php
$_smarty_tpl->tpl_vars['slide'] = $foreach_slide_Sav;
}
?>
</ul>

<?php echo '<script'; ?>
>
$(document).ready(function(){
	$('.bxslider<?php echo $_smarty_tpl->tpl_vars['randomno']->value;?>
').bxSlider({
	  captions: false,
	  responsive:true,
	  pager:false
	});
});
<?php echo '</script'; ?>
><?php }
}
?>