<?php /* Smarty version 3.1.24, created on 2015-09-14 14:38:46
         compiled from "/var/www/projects/Efterfragan/application/modules/latestnews/tmpl/default.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:94408539755f68e9e280f25_58208927%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a7dc44a706cc6454f40a0a9de9fd6523d4aa698b' => 
    array (
      0 => '/var/www/projects/Efterfragan/application/modules/latestnews/tmpl/default.tpl',
      1 => 1440061981,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '94408539755f68e9e280f25_58208927',
  'variables' => 
  array (
    'title' => 0,
    'message' => 0,
    'latestnews' => 0,
    'value' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55f68e9e2b9ea8_08313638',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55f68e9e2b9ea8_08313638')) {
function content_55f68e9e2b9ea8_08313638 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '94408539755f68e9e280f25_58208927';
?>
<div class="row mt col-xs-12 latestnewsmodule">
	<div class="row mt col-xs-12">
		<center>
			<h2><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h2>
			<div class="latestnews_msg"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
		</center>
	</div>
<div class="col-xs-12">

	<?php
$_from = $_smarty_tpl->tpl_vars['latestnews']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['value']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
$foreach_value_Sav = $_smarty_tpl->tpl_vars['value'];
?>
		<div class="col-sm-4">
		<div class="col-xs-12"><?php echo $_smarty_tpl->tpl_vars['value']->value['images'];?>
</div>
		<div class="col-xs-12 news_title"><h2><a href=<?php echo $_smarty_tpl->tpl_vars['value']->value['link'];?>
><?php echo $_smarty_tpl->tpl_vars['value']->value['name'];?>
</a></h2></div>
		<div class="col-xs-12 newsdate"><h5><span class="glyphicon glyphicon-calendar"><span class="default_font"> <?php echo $_smarty_tpl->tpl_vars['value']->value['created_date'];?>
 </span></span></h5></div>
		<div class="col-xs-12 news_desc"><?php echo $_smarty_tpl->tpl_vars['value']->value['description'];?>
</div>
		<div class="col-xs-12 newsreadmore"><a href=<?php echo $_smarty_tpl->tpl_vars['value']->value['link'];?>
><div class="btn btn-sm btn-warning readmore" type="submit">Read More</div></a></div>
		</div>
	<?php
$_smarty_tpl->tpl_vars['value'] = $foreach_value_Sav;
}
?>

</div>
</div>
<?php }
}
?>