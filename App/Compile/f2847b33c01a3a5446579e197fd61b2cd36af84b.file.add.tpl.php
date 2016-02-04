<?php /* Smarty version Smarty-3.1.19, created on 2014-11-12 16:11:42
         compiled from "/mnt/hgfs/Sites/buildcommand/App/Views/partners/add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:921945647545ace9a932749-09563348%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f2847b33c01a3a5446579e197fd61b2cd36af84b' => 
    array (
      0 => '/mnt/hgfs/Sites/buildcommand/App/Views/partners/add.tpl',
      1 => 1415833898,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '921945647545ace9a932749-09563348',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_545ace9a93b2f7_74487324',
  'variables' => 
  array (
    'SITE_URL' => 0,
    'partner' => 0,
    'currentUrl' => 0,
    'accountTypes' => 0,
    'type' => 0,
    'companyAccountType' => 0,
    'companySpecialityType' => 0,
    'addSpecs' => 0,
    'accountSpecialities' => 0,
    'as' => 0,
    'k' => 0,
    's' => 0,
    'states' => 0,
    'editPartner' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_545ace9a93b2f7_74487324')) {function content_545ace9a93b2f7_74487324($_smarty_tpl) {?><script>
	$(document).ready(function() {
		var specialityId = '';

		$(".account-speciality-cell").hide();
		$("#states").selectmenu();

		if ($("input#additional-specialities").is(":checked")) {
			$(".additional-types-row").show();
		} else {
			$(".additional-types-row").hide();
		}

		if ($("#account-type").val() != '') {
			var accountType = $("option:selected", this);
			var accountValue = accountType.val();

			$.post(SITE_URL, { page: "account_specialities", action: "findByAccountType", account_type: accountValue }, function(data) {
						var object = $.parseJSON(data);
						specialityId = $("#account-speciality option:selected").val();
						$("#account-speciality").html('');
						$("#account-speciality").append("<option>Select...</option>");
						$.each(object, function(item, value) {
							if (specialityId == value.id) {
								$("#account-speciality").append("<option value=\"" + value.id + "\" selected>" + value.name + "</option");
							} else {
								$("#account-speciality").append("<option value=\"" + value.id + "\">" + value.name + "</option");
							}
							
						});
						$("#account-speciality").selectmenu({
							width: 180
						});
						$("#account-speciality").selectmenu("refresh");
						

						$(".account-speciality-cell").show();
				});
			$(".account-speciality-cell").show();
		}

		$("#account-type").selectmenu({
			width: 100,
			change: function(e,ui) {
				var accountType = $("option:selected", this);
				var accountValue = accountType.val();
				specialityId = accountValue;
				$("." + specialityId).prop('checked', true);

				$.post(SITE_URL, { page: "account_specialities", action: "findByAccountType", account_type: accountValue }, function(data) {
						var object = $.parseJSON(data);
						$("#account-speciality").html('');
						$("#account-speciality").append("<option>Select...</option>");
						$.each(object, function(item, value) {
							$("#account-speciality").append("<option value=\"" + value.id + "\">" + value.name + "</option");
						});
						$("#account-speciality").selectmenu({
							width: 180
						});
						$("#account-speciality").selectmenu("refresh");
						$(".account-speciality-cell").show();
				});
				
			}
		});
		

		$("#additional-specialities").change(function() {
			if ($(this).is(":checked")) {
				$(".additional-types-row").show();
			} else {
				$(".additional-types-row").hide();
			}
		});

		// want to fetch the account speciality types based on the selected account type
		$("#account-type").change(function () {
			
		});

		$("#delete").click(function(e) {
			e.preventDefault();
			console.log($("#partner-id").val());
			var item = $(this);
			$("#delete-dialog").dialog({
				buttons: {
					"Confirm": function() {
						var id = $("#partner-id").val();

						$.ajax({
							type: 'post',
							url: SITE_URL,
							data: {
								page: "companies",
								action: 'deleteId',
								id: id,
							},
							success: function() {
								window.location.href = SITE_URL + "/?page=partners";
							}
						});
						$(this).dialog("close");

					},
					"Cancel": function() {
						$(this).dialog("close");
					}
				}
			});
		});



	});
</script>

<h1>Add New Partner</h1>

<form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
" method="post">
	<input type="hidden" name="page" value="partners">
	<input type="hidden" name="action" value="submit">
	<input type="hidden" name="id" id="partner-id" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['partner']->value->public_id, ENT_QUOTES, 'UTF-8');?>
">
	<input type="hidden" name="path" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currentUrl']->value, ENT_QUOTES, 'UTF-8');?>
">

	<table class="form">
		<tr class="title-row">
			<td>Company Name</td>
			<td colspan="2">Contact Name</td>
		</tr>
		<tr>
			<td><input type="text" name="name" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['partner']->value->name, ENT_QUOTES, 'UTF-8');?>
" style="width: 275px"></td>
			<td colspan="2"><input type="text" name="contact_name" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['partner']->value->contact_name, ENT_QUOTES, 'UTF-8');?>
" style="width: 250px"></td>
		</tr>


		<tr class="title-row">
			<td>Account Type</td>
			<td class="account-speciality-cell">Account Speciality</td>
		</tr>
		<tr>
			<td>
				<select name="account_type" id="account-type">
					<option value="">Select...</option>
					<?php  $_smarty_tpl->tpl_vars['type'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['type']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['accountTypes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['type']->key => $_smarty_tpl->tpl_vars['type']->value) {
$_smarty_tpl->tpl_vars['type']->_loop = true;
?>
					<option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['type']->value->id, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['companyAccountType']->value) {?> <?php if ($_smarty_tpl->tpl_vars['companyAccountType']->value->id==$_smarty_tpl->tpl_vars['type']->value->id) {?> selected<?php }?><?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['type']->value->name, ENT_QUOTES, 'UTF-8');?>
</option>
					<?php } ?>
				</select>
			</td>
			<td class="account-speciality-cell">
				<select name="account_speciality" id="account-speciality">
					<option value="<?php if ($_smarty_tpl->tpl_vars['companySpecialityType']->value) {?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['companySpecialityType']->value->id, ENT_QUOTES, 'UTF-8');?>
<?php }?>">Select...</option>
				</select>
			</td>
		</tr>

		<tr class="title-row">
			<td><input type="checkbox" name="additional_specialities" id="additional-specialities" value="true" <?php if (isset($_smarty_tpl->tpl_vars['addSpecs']->value)) {?> checked<?php }?>> Add additional speciality types</td>
		</tr>
	
		<input type="hidden" name="add_specs">
		
		<tr class="additional-types-row">
			<td colspan="3">
				<table>
					<tr>
					<?php  $_smarty_tpl->tpl_vars['as'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['as']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['accountSpecialities']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['counter']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['as']->key => $_smarty_tpl->tpl_vars['as']->value) {
$_smarty_tpl->tpl_vars['as']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['as']->key;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['counter']['iteration']++;
?>
						<td><input type="checkbox" class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['as']->value->id, ENT_QUOTES, 'UTF-8');?>
" name="account_speciality_id[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['k']->value, ENT_QUOTES, 'UTF-8');?>
]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['as']->value->id, ENT_QUOTES, 'UTF-8');?>
"<?php if (isset($_smarty_tpl->tpl_vars['addSpecs']->value)) {?><?php  $_smarty_tpl->tpl_vars['s'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['s']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['addSpecs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['s']->key => $_smarty_tpl->tpl_vars['s']->value) {
$_smarty_tpl->tpl_vars['s']->_loop = true;
?><?php if ($_smarty_tpl->tpl_vars['s']->value->id==$_smarty_tpl->tpl_vars['as']->value->id) {?> checked<?php }?><?php } ?><?php }?>> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['as']->value->name, ENT_QUOTES, 'UTF-8');?>
</td>
							<?php if (!($_smarty_tpl->getVariable('smarty')->value['foreach']['counter']['iteration'] % 3)) {?>
							</tr>
							<tr>
							<?php }?>
						</td>
					<?php } ?>
					</tr>
				</table>
			</td>
		
		</tr>

		<tr class="title-row">
			<td colspan="3">Address</td>
		</tr>
		<tr>
			<td colspan="3"><input type="text" name="address" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['partner']->value->address, ENT_QUOTES, 'UTF-8');?>
" style="width: 400px"></td>
		</tr>


		<tr class="title-row">
			<td>City</td>
			<td>State</td>
			<td>Zip</td>
		</tr>
		<tr>
			<td><input type="text" name="city" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['partner']->value->city, ENT_QUOTES, 'UTF-8');?>
" style="width: 200px"></td>
			<td>
				<select name="state" id="states">
					<option value="">Select...</option>
					<?php  $_smarty_tpl->tpl_vars['s'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['s']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['states']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['s']->key => $_smarty_tpl->tpl_vars['s']->value) {
$_smarty_tpl->tpl_vars['s']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['s']->key;
?>
					<option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['k']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['partner']->value->state==$_smarty_tpl->tpl_vars['k']->value) {?>selected<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['s']->value, ENT_QUOTES, 'UTF-8');?>
 (<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['k']->value, ENT_QUOTES, 'UTF-8');?>
)</option>
					<?php } ?>
				</select>
			</td>
			<td><input type="text" name="zip" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['partner']->value->zip, ENT_QUOTES, 'UTF-8');?>
" style="width: 50px"></td>
		</tr>


		<tr class="title-row">
			<td>Phone</td>
			<td>Fax</td>
		</tr>
		<tr>
			<td><input type="text" name="phone" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['partner']->value->phone, ENT_QUOTES, 'UTF-8');?>
"></td>
			<td><input type="text" name="fax" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['partner']->value->fax, ENT_QUOTES, 'UTF-8');?>
"></td>
		</tr>


		<tr class="title-row">
			<td>Email</td>
			<td>License Number</td>
		</tr>
		<tr>
			<td><input type="text" name="email" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['partner']->value->email, ENT_QUOTES, 'UTF-8');?>
"></td>
			<td><input type="text" name="license_number" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['partner']->value->license_number, ENT_QUOTES, 'UTF-8');?>
"></td>
		</tr>


		<tr class="title-row">
			<td>Logo</td>
		</tr>

		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td>
				<input type="button" value="Cancel" onclick="history.go(-1)">
				<?php if ($_smarty_tpl->tpl_vars['editPartner']->value) {?>
				<a href="#" id="delete" class="delete-button">Delete</a>
				<?php }?>
			</td>
			<td class="text-right" colspan="2"><input type="submit" value="Save"></td>
		</tr>
	</table>
</form>


<div id="delete-dialog" title="Confirmation Required">
	<p>Are you sure you want to delete this partner? This cannot be undone.</p>
</div><?php }} ?>
