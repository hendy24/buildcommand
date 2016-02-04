<?php /* Smarty version Smarty-3.1.19, created on 2014-11-12 16:31:52
         compiled from "/mnt/hgfs/Sites/buildcommand/App/Views/draw_requests/new_request.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13373195275453e611bf14c2-76120734%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9a7d5e970a9b8ba90e7f9ca4bfc493bd32ba34e3' => 
    array (
      0 => '/mnt/hgfs/Sites/buildcommand/App/Views/draw_requests/new_request.tpl',
      1 => 1415232343,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13373195275453e611bf14c2-76120734',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5453e611bf34c0_77327346',
  'variables' => 
  array (
    'JS' => 0,
    'project' => 0,
    'SITE_URL' => 0,
    'currentUrl' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5453e611bf34c0_77327346')) {function content_5453e611bf34c0_77327346($_smarty_tpl) {?><script type="text/javascript" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['JS']->value, ENT_QUOTES, 'UTF-8');?>
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
		<tr class="clone-row">
			<td>
				<input type="text" class="payee-search new-payee" name="new_payee[0]" style="width: 200px">
				<input type="hidden" name="payee[0]" class="payee" value="">
			</td>
			<td>
				<input type="text" class="section-item-search" style="width: 250px">
				<input type="hidden" name="section_item[0]" class="section-item" value="">
			</td>
			<td><input type="text" name="amount[0]" class="amount" style="width: 75px"></td>
			<td style="width: 20px">
				<input type="button" name="add_row" value="Add" class="add-row">
			</td>
		</tr>
		<tr>
			<td colspan="4">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="4">&nbsp;</td>
		</tr>
		<tr>
			<td><input type="button" value="Cancel"></td>
			<td colspan="3" class="text-right">
				<input type="button" id="save" value="Save">
				<input type="submit" id="submit" value="Submit">
			</td>
		</tr>
	</table>

</form><?php }} ?>
