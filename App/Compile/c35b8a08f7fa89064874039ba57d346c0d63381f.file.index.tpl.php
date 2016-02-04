<?php /* Smarty version Smarty-3.1.19, created on 2014-10-30 11:29:23
         compiled from "/mnt/hgfs/Sites/buildcommand/App/Views/projects/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:356080571542b5d3fc7c0a8-27927334%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c35b8a08f7fa89064874039ba57d346c0d63381f' => 
    array (
      0 => '/mnt/hgfs/Sites/buildcommand/App/Views/projects/index.tpl',
      1 => 1414688655,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '356080571542b5d3fc7c0a8-27927334',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_542b5d3fc7e095_60523869',
  'variables' => 
  array (
    'company' => 0,
    'SITE_URL' => 0,
    'projects' => 0,
    'p' => 0,
    'toolMenu' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542b5d3fc7e095_60523869')) {function content_542b5d3fc7e095_60523869($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/mnt/hgfs/Sites/buildcommand/Core/Vendors/Smarty-3.1.19/libs/plugins/modifier.date_format.php';
?><script>
	$(document).ready(function(e) {
		$(".delete").click(function(e) {
			e.preventDefault();
			var dataRow = $(this).parent().parent().parent().parent().parent().parent().parent();
			var item = $(this);
			$("#delete-dialog").dialog({
				buttons: {
					"Confirm": function() {
						var id = item.parent().attr('title');							
						$.ajax({
							type: 'post',
							url: SITE_URL,
							data: {
								page: "projects",
								action: 'deleteId',
								id: id,
							},
							success: function() {
								dataRow.fadeOut("slow");
							}
						});
						$(this).dialog("close");

					},
					"Cancel": function() {
						$(this).dialog("close");
					}
				}
			});
		});


		$(".archive").click(function(e) {
			e.preventDefault();
			var dataRow = $(this).parent().parent().parent().parent().parent().parent().parent();
			var item = $(this);
			$("#archive-dialog").dialog({
				buttons: {
					"Completed": function() {
						var id = item.parent().attr('title');
							
						$.ajax({
							type: 'post',
							url: SITE_URL,
							data: {
								page: "projects",
								action: 'archive',
								id: id,
								status: "Completed"
							},
							success: function() {
								dataRow.fadeOut("slow");
							}
						});
						$(this).dialog("close");

					},
					"Lost": function() {
						var id = item.parent().attr('title');
							
						$.ajax({
							type: 'post',
							url: SITE_URL,
							data: {
								page: "projects",
								action: 'archive',
								id: id,
								status: "Lost"
							},
							success: function() {
								dataRow.fadeOut("slow");
							}
						});
						$(this).dialog("close");
					},
					"Cancel": function() {
						$(this).dialog("close");
					}
				}
			});
		});


		$("#project-status").selectmenu({ width: 120 });

	});
</script>
<div id="manage-projects">

	<h1><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company']->value->name, ENT_QUOTES, 'UTF-8');?>
</h1>

	<div class="button-left">
		<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/?page=projects&amp;action=add" class="button">New Project</a>
	</div>
	<div class="button-right">
		<select name="project_status" id="project-status">
			<option value="all">All</option>
			<option value="pending">Pending</option>
			<option value="active">Active</option>
		</select>
	</div>

	<table id="overview">
		<tr>
			<th colspan="7">Projects</th>
		</tr>
		<tr class="column-names">
			<td style="width: 250px">Project Name</td>
			<td>Sq Ft</td>
			<td>Start</td>
			<td>Completion</td>
			<td>Estimate</td>
			<td>Actual</td>
			<td style="width: 25px">&nbsp;</td>
		</tr>
		<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['projects']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
?>
		<tr>
			<td><a href="/?page=projects&amp;action=manage&amp;id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value->public_id, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value->name, ENT_QUOTES, 'UTF-8');?>
</a></td>
			<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value->basement_sq_ft+$_smarty_tpl->tpl_vars['p']->value->main_floor_sq_ft+$_smarty_tpl->tpl_vars['p']->value->upper_floor_sq_ft, ENT_QUOTES, 'UTF-8');?>
</td>
			<td><?php echo htmlspecialchars(smarty_modifier_date_format($_smarty_tpl->tpl_vars['p']->value->start_date,"%m/%d/%y"), ENT_QUOTES, 'UTF-8');?>
</td>
			<td></td>
			<td><?php echo htmlspecialchars(currency_format($_smarty_tpl->tpl_vars['p']->value->estimated_cost), ENT_QUOTES, 'UTF-8');?>
</td>
			<td><?php echo htmlspecialchars(currency_format($_smarty_tpl->tpl_vars['p']->value->actual_cost), ENT_QUOTES, 'UTF-8');?>
</td>
			<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['toolMenu']->value->options($_smarty_tpl->tpl_vars['p']->value), ENT_QUOTES, 'UTF-8');?>
</td>
		</tr>
		<?php } ?>
	</table>
</div>




<div id="delete-dialog" title="Confirmation Required">
	<p>Are you sure you want to delete this item? This cannot be undone.</p>
</div>
<div id="archive-dialog" title="Confirmation Required">
	<p>Are you sure you want to archive this project? This project will no longer be visible on the home page.</p>
</div>
<?php }} ?>
