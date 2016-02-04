<?php /* Smarty version Smarty-3.1.19, created on 2014-10-30 13:20:05
         compiled from "/mnt/hgfs/Sites/buildcommand/App/Views/users/add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:962042685451a3b408b1a7-42426071%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8f7614d846c6ffe246a6adc5f16c0f3b3a38d01f' => 
    array (
      0 => '/mnt/hgfs/Sites/buildcommand/App/Views/users/add.tpl',
      1 => 1414696803,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '962042685451a3b408b1a7-42426071',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5451a3b40b4b60_65130149',
  'variables' => 
  array (
    'title' => 0,
    'SITE_URL' => 0,
    'currentUrl' => 0,
    'FRAMEWORK_IMAGES' => 0,
    'groups' => 0,
    'group' => 0,
    'editUser' => 0,
    'projects' => 0,
    'project' => 0,
    'states' => 0,
    'key' => 0,
    'state' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5451a3b40b4b60_65130149')) {function content_5451a3b40b4b60_65130149($_smarty_tpl) {?><script>
	$(document).ready(function() {
		// $(".phone").mask("(999) 999-9999");
		$("#multiple-projects").hide();
		$("#single-projects").hide();

		$("#account-type-tip").click(function(){
			$(".tooltip").toggle();
		});

		$("#group").selectmenu({ 
			width: 120,
			change: function (e, ui) {
				if ($("#group option:selected").val() == 2) {
					$("#multiple-projects").show();
				} else {
					$("#multiple-projects").hide();
				}
				
				if ($("#group option:selected").val() == 3) {
					$("#single-projects").show();
				} else {
					$("#single-projects").hide();
				}
			}
		});
		$("#state").selectmenu();
				
	});
		
</script>

<h1 class="text-center"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['title']->value, ENT_QUOTES, 'UTF-8');?>
</h1>
<form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
" method="post">
	<input type="hidden" name="page" value="users">
	<input type="hidden" name="action" value="add">
	<input type="hidden" name="path" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currentUrl']->value, ENT_QUOTES, 'UTF-8');?>
">

	<table class="form">
		<tr>
			<td>
				<strong>Group:</strong><img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['FRAMEWORK_IMAGES']->value, ENT_QUOTES, 'UTF-8');?>
/information.png" alt="Information tooltip" id="account-type-tip" class="tooltip-button" /><div class="tooltip">The user group will allow different levels of access in the application.<br /><strong>Administrator:</strong> Access to all projects, user account management, add new users.<br /><strong>Manager:</strong> Access to specified projects<br /><strong>User:</strong> Access only to assigned project, typically a homeowner's account</div>
			</td>
			<td>
				<select name="group" id="group">
					<option value="">Select...</option>
					<?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['group']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['groups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value) {
$_smarty_tpl->tpl_vars['group']->_loop = true;
?>
						<option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['group']->value->id, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['editUser']->value->group_id==$_smarty_tpl->tpl_vars['group']->value->id) {?> selected<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['group']->value->name, ENT_QUOTES, 'UTF-8');?>
</option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<tr id="multiple-projects">
			<td valign="top"><strong>Projects:</strong></td>
			<td>
				<?php  $_smarty_tpl->tpl_vars['project'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['project']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['projects']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['project']->key => $_smarty_tpl->tpl_vars['project']->value) {
$_smarty_tpl->tpl_vars['project']->_loop = true;
?>
					<input type="checkbox" name="project[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->id, ENT_QUOTES, 'UTF-8');?>
]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->id, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->name, ENT_QUOTES, 'UTF-8');?>
<br>
				<?php } ?>
			</td>
		</tr>
		<tr id="single-projects">
			<td valign="top"><strong>Projects:</strong></td>
			<td>
				<?php  $_smarty_tpl->tpl_vars['project'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['project']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['projects']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['project']->key => $_smarty_tpl->tpl_vars['project']->value) {
$_smarty_tpl->tpl_vars['project']->_loop = true;
?>
					<input type="radio" name="project" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->id, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->name, ENT_QUOTES, 'UTF-8');?>
<br>
				<?php } ?>
			</td>
		<tr>
			<td><strong>First Name:</strong></td>
			<td colspan="2"><strong>Last Name:</strong></td>
		</tr>
		<tr>
			<td><input type="text" name="first_name" id="first-name" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['editUser']->value->first_name, ENT_QUOTES, 'UTF-8');?>
" size="30"></td>
			<td colspan="2"><input type="text" name="last_name" id="last-name" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['editUser']->value->last_name, ENT_QUOTES, 'UTF-8');?>
" size="50"></td>
		</tr>
		<tr>
			<td colspan="3"><strong>Address:</strong></td>
		</tr>
		<tr>
			<td colspan="3"><input type="text" name="address" id="address" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['editUser']->value->address, ENT_QUOTES, 'UTF-8');?>
" size="80"></td>
		</tr>
		<tr>
			<td style="width: 40%"><strong>City:</strong></td>
			<td style="width: 40%"><strong>State:</strong></td>
			<td style="width: 20%"><strong>Zip:</strong></td>
		</tr>
		<tr>
			<td><input type="text" name="city" id="city" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['editUser']->value->city, ENT_QUOTES, 'UTF-8');?>
" size="30"> </td>
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
" <?php if ($_smarty_tpl->tpl_vars['editUser']->value->state==$_smarty_tpl->tpl_vars['key']->value) {?> selected<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['state']->value, ENT_QUOTES, 'UTF-8');?>
 (<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8');?>
)</option>
					<?php } ?>
				</select>
			</td>
			<td><input type="text" name="zip" id="zip" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['editUser']->value->zip, ENT_QUOTES, 'UTF-8');?>
" size="10"></td>
		</tr>
		<tr>
			<td><strong>Phone Number:</strong></td>
			<td><input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['editUser']->value->phone, ENT_QUOTES, 'UTF-8');?>
"></td>
		</tr>
		<tr>
			<td colspan="3"><strong>Username <span class="text-12">(Email Address)</span>:</strong></td>
		</tr>
		<tr>
			<td colspan="3"><input type="text" name="email" id="email" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['editUser']->value->email, ENT_QUOTES, 'UTF-8');?>
" size="40">
			<?php if ($_smarty_tpl->tpl_vars['title']->value=="Edit User") {?>
			&nbsp;<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/?page=users&amp;action=change_password&amp;id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['editUser']->value->public_id, ENT_QUOTES, 'UTF-8');?>
" class="button">Reset Password</a></td>
			<?php } else { ?>
			</td>
			<?php }?>
		</tr>
		<?php if ($_smarty_tpl->tpl_vars['title']->value=="Edit User") {?>

		<?php } else { ?>
		<tr>	
			<td><strong>Password:</strong></td>
			<td><strong>Verify Password:</strong></td>
		</tr>
		<tr>	
			

			<td><input type="password" name="password" id="password"></td>
			<td><input type="password" name="verify_password" id="verify_password"></td>
		</tr>
		<?php }?>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3" align="right"><input type="submit" value="Add User"></td>
		</tr>
	</table>
</form>
<?php }} ?>
