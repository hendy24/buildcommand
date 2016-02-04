<?php /* Smarty version Smarty-3.1.19, created on 2014-10-30 13:43:19
         compiled from "/mnt/hgfs/Sites/buildcommand/App/Views/estimate_details/foundation_labor.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1600699345545282b7c485d2-61366489%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '53c59b717a5078024b6f26c500107de5d2a761b2' => 
    array (
      0 => '/mnt/hgfs/Sites/buildcommand/App/Views/estimate_details/foundation_labor.tpl',
      1 => 1414698192,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1600699345545282b7c485d2-61366489',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_545282b7c4ad46_65208026',
  'variables' => 
  array (
    'SITE_URL' => 0,
    'currentUrl' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_545282b7c4ad46_65208026')) {function content_545282b7c4ad46_65208026($_smarty_tpl) {?><h1>Foundation Labor Detail</h1>

<form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
">
	<input type="hidden" name="page" action="estimate_details">
	<input type="hidden" name="action" value="foundation_labor">
	<input type="hidden" name="path" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currentUrl']->value, ENT_QUOTES, 'UTF-8');?>
">

	<table>
		<tr>
			<th>Type</th>
			<th>Linear Feet</th>
			<th>Price / Ft</th>
			<th>Cost</th>
		</tr>
		<tr>
			<td style="width: 300px">Footing Labor</td>
			<td><input type="text" name="length"></td>
			<td><input type="text" name="cost_per_item"></td>
			<td><input type="text" name="estimated_cost"></td>
		</tr>
		<tr>
			<td>Foundation Material</td>
			<td><input type="text" name="length"></td>
			<td><input type="text" name="cost_per_item"></td>
			<td><input type="text" name="estimated_cost"></td>
		</tr>
		<tr>
			<td>Rebar</td>
			<td><input type="text" name="length"></td>
			<td><input type="text" name="cost_per_item"></td>
			<td><input type="text" name="estimated_cost"></td>
		</tr>
		<tr>
			<td>Foundation Vents</td>
			<td><input type="text" name="length"></td>
			<td><input type="text" name="cost_per_item"></td>
			<td><input type="text" name="estimated_cost"></td>
		</tr>
		<tr>
			<td colspan="4" class="text-right"><input type="submit" value="Save"></td>
		</tr>
	</table>
</form><?php }} ?>
