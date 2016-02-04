<?php /* Smarty version Smarty-3.1.19, created on 2015-01-16 15:44:27
         compiled from "/mnt/hgfs/Sites/buildcommand/App/Views/draw_requests/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20631046335453d34edafec8-72684922%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f7a48fd72f9427c84f1a5787e7045a322c7c1f91' => 
    array (
      0 => '/mnt/hgfs/Sites/buildcommand/App/Views/draw_requests/index.tpl',
      1 => 1421448266,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20631046335453d34edafec8-72684922',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5453d34edb1f22_50162869',
  'variables' => 
  array (
    'project' => 0,
    'SITE_URL' => 0,
    'drawRequests' => 0,
    'request' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5453d34edb1f22_50162869')) {function content_5453d34edb1f22_50162869($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/mnt/hgfs/Sites/buildcommand/Core/Vendors/Smarty-3.1.19/libs/plugins/modifier.date_format.php';
?>	
	<h1><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->name, ENT_QUOTES, 'UTF-8');?>
</h1>

	<div class="button-left">
		<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/?page=draw_requests&amp;action=request&amp;id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->public_id, ENT_QUOTES, 'UTF-8');?>
" class="button">New Draw Request</a>
	</div>
	<?php if ($_smarty_tpl->tpl_vars['drawRequests']->value) {?>
		<table id="overview">
			<tr>
				<th colspan="6">Project Draws</th>
			</tr>
			<tr class="column-names">
				<td>Draw Created</td>
				<td>Draw Submitted</td>
				<td>Draw Amount</td>
				<td>Status</td>
				<td style="width: 110px"></td>
			</tr>
			
		
			<?php  $_smarty_tpl->tpl_vars['request'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['request']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['drawRequests']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['request']->key => $_smarty_tpl->tpl_vars['request']->value) {
$_smarty_tpl->tpl_vars['request']->_loop = true;
?>
			<tr>
				<td><?php echo htmlspecialchars(smarty_modifier_date_format($_smarty_tpl->tpl_vars['request']->value->datetime_created), ENT_QUOTES, 'UTF-8');?>
</td>
				<td><?php echo htmlspecialchars(smarty_modifier_date_format($_smarty_tpl->tpl_vars['request']->value->datetime_submitted), ENT_QUOTES, 'UTF-8');?>
</td>
				<td><?php echo htmlspecialchars(currency_format($_smarty_tpl->tpl_vars['request']->value->draw_amount), ENT_QUOTES, 'UTF-8');?>
</td>
				<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['request']->value->status, ENT_QUOTES, 'UTF-8');?>
</td>
				<td class="text-right">
					<?php if ($_smarty_tpl->tpl_vars['request']->value->status=="Pending") {?>
					<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/?page=draw_requests&amp;action=submit&amp;id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->public_id, ENT_QUOTES, 'UTF-8');?>
&amp;type=submit" class="button">Submit</a>
					<?php }?>
					<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/?page=draw_requests&amp;action=request&amp;id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['request']->value->public_id, ENT_QUOTES, 'UTF-8');?>
" class="button">Edit</a>
				</td>
			</tr>
			<?php } ?>
		</table>
	<?php } else { ?>
		<p class="text-center">No draw requests have been created. You can <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/?page=draw_requests&amp;action=request&amp;id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->public_id, ENT_QUOTES, 'UTF-8');?>
">create a new one</a> now.</p>
	<?php }?>


<?php }} ?>
