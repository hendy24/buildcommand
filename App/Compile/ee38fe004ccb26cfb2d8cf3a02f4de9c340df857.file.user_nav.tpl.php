<?php /* Smarty version Smarty-3.1.19, created on 2014-11-11 11:55:18
         compiled from "/mnt/hgfs/Sites/buildcommand/App/Views/elements/user_nav.tpl" */ ?>
<?php /*%%SmartyHeaderCode:89540503542b6d78657641-35404590%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ee38fe004ccb26cfb2d8cf3a02f4de9c340df857' => 
    array (
      0 => '/mnt/hgfs/Sites/buildcommand/App/Views/elements/user_nav.tpl',
      1 => 1415732114,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '89540503542b6d78657641-35404590',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_542b6d78667959_64618138',
  'variables' => 
  array (
    'companyProjects' => 0,
    'SITE_URL' => 0,
    'project' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542b6d78667959_64618138')) {function content_542b6d78667959_64618138($_smarty_tpl) {?><ul>
	<li><a href="/">Home</a></li>
	<li>Projects
		<ul>
			<?php  $_smarty_tpl->tpl_vars['project'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['project']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['companyProjects']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['project']->key => $_smarty_tpl->tpl_vars['project']->value) {
$_smarty_tpl->tpl_vars['project']->_loop = true;
?>
				<li><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/?page=projects&amp;action=manage&amp;id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->public_id, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->name, ENT_QUOTES, 'UTF-8');?>
</a></li>
			<?php } ?>
				<li><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/?page=projects&amp;action=add"><span class="text-grey">Add New Project</span></a></li>
		</ul>
	</li>
	<li><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/?page=partners">Partners</a>
<!-- 		<ul>
			<li><a href="/?page=partners&amp;type=contractor">Contractors</a></li>
			<li><a href="/?page=partners&amp;type=supplier">Suppliers</a></li>
			<li><a href="/?page=partners&amp;type=realtor">Realtors</a></li>
			<li><a href="/?page=partners&amp;type=lendor">Lendors</a></li>
		</ul>
 -->	</li>
	<li>Data
		<ul>
			<li><a href="/?page=site_user&amp;action=account_info">My Info</a></li>
			<?php if ($_smarty_tpl->tpl_vars['auth']->value->is_admin()) {?>
				<li><a href="/?page=company">Company Info</a></li>
				<li><a href="/?page=site_user&amp;action=add">Add User</a></li>
				<li><a href="/?page=site_user&amp;action=manage">Manage Users</a></li>
			<?php }?>
		</ul>
</ul><?php }} ?>
