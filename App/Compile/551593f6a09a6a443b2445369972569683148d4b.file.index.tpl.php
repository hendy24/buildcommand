<?php /* Smarty version Smarty-3.1.19, created on 2014-09-30 18:51:19
         compiled from "/mnt/hgfs/Sites/buildcommand/App/Views/error/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2123133018542b5007f0b899-00476723%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '551593f6a09a6a443b2445369972569683148d4b' => 
    array (
      0 => '/mnt/hgfs/Sites/buildcommand/App/Views/error/index.tpl',
      1 => 1408405821,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2123133018542b5007f0b899-00476723',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'auth' => 0,
    'message' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_542b5007f23193_44237762',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542b5007f23193_44237762')) {function content_542b5007f23193_44237762($_smarty_tpl) {?><h1>Cannot find the page</h1>
<br>
<br>
<p class="text-center">We're sorry!  We are unable to find the page you are looking for.</p>

<?php if ($_smarty_tpl->tpl_vars['auth']->value->is_admin()) {?>
	<?php if (isset($_smarty_tpl->tpl_vars['message']->value)) {?>
	<br>
	<br>
	<h2>Error Message:</h2>
	<p class="text-center"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['message']->value, ENT_QUOTES, 'UTF-8');?>
</p>
	<?php }?>
<?php }?><?php }} ?>
