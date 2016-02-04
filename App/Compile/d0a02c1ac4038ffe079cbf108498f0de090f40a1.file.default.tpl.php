<?php /* Smarty version Smarty-3.1.19, created on 2014-11-05 14:11:40
         compiled from "/mnt/hgfs/Sites/buildcommand/App/Views/layouts/default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:307003485542b4c765c5cf7-14847924%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd0a02c1ac4038ffe079cbf108498f0de090f40a1' => 
    array (
      0 => '/mnt/hgfs/Sites/buildcommand/App/Views/layouts/default.tpl',
      1 => 1415221897,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '307003485542b4c765c5cf7-14847924',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_542b4c76693116_33102318',
  'variables' => 
  array (
    'title' => 0,
    'COMPANY_NAME' => 0,
    'JS' => 0,
    'CSS' => 0,
    'SITE_URL' => 0,
    'headerImage' => 0,
    'IMAGES' => 0,
    'auth' => 0,
    'flashMessages' => 0,
    'class' => 0,
    'message' => 0,
    'm' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542b4c76693116_33102318')) {function content_542b4c76693116_33102318($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/mnt/hgfs/Sites/buildcommand/Core/Vendors/Smarty-3.1.19/libs/plugins/modifier.date_format.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['title']->value, ENT_QUOTES, 'UTF-8');?>
  | <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['COMPANY_NAME']->value, ENT_QUOTES, 'UTF-8');?>
</title>
	<link rel="stylesheet" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['JS']->value, ENT_QUOTES, 'UTF-8');?>
/jquery-ui-1.11.2.custom/jquery-ui.min.css">
	<link rel="stylesheet" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['JS']->value, ENT_QUOTES, 'UTF-8');?>
/jQuery-Autocomplete-master/content/styles.css" />
	<link rel="stylesheet" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['CSS']->value, ENT_QUOTES, 'UTF-8');?>
/styles.css">
	<script src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['JS']->value, ENT_QUOTES, 'UTF-8');?>
/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['JS']->value, ENT_QUOTES, 'UTF-8');?>
/jquery-validation-1.13.0/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['JS']->value, ENT_QUOTES, 'UTF-8');?>
/jquery-ui-1.11.2.custom/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['JS']->value, ENT_QUOTES, 'UTF-8');?>
/jQuery-Autocomplete-master/dist/jquery.autocomplete.min.js"></script>
	<script type="text/javascript" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['JS']->value, ENT_QUOTES, 'UTF-8');?>
/shadowbox-3.0.3/shadowbox.js"></script>
	<link rel="stylesheet" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['JS']->value, ENT_QUOTES, 'UTF-8');?>
/shadowbox-3.0.3/shadowbox.css">
	<script type="text/javascript" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['JS']->value, ENT_QUOTES, 'UTF-8');?>
/general.js"></script>
	<script>
		var SITE_URL = '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
';
		Shadowbox.init();
	</script>
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<div id="logo">
				<?php if ($_smarty_tpl->tpl_vars['headerImage']->value) {?>
					<img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['headerImage']->value, ENT_QUOTES, 'UTF-8');?>
" alt="" height="50">
				<?php } else { ?>
					<img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['IMAGES']->value, ENT_QUOTES, 'UTF-8');?>
/buildcommand_beta_logo.png" alt="">
				<?php }?>
			</div>
			<div id="login">
				<?php if (!$_smarty_tpl->tpl_vars['auth']->value->isLoggedIn()) {?>
				<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/login">Login</a>&nbsp;|&nbsp; <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/register">Register</a>
				<?php } else { ?>
				Hello, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['auth']->value->getRecord()->fullName(), ENT_QUOTES, 'UTF-8');?>
&nbsp;|&nbsp; <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/logout">Logout</a>
				<?php }?> 

				
			</div>
			<nav>
				<?php if ($_smarty_tpl->tpl_vars['auth']->value->isLoggedIn()) {?>
					<?php echo $_smarty_tpl->getSubTemplate ("elements/user_nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

				<?php } else { ?>
					<?php echo $_smarty_tpl->getSubTemplate ("elements/navigation.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

				<?php }?>
			</nav>
		</div>
		<div id="content">
			<?php if ($_smarty_tpl->tpl_vars['flashMessages']->value) {?>
			<div id="flash-messages">
				<?php  $_smarty_tpl->tpl_vars['message'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['message']->_loop = false;
 $_smarty_tpl->tpl_vars['class'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['flashMessages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['message']->key => $_smarty_tpl->tpl_vars['message']->value) {
$_smarty_tpl->tpl_vars['message']->_loop = true;
 $_smarty_tpl->tpl_vars['class']->value = $_smarty_tpl->tpl_vars['message']->key;
?>
				<div class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['class']->value, ENT_QUOTES, 'UTF-8');?>
">
					<ul>
					<?php  $_smarty_tpl->tpl_vars['m'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['m']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['message']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['m']->key => $_smarty_tpl->tpl_vars['m']->value) {
$_smarty_tpl->tpl_vars['m']->_loop = true;
?>
						<li><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['m']->value, ENT_QUOTES, 'UTF-8');?>
</li>
					<?php } ?>
					</ul>
				</div>
				<div class="clear"></div>
				<?php } ?>
			</div>
			<?php }?>

			<div id="page-content">
				<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['content']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

			</div>
			
		</div>
	</div>
	<div id="footer">All content &copy; <?php echo htmlspecialchars(smarty_modifier_date_format(time(),"%Y"), ENT_QUOTES, 'UTF-8');?>
 BuildCommand. Powered by <a href="http://www.aptitudeit.net" target="_blank">aptitude</a>.</div>
	
</body>
</html><?php }} ?>
