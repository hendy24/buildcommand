<?php /* Smarty version Smarty-3.1.19, created on 2014-10-31 11:03:14
         compiled from "/mnt/hgfs/Sites/buildcommand/App/Views/estimates/general.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1652597575543617a2d34527-19214249%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b4b1b71f5c2e6bc214a5830e5e08f98ebb1ac192' => 
    array (
      0 => '/mnt/hgfs/Sites/buildcommand/App/Views/estimates/general.tpl',
      1 => 1414774913,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1652597575543617a2d34527-19214249',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_543617a2d36602_36850691',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543617a2d36602_36850691')) {function content_543617a2d36602_36850691($_smarty_tpl) {?><script>
	$(document).ready(function() {
		$(".estimate-number");
	});
</script>

<div id="general">
	<?php echo $_smarty_tpl->getSubTemplate ("elements/estimate_nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php echo $_smarty_tpl->getSubTemplate ("elements/estimate_page.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
	
</div>


<?php }} ?>
