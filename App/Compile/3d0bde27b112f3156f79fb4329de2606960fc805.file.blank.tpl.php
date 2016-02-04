<?php /* Smarty version Smarty-3.1.19, created on 2014-10-30 12:25:59
         compiled from "/mnt/hgfs/Sites/buildcommand/App/Views/layouts/blank.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1573546456545282b7c1e706-97563884%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3d0bde27b112f3156f79fb4329de2606960fc805' => 
    array (
      0 => '/mnt/hgfs/Sites/buildcommand/App/Views/layouts/blank.tpl',
      1 => 1414693517,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1573546456545282b7c1e706-97563884',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'CSS' => 0,
    'FRAMEWORK_JS' => 0,
    'JS' => 0,
    'SITE_URL' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_545282b7c3cad9_10808652',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_545282b7c3cad9_10808652')) {function content_545282b7c3cad9_10808652($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['title']->value, ENT_QUOTES, 'UTF-8');?>
</title>
	<link rel="stylesheet" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['CSS']->value, ENT_QUOTES, 'UTF-8');?>
/blank.css" />
	
	<script src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['FRAMEWORK_JS']->value, ENT_QUOTES, 'UTF-8');?>
/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['FRAMEWORK_JS']->value, ENT_QUOTES, 'UTF-8');?>
/jquery-validation-1.13.0/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['FRAMEWORK_JS']->value, ENT_QUOTES, 'UTF-8');?>
/jquery-ui-1.11.2.custom/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['JS']->value, ENT_QUOTES, 'UTF-8');?>
/general.js"></script>
	<script>
		var SITE_URL = '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
';
	</script>
	
</head>
<body>
	<div id="wrapper">
		<div id="content">
			<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['content']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		</div>
		
	</div>
</body>
</html><?php }} ?>
