<?php /* Smarty version Smarty-3.1.19, created on 2014-11-12 14:21:39
         compiled from "/mnt/hgfs/Sites/buildcommand/App/Views/partners/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1355323823545ac58e473fe3-62109614%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8652e3e00878fcf9e99601805a1f737d434e278c' => 
    array (
      0 => '/mnt/hgfs/Sites/buildcommand/App/Views/partners/index.tpl',
      1 => 1415827298,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1355323823545ac58e473fe3-62109614',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_545ac58e476543_46140823',
  'variables' => 
  array (
    'company' => 0,
    'SITE_URL' => 0,
    'partnerTypes' => 0,
    'type' => 0,
    'inputType' => 0,
    'data' => 0,
    'k' => 0,
    'd' => 0,
    'p' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_545ac58e476543_46140823')) {function content_545ac58e476543_46140823($_smarty_tpl) {?><script>
	$(document).ready(function () {
		$("#partner-type").selectmenu({
			change: function (e, u) {
				var typeSelected = $("option:selected", this);
				var typeValue = typeSelected.val();
				window.location.href = SITE_URL + "/?page=partners&type=" + typeValue;
			},
			width: 100
		});

	});
</script>

<h1><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company']->value->name, ENT_QUOTES, 'UTF-8');?>
</h1>
<div class="button-left">
	<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/?page=partners&amp;action=add" class="button">New Partner</a>
</div>
	<div id="type-div" class="button-right">
		<select name="partner_type" id="partner-type">
			<option value="all">All</option>
			<?php  $_smarty_tpl->tpl_vars['type'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['type']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['partnerTypes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['type']->key => $_smarty_tpl->tpl_vars['type']->value) {
$_smarty_tpl->tpl_vars['type']->_loop = true;
?>
			<option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['type']->value->name, ENT_QUOTES, 'UTF-8');?>
"<?php if ($_smarty_tpl->tpl_vars['inputType']->value==$_smarty_tpl->tpl_vars['type']->value->name) {?> selected<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['type']->value->name, ENT_QUOTES, 'UTF-8');?>
</option>
			<?php } ?>
		</select>
	</div>

<table id="overview">
	<tr>
		<th colspan="6">Partners</th>
	</tr>

	<?php  $_smarty_tpl->tpl_vars['d'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['d']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['d']->key => $_smarty_tpl->tpl_vars['d']->value) {
$_smarty_tpl->tpl_vars['d']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['d']->key;
?>
		<tr class="title-row">
			<td colspan="6"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['k']->value, ENT_QUOTES, 'UTF-8');?>
</td>
		</tr>
		<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['d']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
?>
		<tr>
			<td style="width: 20px">&nbsp;</td>
			<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value->name, ENT_QUOTES, 'UTF-8');?>
</td>
			<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value->contact_name, ENT_QUOTES, 'UTF-8');?>
</td>
			<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value->phone, ENT_QUOTES, 'UTF-8');?>
</td>
			<td><a href="mailto:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value->email, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value->email, ENT_QUOTES, 'UTF-8');?>
</a></td>
			<td class="text-right"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/?page=partners&amp;action=edit&amp;id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value->public_id, ENT_QUOTES, 'UTF-8');?>
" class="button">Edit</a></td>
		</tr>
		<?php } ?>
	<?php } ?>
</table><?php }} ?>
