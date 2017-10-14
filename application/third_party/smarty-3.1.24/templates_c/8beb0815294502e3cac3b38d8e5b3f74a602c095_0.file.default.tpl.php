<?php /* Smarty version 3.1.24, created on 2015-09-14 14:38:44
         compiled from "/var/www/projects/Efterfragan/application/modules/slider/tmpl/default.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:94937872155f68e9cdef117_88462294%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8beb0815294502e3cac3b38d8e5b3f74a602c095' => 
    array (
      0 => '/var/www/projects/Efterfragan/application/modules/slider/tmpl/default.tpl',
      1 => 1437027289,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '94937872155f68e9cdef117_88462294',
  'variables' => 
  array (
    'randomno' => 0,
    'slides' => 0,
    'slide' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55f68e9d02a072_88166987',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55f68e9d02a072_88166987')) {
function content_55f68e9d02a072_88166987 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '94937872155f68e9cdef117_88462294';
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
	  pager:false,
	  controls:false,
	  speed:800,
	  auto:true
	});
});
<?php echo '</script'; ?>
><?php }
}
?>