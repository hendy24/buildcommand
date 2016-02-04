<?php /* Smarty version Smarty-3.1.19, created on 2014-12-04 14:01:48
         compiled from "/mnt/hgfs/Sites/buildcommand/App/Views/estimates/printView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13722423405480c0cfbe5db4-79753670%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bf41f8b505f0d4245c39f38f21371deec2289380' => 
    array (
      0 => '/mnt/hgfs/Sites/buildcommand/App/Views/estimates/printView.tpl',
      1 => 1417726907,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13722423405480c0cfbe5db4-79753670',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5480c0cfbe7fa2_68592225',
  'variables' => 
  array (
    'company' => 0,
    'project' => 0,
    'pageData' => 0,
    'sectionName' => 0,
    'data' => 0,
    'sectionItemName' => 0,
    'margin' => 0,
    'contingency' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5480c0cfbe7fa2_68592225')) {function content_5480c0cfbe7fa2_68592225($_smarty_tpl) {?><h1><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company']->value->name, ENT_QUOTES, 'UTF-8');?>
: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->name, ENT_QUOTES, 'UTF-8');?>
</h1>

	<table width="100%">
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td style="width:85px"><span class="text-12 text-grey">Estimated Cost</span></td>
			<td style="width:85px"><span class="text-12 text-grey">Actual Cost</span></td>
		</tr>
		<?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['data']->_loop = false;
 $_smarty_tpl->tpl_vars['sectionName'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['pageData']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['count']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->_loop = true;
 $_smarty_tpl->tpl_vars['sectionName']->value = $_smarty_tpl->tpl_vars['data']->key;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['count']['iteration']++;
?>
		<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['count']['iteration']!=1) {?>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<?php }?>
		<tr class="title-row">
			<td colspan="2"><strong><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sectionName']->value, ENT_QUOTES, 'UTF-8');?>
</strong></td>
			<td class="text-center"><strong><?php if (isset($_smarty_tpl->tpl_vars['data']->value['cost'])&&$_smarty_tpl->tpl_vars['data']->value['cost']->estimated_cost!='') {?><?php echo htmlspecialchars(currency_format((($tmp = @$_smarty_tpl->tpl_vars['data']->value['cost']->estimated_cost)===null||$tmp==='' ? "$"."0.00" : $tmp)), ENT_QUOTES, 'UTF-8');?>
<?php } else { ?>$0.00<?php }?></strong></td>
			<td class="text-center"><strong><?php if (isset($_smarty_tpl->tpl_vars['data']->value['cost'])&&$_smarty_tpl->tpl_vars['data']->value['cost']->actual_cost!='') {?><?php echo htmlspecialchars(currency_format((($tmp = @$_smarty_tpl->tpl_vars['data']->value['cost']->actual_cost)===null||$tmp==='' ? "$"."0.00" : $tmp)), ENT_QUOTES, 'UTF-8');?>
<?php } else { ?>$0.00<?php }?></strong></td>
		</tr>
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['sectionItemName'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['sectionItemName']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
		<?php if ($_smarty_tpl->tpl_vars['sectionItemName']->value!="cost") {?>
		<tr>
			<td style="width:5px">&nbsp;</td>
			<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sectionItemName']->value, ENT_QUOTES, 'UTF-8');?>
</td>
			
			<td>$
				<?php if ($_smarty_tpl->tpl_vars['sectionItemName']->value=="Margin"&&$_smarty_tpl->tpl_vars['project']->value->margin!=''&&isset($_smarty_tpl->tpl_vars['margin']->value->estimated_cost)) {?>
					<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['margin']->value->estimated_cost, ENT_QUOTES, 'UTF-8');?>

				<?php } elseif ($_smarty_tpl->tpl_vars['sectionItemName']->value=="Contingency"&&$_smarty_tpl->tpl_vars['project']->value->contingency!=''&&isset($_smarty_tpl->tpl_vars['contingency']->value->estimated_cost)) {?>
					<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['contingency']->value->estimated_cost, ENT_QUOTES, 'UTF-8');?>

				<?php } else { ?>
					<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['item']->value->estimated_cost)===null||$tmp==='' ? "0.00" : $tmp), ENT_QUOTES, 'UTF-8');?>

				<?php }?>
			</td>

			<?php if (isset($_smarty_tpl->tpl_vars['item']->value->estimated_cost)&&$_smarty_tpl->tpl_vars['item']->value->estimated_cost!="0.00") {?>
			<td>
				$<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['item']->value->actual_cost)===null||$tmp==='' ? "0.00" : $tmp), ENT_QUOTES, 'UTF-8');?>

			</td>
			<?php } else { ?>
			<td>&nbsp;</td>
			<?php }?>			


		</tr>
		<?php }?>
		<?php } ?>
		<?php } ?>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr style="border-top:1px solid #000">
			<td colspan="2"><strong>Total Project Cost</strong></td>
			<td><strong>$<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->estimated_cost, ENT_QUOTES, 'UTF-8');?>
</strong></td>
			<td><strong>$<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->actual_cost, ENT_QUOTES, 'UTF-8');?>
</strong></td>
		</tr>
	</table>

<br />
<div style="float:right; font-size: 10px">
	All Content &copy; BuildCommand, LLC. All rights reserved.
</div><?php }} ?>
