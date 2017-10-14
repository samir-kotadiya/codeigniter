<?php /* Smarty version 3.1.24, created on 2015-09-14 14:38:45
         compiled from "/var/www/projects/Efterfragan/application/modules/statistics/tmpl/default.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:99647269955f68e9d6d69d9_23472554%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1d382a4194e9fa26eabd3dc4b00e043833f354e5' => 
    array (
      0 => '/var/www/projects/Efterfragan/application/modules/statistics/tmpl/default.tpl',
      1 => 1441172177,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '99647269955f68e9d6d69d9_23472554',
  'variables' => 
  array (
    'title' => 0,
    'desc' => 0,
    'desc2' => 0,
    'totaljobs' => 0,
    'offers' => 0,
    'totaljobseekers' => 0,
    'resume' => 0,
    'totalemployes' => 0,
    'company' => 0,
    'totalmembers' => 0,
    'members' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55f68e9d718f45_06242805',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55f68e9d718f45_06242805')) {
function content_55f68e9d718f45_06242805 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '99647269955f68e9d6d69d9_23472554';
?>
<div class="col-xs-12">
   <div class="col-xs-12">
   	<div class="text-center state_title">
   		<h1 class="stats-overview"><span class="stats_title"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</span></h1>
   		<?php echo $_smarty_tpl->tpl_vars['desc']->value;?>
<br>
   		<?php echo $_smarty_tpl->tpl_vars['desc2']->value;?>
		
   	</div>
   </div>

<div class="col-xs-12 circle-padding">
	<div id="wrapper">
   		<div class="col-sm-3">
		   	<div class="col-sm-8">
		   	<div class="circle circle-border">
			     <div class="circle-inner">
			     <a href="<?php echo site_url('jobs/lists');?>
">
			         <div class="text-center text-style">
			         	<span class="glyphicon glyphicon-bullhorn text-style"><span class="left-spacer"><?php echo $_smarty_tpl->tpl_vars['totaljobs']->value;?>
</span></span><br>
			         	<?php echo $_smarty_tpl->tpl_vars['offers']->value;?>
		
			          </div>
			     </a>
			     </div>
		   </div>
    	   </div>
	</div>
   		<div class="col-sm-3">
		   	<div class="col-sm-8">
		   	<div class="circle circle-border">
			     <div class="circle-inner">
			     <a href="<?php echo site_url('users/resumes');?>
">
			         <div class="text-center text-style">
			            <span class="glyphicon glyphicon-file text-style"><span class="left-spacer"><?php echo $_smarty_tpl->tpl_vars['totaljobseekers']->value;?>
</span></span><br>
			            <?php echo $_smarty_tpl->tpl_vars['resume']->value;?>
		
			          </div>
			     </a>
			     </div>
		   </div>
    	   </div>
    </div>
    <div class="col-sm-3">
	   	<div class="col-sm-8">
		   	<div class="circle circle-border">
			     <div class="circle-inner">
			     <a href="<?php echo site_url('users/companies');?>
">
			         <div class="text-center text-style">
			       		 <div class="text-center text-style">
				            <span class="glyphicon glyphicon-briefcase text-style"><span class="left-spacer"><?php echo $_smarty_tpl->tpl_vars['totalemployes']->value;?>
</span></span><br>
				            <?php echo $_smarty_tpl->tpl_vars['company']->value;?>
		
				          </div>
			         </div>
			     </a>
			     </div>
		   </div>
	   </div>
    </div>
    	<div class="col-sm-3">
		   	<div class="col-sm-8">
		   	<div class="circle circle-border">
			     <div class="circle-inner">
			         <div class="text-center text-style">
			            <span class="glyphicon glyphicon-user text-style"><span class="left-spacer"><?php echo $_smarty_tpl->tpl_vars['totalmembers']->value;?>
</span></span><br>
			            <?php echo $_smarty_tpl->tpl_vars['members']->value;?>
		
			          </div>
			     </div>
		   </div>
    	   </div>
    </div>
	</div>	
</div>
</div><?php }
}
?>