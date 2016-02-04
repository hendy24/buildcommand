<script>
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

<form action="{$SITE_URL}" method="post">
	<input type="hidden" name="page" value="partners">
	<input type="hidden" name="action" value="submit">
	<input type="hidden" name="id" id="partner-id" value="{$partner->public_id}">
	<input type="hidden" name="path" value="{$currentUrl}">

	<table class="form">
		<tr class="title-row">
			<td>Company Name</td>
			<td colspan="2">Contact Name</td>
		</tr>
		<tr>
			<td><input type="text" name="name" value="{$partner->name}" style="width: 275px"></td>
			<td colspan="2"><input type="text" name="contact_name" value="{$partner->contact_name}" style="width: 250px"></td>
		</tr>


		<tr class="title-row">
			<td>Account Type</td>
			<td class="account-speciality-cell">Account Speciality</td>
		</tr>
		<tr>
			<td>
				<select name="account_type" id="account-type">
					<option value="">Select...</option>
					{foreach $accountTypes as $type}
					<option value="{$type->id}" {if $companyAccountType} {if $companyAccountType->id == $type->id} selected{/if}{/if}>{$type->name}</option>
					{/foreach}
				</select>
			</td>
			<td class="account-speciality-cell">
				<select name="account_speciality" id="account-speciality">
					<option value="{if $companySpecialityType}{$companySpecialityType->id}{/if}">Select...</option>
				</select>
			</td>
		</tr>

		<tr class="title-row">
			<td><input type="checkbox" name="additional_specialities" id="additional-specialities" value="true" {if isset ($addSpecs)} checked{/if}> Add additional speciality types</td>
		</tr>
	
		<input type="hidden" name="add_specs">
		
		<tr class="additional-types-row">
			<td colspan="3">
				<table>
					<tr>
					{foreach $accountSpecialities as $k => $as name='counter'}
						<td><input type="checkbox" class="{$as->id}" name="account_speciality_id[{$k}]" value="{$as->id}"{if isset($addSpecs)}{foreach $addSpecs as $s}{if $s->id == $as->id} checked{/if}{/foreach}{/if}> {$as->name}</td>
							{if $smarty.foreach.counter.iteration is div by 3}
							</tr>
							<tr>
							{/if}
						</td>
					{/foreach}
					</tr>
				</table>
			</td>
		
		</tr>

		<tr class="title-row">
			<td colspan="3">Address</td>
		</tr>
		<tr>
			<td colspan="3"><input type="text" name="address" value="{$partner->address}" style="width: 400px"></td>
		</tr>


		<tr class="title-row">
			<td>City</td>
			<td>State</td>
			<td>Zip</td>
		</tr>
		<tr>
			<td><input type="text" name="city" value="{$partner->city}" style="width: 200px"></td>
			<td>
				<select name="state" id="states">
					<option value="">Select...</option>
					{foreach $states as $k => $s}
					<option value="{$k}" {if $partner->state == $k}selected{/if}>{$s} ({$k})</option>
					{/foreach}
				</select>
			</td>
			<td><input type="text" name="zip" value="{$partner->zip}" style="width: 50px"></td>
		</tr>


		<tr class="title-row">
			<td>Phone</td>
			<td>Fax</td>
		</tr>
		<tr>
			<td><input type="text" name="phone" value="{$partner->phone}"></td>
			<td><input type="text" name="fax" value="{$partner->fax}"></td>
		</tr>


		<tr class="title-row">
			<td>Email</td>
			<td>License Number</td>
		</tr>
		<tr>
			<td><input type="text" name="email" value="{$partner->email}"></td>
			<td><input type="text" name="license_number" value="{$partner->license_number}"></td>
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
				{if $editPartner}
				<a href="#" id="delete" class="delete-button">Delete</a>
				{/if}
			</td>
			<td class="text-right" colspan="2"><input type="submit" value="Save"></td>
		</tr>
	</table>
</form>


<div id="delete-dialog" title="Confirmation Required">
	<p>Are you sure you want to delete this partner? This cannot be undone.</p>
</div>