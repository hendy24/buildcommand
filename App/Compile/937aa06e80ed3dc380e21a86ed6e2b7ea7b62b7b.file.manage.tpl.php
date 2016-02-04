<?php /* Smarty version Smarty-3.1.19, created on 2015-01-16 10:19:31
         compiled from "/mnt/hgfs/Sites/buildcommand/App/Views/projects/manage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2010187172542b68c5883c94-68269948%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '937aa06e80ed3dc380e21a86ed6e2b7ea7b62b7b' => 
    array (
      0 => '/mnt/hgfs/Sites/buildcommand/App/Views/projects/manage.tpl',
      1 => 1421428755,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2010187172542b68c5883c94-68269948',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_542b68c5885a01_22564077',
  'variables' => 
  array (
    'project' => 0,
    'SITE_URL' => 0,
    'IMAGES' => 0,
    'toolMenu' => 0,
    'itemGroups' => 0,
    'group' => 0,
    'totalEstimatedCost' => 0,
    'totalActualCost' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542b68c5885a01_22564077')) {function content_542b68c5885a01_22564077($_smarty_tpl) {?><h1>
	<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->name, ENT_QUOTES, 'UTF-8');?>
 Dashboard
		<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/files/plans/<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->plan_filename, ENT_QUOTES, 'UTF-8');?>
" target="_blank">
			<img class="plan-link" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['IMAGES']->value, ENT_QUOTES, 'UTF-8');?>
/house_building.png" alt="">
		</a>
</h1>


	


<table id="project-costs">
	<tr>
		<th colspan="3">Project Costs</th>
		<td id="wrench-menu"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['toolMenu']->value->options($_smarty_tpl->tpl_vars['project']->value), ENT_QUOTES, 'UTF-8');?>
</td>
	</tr>
	<tr>
		<td style="width: 175px">&nbsp;</td>
		<td><strong>Estimated</strong></td>
		<td><strong>Actual</strong></td>
	</tr>
	<?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['group']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['itemGroups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value) {
$_smarty_tpl->tpl_vars['group']->_loop = true;
?>
	<tr>
		<td><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/?page=estimates&amp;action=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['group']->value->name, ENT_QUOTES, 'UTF-8');?>
&amp;id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->public_id, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['group']->value->description, ENT_QUOTES, 'UTF-8');?>
</a></td>
		<td><?php echo htmlspecialchars(currency_format($_smarty_tpl->tpl_vars['group']->value->estimated_cost), ENT_QUOTES, 'UTF-8');?>
</td>
		<td><?php echo htmlspecialchars(currency_format($_smarty_tpl->tpl_vars['group']->value->actual_cost), ENT_QUOTES, 'UTF-8');?>
</td>
	</tr>
	<?php } ?>

	<tr class="title-row">
		<td>Total Cost</td>
		<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['totalEstimatedCost']->value, ENT_QUOTES, 'UTF-8');?>
</td>
		<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['totalActualCost']->value, ENT_QUOTES, 'UTF-8');?>
</td>
	</tr>

</table><?php }} ?>
