<?php /* Smarty version 3.1.24, created on 2015-09-14 14:38:46
         compiled from "/var/www/projects/Efterfragan/application/modules/featuredjobs/tmpl/default.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:132481157655f68e9e044541_52850554%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c383d2d3f6cf816b400a69c533049a68a386349b' => 
    array (
      0 => '/var/www/projects/Efterfragan/application/modules/featuredjobs/tmpl/default.tpl',
      1 => 1438670532,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '132481157655f68e9e044541_52850554',
  'variables' => 
  array (
    'title' => 0,
    'featuredjobs' => 0,
    'value' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55f68e9e0619e9_47937246',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55f68e9e0619e9_47937246')) {
function content_55f68e9e0619e9_47937246 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '132481157655f68e9e044541_52850554';
?>
<div class="row mt col-sm-4 pull-right featured_jobs">
<div class="col-lg-12">
	<h2><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h2>
	<div class="bottom_border"></div>
</div>
  <div class="col-lg-12">
    <ul class="featuredjobs">
      <?php echo $_smarty_tpl->tpl_vars['title']->value;?>

      <?php
$_from = $_smarty_tpl->tpl_vars['featuredjobs']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['value']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
$foreach_value_Sav = $_smarty_tpl->tpl_vars['value'];
?>
      <li>
        <div class="joblist"> 
			<div class="col-xs-12 featured_mod_img"> 
			<?php echo $_smarty_tpl->tpl_vars['value']->value['logo'];?>
 
			</div>
			
			<div class="col-xs-12 featured_jobs_status"> 
				<div class="feaured-jobtitle">
				<a href=<?php echo $_smarty_tpl->tpl_vars['value']->value['link'];?>
><b><?php echo $_smarty_tpl->tpl_vars['value']->value['title'];?>
</b></a>
				</div> 
				<div class="feaured-jobcompany">
				<?php echo $_smarty_tpl->tpl_vars['value']->value['company'];?>

				</div>
			</div>
			<div class="col-xs-12 featured_jobs_loc_container"> 
				<div class="col-xs-4"><span class="glyphicon glyphicon-map-marker"><span class="left-spacer"><span class="default_font"><?php echo $_smarty_tpl->tpl_vars['value']->value['cityname'];?>
</span></span></span> </span></div>
				<div class="col-xs-4 jobtype"><span class="glyphicon glyphicon-time"><span class="left-spacer"><span class="default_font"><?php echo $_smarty_tpl->tpl_vars['value']->value['jobtype'];?>
</span></span></span> </div>
				<div class="col-xs-4 featured_salary"><span class="glyphicon glyphicon-usd"><span class="left-spacer"><span class="default_font"><?php echo $_smarty_tpl->tpl_vars['value']->value['min_salary'];?>
-<?php echo $_smarty_tpl->tpl_vars['value']->value['max_salary'];?>
</span></span></span> </div>
			</div>
	        <div class="col-xs-12 featured_job_desc"> 
          		<?php echo $_smarty_tpl->tpl_vars['value']->value['description'];?>
 
			</div>
		</div>
      </li>
      <?php
$_smarty_tpl->tpl_vars['value'] = $foreach_value_Sav;
}
?>
    </ul>
  </div>
  <?php echo '<script'; ?>
 type="text/javascript">
	$(document).ready(function(){
	  	$('.featuredjobs').bxSlider({
	  		tickerHover:true,
		  	auto: false,
		  	controls:false
		});
	});
	<?php echo '</script'; ?>
>
</div>
<?php }
}
?>