<?php /* Smarty version Smarty-3.1.19, created on 2014-10-30 15:35:53
         compiled from "/mnt/hgfs/Sites/buildcommand/App/Views/users/change_password.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3567276575451c8515490b6-85607337%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ef67303c0cb0a663455c802ee8908b0d51ce33ee' => 
    array (
      0 => '/mnt/hgfs/Sites/buildcommand/App/Views/users/change_password.tpl',
      1 => 1414704948,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3567276575451c8515490b6-85607337',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5451c851564d66_96434000',
  'variables' => 
  array (
    'editUser' => 0,
    'SITE_URL' => 0,
    'currentUrl' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5451c851564d66_96434000')) {function content_5451c851564d66_96434000($_smarty_tpl) {?><script>
	$(document).ready(function() {
	});
</script>


<h1>Change Password<br />
<span class="text-18">for <br><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['editUser']->value->fullName(), ENT_QUOTES, 'UTF-8');?>
</span></h1>

<form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
" method="post"> 
	<input type="hidden" name="page" value="users">
	<input type="hidden" name="action" value="change_password">
	<input type="hidden" name="id" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['editUser']->value->public_id, ENT_QUOTES, 'UTF-8');?>
">
	<input type="hidden" name="path" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currentUrl']->value, ENT_QUOTES, 'UTF-8');?>
">

	<table class="form">
		<tr>
			<td><strong>Password:</strong></td>
			<td><input type="password" name="password"></td>
		</tr>
		<tr>
			<td><strong>Verify Password:</strong></td>
			<td><input type="password" name="verify_password"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><input type="button" value="Cancel" onclick="history.go(-1)"> </td>
			<td align="right"><input type="submit" value="Save"></td>
	</table>
</form><?php }} ?>
