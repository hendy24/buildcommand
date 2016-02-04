<?php /* Smarty version Smarty-3.1.19, created on 2014-10-29 22:38:02
         compiled from "/mnt/hgfs/Sites/buildcommand/App/Views/company/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1744950348542b587b143598-77416981%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3343e89ebb24b6656b4cf74533287ad534a50de7' => 
    array (
      0 => '/mnt/hgfs/Sites/buildcommand/App/Views/company/index.tpl',
      1 => 1414643881,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1744950348542b587b143598-77416981',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_542b587b1452a9_86320400',
  'variables' => 
  array (
    'SITE_URL' => 0,
    'currentUrl' => 0,
    'company' => 0,
    'states' => 0,
    'key' => 0,
    'state' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542b587b1452a9_86320400')) {function content_542b587b1452a9_86320400($_smarty_tpl) {?><script>
	$(document).ready(function() {
		$("#state").selectmenu();
	});
</script>
<h1>Company Info</h1>

<form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
" method="post">
	<input type="hidden" name="page" value="company">
	<input type="hidden" name="action" value="index">
	<input type="hidden" name="path" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currentUrl']->value, ENT_QUOTES, 'UTF-8');?>
">

	<table class="form">
		<tr>
			<td colspan="3"><strong>Business Name:</strong></td>
		</tr>
		<tr>
			<td colspan="3"><input type="text" name="name" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company']->value->name, ENT_QUOTES, 'UTF-8');?>
" size="60"></td>
		</tr>
		<tr>
			<td colspan="3"><strong>Address:</strong></td>	
		</tr>
		<tr>
			<td colspan="3"><input type="text" name="address" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company']->value->address, ENT_QUOTES, 'UTF-8');?>
" size="60"></td>
		</tr>
		<tr>
			<td style="width: 200px"><strong>City</strong></td>
			<td><strong>State</strong></td>
			<td><strong>Zip</strong></td>
		</tr>
		<tr>
			<td><input type="text" name="city" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company']->value->city, ENT_QUOTES, 'UTF-8');?>
"></td>
			<td>
				<select name="state" id="state">
					<option value="">Select state...</option>
					<?php  $_smarty_tpl->tpl_vars['state'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['state']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['states']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['state']->key => $_smarty_tpl->tpl_vars['state']->value) {
$_smarty_tpl->tpl_vars['state']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['state']->key;
?>
						<option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['company']->value->state==$_smarty_tpl->tpl_vars['key']->value) {?> selected<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['state']->value, ENT_QUOTES, 'UTF-8');?>
 (<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8');?>
)</option>
					<?php } ?>
				</select> 
			</td>
			<td colspan="2"><input type="text" name="zip" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company']->value->zip, ENT_QUOTES, 'UTF-8');?>
" size="10"></td>
		</tr>
		<tr>
			<td><strong>Phone:</strong></td>
			<td colspan="2"><strong>Fax:</strong></td>
		</tr>
		<tr>
			<td><input type="text" name="phone" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company']->value->phone, ENT_QUOTES, 'UTF-8');?>
"></td>
			<td colspan="2"><input type="text" name="fax" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company']->value->fax, ENT_QUOTES, 'UTF-8');?>
"></td>
		</tr>
		<tr>
			<td colspan="2"><strong>Email:</strong></td>
			<td><strong>License #:</strong></td>
		</tr>
		<tr>
			<td colspan="2"><input type="text" name="email" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company']->value->email, ENT_QUOTES, 'UTF-8');?>
" size="40"></td>
			<td><input type="text" name="license_number" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company']->value->license_number, ENT_QUOTES, 'UTF-8');?>
"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3" align="right"><input type="submit" value="Save"></td>
		</tr>
	</table>
</form>
<?php }} ?>
