<?php /* Smarty version 3.1.24, created on 2015-09-14 14:38:45
         compiled from "/var/www/projects/Efterfragan/application/modules/recentjobs/tmpl/default.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:192882637655f68e9de17847_61968070%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e2450abe866b713b1325a0880f30f238788ec554' => 
    array (
      0 => '/var/www/projects/Efterfragan/application/modules/recentjobs/tmpl/default.tpl',
      1 => 1438670489,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '192882637655f68e9de17847_61968070',
  'variables' => 
  array (
    'title' => 0,
    'recentjobs' => 0,
    'value' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55f68e9de60db7_19051443',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55f68e9de60db7_19051443')) {
function content_55f68e9de60db7_19051443 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '192882637655f68e9de17847_61968070';
?>
<div class="recentjobscontainer row mt col-sm-8">
	<h2><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h2>
	<div class="bottom_border"></div>
	<div class="recentjobs col-xs-12">
	<?php
$_from = $_smarty_tpl->tpl_vars['recentjobs']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['value']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
$foreach_value_Sav = $_smarty_tpl->tpl_vars['value'];
?>
		   <div class="jobrow col-xs-12">
		   	 	<div class="col-sm-2">
					 <?php echo $_smarty_tpl->tpl_vars['value']->value['logo'];?>
		 
			    </div>
				
			    <div class="col-sm-3 rec_job_val_title rec_job_align_single">
			    	<b><a class="job_title" href=<?php echo $_smarty_tpl->tpl_vars['value']->value['link'];?>
><?php echo $_smarty_tpl->tpl_vars['value']->value['title'];?>
	</a></b> <br/>
					<?php echo $_smarty_tpl->tpl_vars['value']->value['company'];?>

			    </div>
		         
			     <div class="col-sm-2 rec_job_city rec_job_align_single">
			     	<span class="glyphicon glyphicon-map-marker">
				 		<span class="default_font"><?php echo $_smarty_tpl->tpl_vars['value']->value['name'];?>
</span>
				 	</span>
			     </div>
				 
			      <div class="col-sm-2 rec_job_align_single">
				 	<span class="glyphicon glyphicon-time">
				 		<span class="default_font"><?php echo $_smarty_tpl->tpl_vars['value']->value['jobtype'];?>
</span>
					</span>
			     </div>
				 
			      <div class="col-sm-3 rec_job_align_single">
				  	<span class="glyphicon glyphicon-usd">
				  		<span class="default_font"><?php echo $_smarty_tpl->tpl_vars['value']->value['min_salary'];?>
-<?php echo $_smarty_tpl->tpl_vars['value']->value['max_salary'];?>
</span>
				  	 </span>
			     </div>
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