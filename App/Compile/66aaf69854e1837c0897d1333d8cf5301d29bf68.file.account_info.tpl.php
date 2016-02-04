<?php /* Smarty version Smarty-3.1.19, created on 2014-11-05 19:11:29
         compiled from "/mnt/hgfs/Sites/buildcommand/App/Views/site_user/account_info.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1292901197545ad8d109a426-55538870%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '66aaf69854e1837c0897d1333d8cf5301d29bf68' => 
    array (
      0 => '/mnt/hgfs/Sites/buildcommand/App/Views/site_user/account_info.tpl',
      1 => 1414645112,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1292901197545ad8d109a426-55538870',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'SITE_URL' => 0,
    'currentUrl' => 0,
    'accountUser' => 0,
    'states' => 0,
    'key' => 0,
    'state' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_545ad8d10d16f6_32939603',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_545ad8d10d16f6_32939603')) {function content_545ad8d10d16f6_32939603($_smarty_tpl) {?><script>
	$(document).ready(function() {
		// $(".phone").mask("(999) 999-9999");
		$("#state").selectmenu();
	});
</script>


<h1>Account Information</h1>

<form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
" method="post">
	<input type="hidden" name="page" value="users">
	<input type="hidden" name="action" value="account_info">
	<input type="hidden" name="path" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currentUrl']->value, ENT_QUOTES, 'UTF-8');?>
">

	<table class="form">
		<tr>
			<th colspan="3">Personal</th>
		</tr>
		<tr>
			<td><strong>First Name:</strong></td>
			<td><strong>Last Name:</strong></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><input type="text" name="first_name" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['accountUser']->value->first_name, ENT_QUOTES, 'UTF-8');?>
"></td>
			<td colspan="2"><input type="text" name="last_name" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['accountUser']->value->last_name, ENT_QUOTES, 'UTF-8');?>
" style="width: 200px"></td>
		</tr>
		<tr>
			<td colspan="3"><strong>Address:</strong></td>	
		</tr>
		<tr>
			<td colspan="3"><input type="text" name="address" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['accountUser']->value->address, ENT_QUOTES, 'UTF-8');?>
" style="width: 400px"></td>
		</tr>
		<tr>
			<td><strong>City</strong></td>
			<td><strong>State</strong></td>
			<td><strong>Zip</strong></td>
		</tr>
		<tr>
			<td><input type="text" name="city" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['accountUser']->value->city, ENT_QUOTES, 'UTF-8');?>
"></td>
			<td>
				<select name="state" id="state">
					<option value="">Select...</option>
					<?php  $_smarty_tpl->tpl_vars['state'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['state']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['states']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['state']->key => $_smarty_tpl->tpl_vars['state']->value) {
$_smarty_tpl->tpl_vars['state']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['state']->key;
?>
						<option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8');?>
"<?php if ($_smarty_tpl->tpl_vars['accountUser']->value->state==$_smarty_tpl->tpl_vars['key']->value) {?> selected<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['state']->value, ENT_QUOTES, 'UTF-8');?>
 (<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8');?>
)</option>
					<?php } ?>
				</select>
			</td>
			<td><input type="text" name="zip" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['accountUser']->value->zip, ENT_QUOTES, 'UTF-8');?>
" style="width: 90px"></td>
		</tr>
		<tr>
			<td colspan="3"><strong>Phone:</strong></td>
		</tr>
		<tr>
			<td colspan="3"><input type="text" name="phone" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['accountUser']->value->phone, ENT_QUOTES, 'UTF-8');?>
"></td>

		</tr>
		<tr>
			<td colspan="2"><strong>Username (Email Address:)</strong></td>
			<td ><strong>Password:</strong></td>
		</tr>
		<tr>
			<td colspan="2"><input type="text" name="email" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['accountUser']->value->email, ENT_QUOTES, 'UTF-8');?>
" style="width: 300px"></td>
			<?php if ($_smarty_tpl->tpl_vars['auth']->value->is_admin()||$_smarty_tpl->tpl_vars['auth']->value->getRecord()->public_id==$_smarty_tpl->tpl_vars['accountUser']->value->public_id) {?>
				<td><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/?page=users&amp;action=change_password&amp;id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['accountUser']->value->public_id, ENT_QUOTES, 'UTF-8');?>
" class="button">Reset</a></td>
			<?php } else { ?>
				<td>&nbsp;</td>
			<?php }?>
		</tr>
			
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3" class="text-right"><input type="submit" value="Save"></td>
		</tr>


	</table>
</form>
<?php }} ?>
