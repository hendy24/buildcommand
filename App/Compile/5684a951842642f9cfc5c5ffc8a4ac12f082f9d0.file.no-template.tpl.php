<?php /* Smarty version Smarty-3.1.19, created on 2014-09-30 19:26:58
         compiled from "/mnt/hgfs/Sites/buildcommand/App/Views/error/no-template.tpl" */ ?>
<?php /*%%SmartyHeaderCode:752989931542b5862282bd4-65446006%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5684a951842642f9cfc5c5ffc8a4ac12f082f9d0' => 
    array (
      0 => '/mnt/hgfs/Sites/buildcommand/App/Views/error/no-template.tpl',
      1 => 1408509397,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '752989931542b5862282bd4-65446006',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_542b586229bae3_23507734',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542b586229bae3_23507734')) {function content_542b586229bae3_23507734($_smarty_tpl) {?><h1>We're Sorry!</h1>
<p class="text-center">We cannot find the page you are looking for.</p>

<?php if ($_smarty_tpl->tpl_vars['auth']->value->is_admin()) {?>
	<p class="text-center">The template file is missing</p>
<?php }?><?php }} ?>
