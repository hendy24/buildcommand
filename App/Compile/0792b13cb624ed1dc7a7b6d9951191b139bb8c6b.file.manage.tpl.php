<?php /* Smarty version Smarty-3.1.19, created on 2014-10-30 11:54:50
         compiled from "/mnt/hgfs/Sites/buildcommand/App/Views/users/manage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1516107395451ca91e8b873-51950484%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0792b13cb624ed1dc7a7b6d9951191b139bb8c6b' => 
    array (
      0 => '/mnt/hgfs/Sites/buildcommand/App/Views/users/manage.tpl',
      1 => 1414691688,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1516107395451ca91e8b873-51950484',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5451ca91e8da59_38583862',
  'variables' => 
  array (
    'SITE_URL' => 0,
    'users' => 0,
    'user' => 0,
    'FRAMEWORK_IMAGES' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5451ca91e8da59_38583862')) {function content_5451ca91e8da59_38583862($_smarty_tpl) {?><script>
	$(".delete").click(function(e) {
		alert("hello");
		e.preventDefault();
		var dataRow = $(this).parent().parent().parent();
		var item = $(this);
		$("#delete-dialog").dialog({
			buttons: {
				"Confirm": function() {
					var id = item.parent().attr('title');							
					$.ajax({
						type: 'post',
						url: SITE_URL,
						data: {
							page: "users",
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
</script>

<h1>Manage Users</h1>
<div class="button-left">
	<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/?page=users&amp;action=add" class="button">New User</a>
</div>
<table id="overview">
	<tr class="column-names">
		<th>Last Name</th>
		<th>First Name</th>
		<th>Username (Email)</th>
		<th>Group</th>
		<th style="width: 18px">&nbsp;</th>
		<th style="width: 18px">&nbsp;</th>
	</tr>
	<?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['user']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value) {
$_smarty_tpl->tpl_vars['user']->_loop = true;
?>
		<tr>
			<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value->last_name, ENT_QUOTES, 'UTF-8');?>
</td>
			<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value->first_name, ENT_QUOTES, 'UTF-8');?>
</td>
			<td><a href=""></a><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value->email, ENT_QUOTES, 'UTF-8');?>
</td>
			<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value->group_name, ENT_QUOTES, 'UTF-8');?>
</td>
			<td><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/?page=users&amp;action=edit&amp;id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value->public_id, ENT_QUOTES, 'UTF-8');?>
"><img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['FRAMEWORK_IMAGES']->value, ENT_QUOTES, 'UTF-8');?>
/pencil.png" alt=""></a></td>
			<td><span title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value->public_id, ENT_QUOTES, 'UTF-8');?>
"><a href="#" class="delete"><img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['FRAMEWORK_IMAGES']->value, ENT_QUOTES, 'UTF-8');?>
/cancel_16.png" alt=""></a></span></td>
		</tr>
	<?php } ?>
</table>


<div id="delete-dialog" title="Confirmation Required">
	<p>Are you sure you want to delete this item? This cannot be undone.</p>
</div><?php }} ?>
