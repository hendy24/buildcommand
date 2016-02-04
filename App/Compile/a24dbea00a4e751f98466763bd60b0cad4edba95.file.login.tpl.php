<?php /* Smarty version Smarty-3.1.19, created on 2014-10-09 17:43:21
         compiled from "/mnt/hgfs/Sites/buildcommand/App/Views/login/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1852542067542b50b81c6559-93818558%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a24dbea00a4e751f98466763bd60b0cad4edba95' => 
    array (
      0 => '/mnt/hgfs/Sites/buildcommand/App/Views/login/login.tpl',
      1 => 1412898200,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1852542067542b50b81c6559-93818558',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_542b50b81d8c02_12874414',
  'variables' => 
  array (
    'SITE_URL' => 0,
    'currentUrl' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542b50b81d8c02_12874414')) {function content_542b50b81d8c02_12874414($_smarty_tpl) {?><div id="login-page">
	<h1 class="text-center">Login</h2>

	<form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
" method="post">
		<input type="hidden" name="page" value="login">
		<input type="hidden" name="action" value="submitLogin">
		<input type="hidden" name="path" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currentUrl']->value, ENT_QUOTES, 'UTF-8');?>
">
		<table>
			<tr>
				<td>Username: </td>
				<td><input type="text" name="user" style="width: 200px"></td>
			</tr>
			<tr>
				<td>Password: </td>
				<td><input type="password" name="password" style="width: 200px"></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: right;"><input type="submit" value="Login"></td>
			</tr>
		</table>
	</form>

</div>

<?php }} ?>
