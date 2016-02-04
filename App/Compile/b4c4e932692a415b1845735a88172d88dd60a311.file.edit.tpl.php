<?php /* Smarty version Smarty-3.1.19, created on 2015-01-16 14:41:00
         compiled from "/mnt/hgfs/Sites/buildcommand/App/Views/draw_requests/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2064935537545a951f50f0e1-14062901%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b4c4e932692a415b1845735a88172d88dd60a311' => 
    array (
      0 => '/mnt/hgfs/Sites/buildcommand/App/Views/draw_requests/edit.tpl',
      1 => 1421444456,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2064935537545a951f50f0e1-14062901',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_545a951f51d094_27562508',
  'variables' => 
  array (
    'JS' => 0,
    'project' => 0,
    'SITE_URL' => 0,
    'currentUrl' => 0,
    'drawRequestItems' => 0,
    'k' => 0,
    'item' => 0,
    'IMAGES' => 0,
    'totalItems' => 0,
    'company' => 0,
    'margin' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_545a951f51d094_27562508')) {function content_545a951f51d094_27562508($_smarty_tpl) {?><script type="text/javascript" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['JS']->value, ENT_QUOTES, 'UTF-8');?>
/drawRequest.js"></script>

<h1><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->name, ENT_QUOTES, 'UTF-8');?>
</h1>

<form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
" method="post" id="new-request">
	<input type="hidden" name="page" value="draw_requests">
	<input type="hidden" name="action" value="submit">
	<input type="hidden" name="id" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->public_id, ENT_QUOTES, 'UTF-8');?>
">
	<input type="hidden" name="path" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currentUrl']->value, ENT_QUOTES, 'UTF-8');?>
">

	<table class="form">
		<tr>
			<th colspan="4">Draw Request</th>
		</tr>
		<tr>
			<td><strong>Payee</strong></td>
			<td><strong>Estimate Item</strong></td>
			<td style="width: 200px"><strong>Amount</strong></td>
			<td>&nbsp;</td>
		</tr>
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['drawRequestItems']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
		<tr>
			<td>
				<input type="text" class="payee-search new-payee" name="new_payee[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['k']->value, ENT_QUOTES, 'UTF-8');?>
]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value->name, ENT_QUOTES, 'UTF-8');?>
" style="width: 200px">
				<input type="hidden" name="payee[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['k']->value, ENT_QUOTES, 'UTF-8');?>
]" class="payee" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value->company_id, ENT_QUOTES, 'UTF-8');?>
">
			</td>
			<td>
				<input type="text" class="section-item-search" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value->section_item_name, ENT_QUOTES, 'UTF-8');?>
" style="width: 250px">
				<input type="hidden" name="section_item[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['k']->value, ENT_QUOTES, 'UTF-8');?>
]" class="section-item" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value->section_item_id, ENT_QUOTES, 'UTF-8');?>
">
			</td>
			<td><input type="text" name="amount[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['k']->value, ENT_QUOTES, 'UTF-8');?>
]" class="amount" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value->amount, ENT_QUOTES, 'UTF-8');?>
" style="width: 75px"></td>
			<td><a href="" class="delete" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value->id, ENT_QUOTES, 'UTF-8');?>
"><img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['IMAGES']->value, ENT_QUOTES, 'UTF-8');?>
/trash.png" alt=""></a></td>
		</tr>
		<?php } ?>
		<tr class="clone-row">
			<td>
				<input type="text" class="payee-search new-payee" name="new_payee[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['totalItems']->value, ENT_QUOTES, 'UTF-8');?>
]" style="width: 200px">
				<input type="hidden" name="payee[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['totalItems']->value, ENT_QUOTES, 'UTF-8');?>
]" class="payee" value="">
			</td>
			<td>
				<input type="text" class="section-item-search" style="width: 250px">
				<input type="hidden" name="section_item[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['totalItems']->value, ENT_QUOTES, 'UTF-8');?>
]" class="section-item" value="">
			</td>
			<td><input type="text" name="amount[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['totalItems']->value, ENT_QUOTES, 'UTF-8');?>
]" class="amount" value="" style="width: 75px"></td>
			<td><a href="" class="delete"><img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['IMAGES']->value, ENT_QUOTES, 'UTF-8');?>
/trash.png" alt=""></a></td>
		</tr>
		<tr>
			<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company']->value->name, ENT_QUOTES, 'UTF-8');?>
</td>
			<td>Profit Margin</td>
			<td><input type="text" id="margin" name="margin_amount" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['margin']->value, ENT_QUOTES, 'UTF-8');?>
" style="width:75px"></td>
		</tr>
		<tr>
			<td colspan="4">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="4">&nbsp;</td>
		</tr>
		<tr>
			<td><input type="button" value="Cancel" onclick="history.go(-1)"> </td>
			<td colspan="3" class="text-right">
				<input type="submit" value="Submit">
				<input type="button" id="save" value="Save">
			</td>
		</tr>

	</table>



<div id="dialog" title="Submit the Draw Request">
	<p>Submitting this draw request will send an automated email to the homeowner and/or bank.  Are you ready to proceed?</p>
</div>
<div id="delete-dialog" title="Remove Draw Request Item">
	<p>Are you sure? This draw request item will be permanately removed.</p>
</div>
</form><?php }} ?>
