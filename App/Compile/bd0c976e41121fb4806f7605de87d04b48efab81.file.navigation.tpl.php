<?php /* Smarty version Smarty-3.1.19, created on 2014-10-22 22:16:19
         compiled from "/mnt/hgfs/Sites/buildcommand/App/Views/elements/navigation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:126213080542b4c766a9a28-43752161%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bd0c976e41121fb4806f7605de87d04b48efab81' => 
    array (
      0 => '/mnt/hgfs/Sites/buildcommand/App/Views/elements/navigation.tpl',
      1 => 1414037188,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '126213080542b4c766a9a28-43752161',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_542b4c766b8380_65221673',
  'variables' => 
  array (
    'SITE_URL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542b4c766b8380_65221673')) {function content_542b4c766b8380_65221673($_smarty_tpl) {?><ul>
	<li><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
">Home</a></li>
	<li>Info
		<ul>
			<li><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/fees">Fees</a></li>
			<li><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/privacy">Privacy</a></li>
			<li><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/terms">Terms &amp; Conditions</a></li>
		</ul>
	</li>
	<li>Help
		<ul>
			<li><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/about">About Us</a></li>
			<li><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/contact">Contact Us</a></li>
		</ul>
	</li>
</ul><?php }} ?>
