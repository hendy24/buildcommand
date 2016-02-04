<?php /* Smarty version Smarty-3.1.19, created on 2014-10-28 13:37:04
         compiled from "/mnt/hgfs/Sites/buildcommand/App/Views/elements/estimate_nav.tpl" */ ?>
<?php /*%%SmartyHeaderCode:29257849454361a9e097681-41528583%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'af00ce582470cc5f40eef42f723baaa53102543d' => 
    array (
      0 => '/mnt/hgfs/Sites/buildcommand/App/Views/elements/estimate_nav.tpl',
      1 => 1414524984,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29257849454361a9e097681-41528583',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_54361a9e0b1594_81672168',
  'variables' => 
  array (
    'project' => 0,
    'SITE_URL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54361a9e0b1594_81672168')) {function content_54361a9e0b1594_81672168($_smarty_tpl) {?><h1><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->name, ENT_QUOTES, 'UTF-8');?>
</h1>

<div id="estimate-nav">
	<ul>
		<li id="general-link"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/?page=estimates&amp;action=general&amp;id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->public_id, ENT_QUOTES, 'UTF-8');?>
">General</a></li>
		<li id="rough-structure-link" ><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/?page=estimates&amp;action=rough_structure&amp;id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->public_id, ENT_QUOTES, 'UTF-8');?>
">Rough Structure</a></li>
		<li id="mechanical-link"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/?page=estimates&amp;action=mechanical&amp;id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->public_id, ENT_QUOTES, 'UTF-8');?>
">Mechanical</a></li>
		<li id="interior-finishes-link"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/?page=estimates&amp;action=interior&amp;id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->public_id, ENT_QUOTES, 'UTF-8');?>
">Interior</a></li>
		<li id="exterior-finishes-link"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/?page=estimates&amp;action=exterior&amp;id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->public_id, ENT_QUOTES, 'UTF-8');?>
">Exterior</a></li>
		<li id="closing-link"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/?page=estimates&amp;action=closing&amp;id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->public_id, ENT_QUOTES, 'UTF-8');?>
">Closing</a></li>
	</ul>	
</div><?php }} ?>
