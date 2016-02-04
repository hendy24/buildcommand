<?php /* Smarty version Smarty-3.1.19, created on 2015-01-16 10:23:24
         compiled from "/mnt/hgfs/Sites/buildcommand/App/Views/elements/estimate_page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7721809005437647002ea37-40181744%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '62414bc33fdbae0e2d7431bd92423d716c433f3d' => 
    array (
      0 => '/mnt/hgfs/Sites/buildcommand/App/Views/elements/estimate_page.tpl',
      1 => 1421429002,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7721809005437647002ea37-40181744',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_54376470041766_68926449',
  'variables' => 
  array (
    'SITE_URL' => 0,
    'project' => 0,
    'IMAGES' => 0,
    'action' => 0,
    'currentUrl' => 0,
    'pageTitle' => 0,
    'pageData' => 0,
    'sectionName' => 0,
    'data' => 0,
    'sectionItemName' => 0,
    'margin' => 0,
    'contingency' => 0,
    'item' => 0,
    'auth' => 0,
    'projectId' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54376470041766_68926449')) {function content_54376470041766_68926449($_smarty_tpl) {?><script>
	$(document).ready(function() {
		$("#estimateForm").validate();

		$("#cancel").click(function (e) {
			e.preventDefault();
			window.location = SITE_URL + "/?page=projects&action=manage&id=" + $("#project-id").val();
		});
	});
</script>

<div id="icons">
	<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/files/plans/<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->plan_filename, ENT_QUOTES, 'UTF-8');?>
" target="_blank">
		<img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['IMAGES']->value, ENT_QUOTES, 'UTF-8');?>
/house_building.png" alt="">
	</a>
	<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/?page=estimates&amp;action=printView&amp;id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->public_id, ENT_QUOTES, 'UTF-8');?>
"><img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/images/printer.png" alt=""></a>
</div>

<div id="cost-totals">
	<div id="cost-left"><span class=" text-grey">Estimated Cost:</span> &nbsp;<strong><?php echo htmlspecialchars(currency_format($_smarty_tpl->tpl_vars['project']->value->estimated_cost), ENT_QUOTES, 'UTF-8');?>
</strong></div>
	<div id="cost-right"><span class=" text-grey">Actual Cost:</span> &nbsp;<strong><?php echo htmlspecialchars(currency_format($_smarty_tpl->tpl_vars['project']->value->actual_cost), ENT_QUOTES, 'UTF-8');?>
</strong></div>
</div>

<form id="estimateForm" action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
" method="post">
	<input type="hidden" name="page" value="estimates">
	<input type="hidden" name="action" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8');?>
">
	<input type="hidden" id="project-id" name="id" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->id, ENT_QUOTES, 'UTF-8');?>
">
	<input type="hidden" name="path" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currentUrl']->value, ENT_QUOTES, 'UTF-8');?>
">

	<table id="estimate-table">
		<tr>
			<th colspan="6"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['pageTitle']->value, ENT_QUOTES, 'UTF-8');?>
</th>
		</tr>
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
			<td colspan="2"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sectionName']->value, ENT_QUOTES, 'UTF-8');?>
</td>
			<td class="text-center"><?php if (isset($_smarty_tpl->tpl_vars['data']->value['cost'])&&$_smarty_tpl->tpl_vars['data']->value['cost']->estimated_cost!='') {?><?php echo htmlspecialchars(currency_format((($tmp = @$_smarty_tpl->tpl_vars['data']->value['cost']->estimated_cost)===null||$tmp==='' ? "$"."0.00" : $tmp)), ENT_QUOTES, 'UTF-8');?>
<?php } else { ?>$0.00<?php }?></td>
			<td class="text-center"><?php if (isset($_smarty_tpl->tpl_vars['data']->value['cost'])&&$_smarty_tpl->tpl_vars['data']->value['cost']->actual_cost!='') {?><?php echo htmlspecialchars(currency_format((($tmp = @$_smarty_tpl->tpl_vars['data']->value['cost']->actual_cost)===null||$tmp==='' ? "$"."0.00" : $tmp)), ENT_QUOTES, 'UTF-8');?>
<?php } else { ?>$0.00<?php }?></td>
			<td></td>
			<td></td>
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

				<input class="estimate-number <?php if ($_smarty_tpl->tpl_vars['item']->value->estimated_cost=='0.00') {?>text-grey<?php }?>" type="text" name="estimated_cost[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value->section_item_id, ENT_QUOTES, 'UTF-8');?>
]" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['item']->value->estimated_cost)===null||$tmp==='' ? "0.00" : $tmp), ENT_QUOTES, 'UTF-8');?>
" pattern="[0-9]*" <?php if ($_smarty_tpl->tpl_vars['auth']->value->read_only()) {?>readonly<?php }?>>
				<?php }?>
			</td>

			<?php if (isset($_smarty_tpl->tpl_vars['item']->value->estimated_cost)&&$_smarty_tpl->tpl_vars['item']->value->estimated_cost!="0.00") {?>
			<td>
				$<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['item']->value->actual_cost)===null||$tmp==='' ? "0.00" : $tmp), ENT_QUOTES, 'UTF-8');?>

			</td>
			<?php } else { ?>
			<td>&nbsp;</td>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['item']->value->hasSectionDetail($_smarty_tpl->tpl_vars['sectionItemName']->value)) {?>
			<td class="icon-link"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/?page=estimate_details&amp;action=<?php echo htmlspecialchars(underscore_string($_smarty_tpl->tpl_vars['sectionItemName']->value), ENT_QUOTES, 'UTF-8');?>
&amp;id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['projectId']->value, ENT_QUOTES, 'UTF-8');?>
" rel="shadowbox;width=800"><img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['IMAGES']->value, ENT_QUOTES, 'UTF-8');?>
/details-icon.png" alt="Show section details"></a></td>
			<?php } else { ?>
			<td>&nbsp;</td>
			<?php }?>
			<td class="icon-link"><img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['IMAGES']->value, ENT_QUOTES, 'UTF-8');?>
/file_pdf.png" alt="Upload a contractor estimate"></td>
			

			
			<tr class="details-table">
				<td>
					<table class="detail">
						<tr>
							<td>Test</td>
						</tr>
					</table>
				</td>
			</tr>


		</tr>
		<?php }?>
		<?php } ?>
		<?php } ?>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2"><input type="button" value="Cancel" id="cancel"></td>
			<td colspan="5" class="text-right">
				<input type="button" value="Back" onclick="history.go(-1)">
				<?php if ($_smarty_tpl->tpl_vars['pageTitle']->value=="Closing") {?>
				<input type="submit" value="Done">
				<?php } else { ?>
				<input type="submit" value="Next">
				<?php }?>
			</td>
		</tr>
	</table>
</form>
<?php }} ?>
