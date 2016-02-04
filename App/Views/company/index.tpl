<script>
	$(document).ready(function() {
		$("#state").selectmenu();
	});
</script>
<h1>Company Info</h1>

<form action="{$SITE_URL}" method="post">
	<input type="hidden" name="page" value="company">
	<input type="hidden" name="action" value="index">
	<input type="hidden" name="path" value="{$currentUrl}">

	<table class="form">
		<tr>
			<td colspan="3"><strong>Business Name:</strong></td>
		</tr>
		<tr>
			<td colspan="3"><input type="text" name="name" value="{$company->name}" size="60"></td>
		</tr>
		<tr>
			<td colspan="3"><strong>Address:</strong></td>	
		</tr>
		<tr>
			<td colspan="3"><input type="text" name="address" value="{$company->address}" size="60"></td>
		</tr>
		<tr>
			<td style="width: 200px"><strong>City</strong></td>
			<td><strong>State</strong></td>
			<td><strong>Zip</strong></td>
		</tr>
		<tr>
			<td><input type="text" name="city" value="{$company->city}"></td>
			<td>
				<select name="state" id="state">
					<option value="">Select state...</option>
					{foreach $states as $key => $state}
						<option value="{$key}" {if $company->state == $key} selected{/if}>{$state} ({$key})</option>
					{/foreach}
				</select> 
			</td>
			<td colspan="2"><input type="text" name="zip" value="{$company->zip}" size="10"></td>
		</tr>
		<tr>
			<td><strong>Phone:</strong></td>
			<td colspan="2"><strong>Fax:</strong></td>
		</tr>
		<tr>
			<td><input type="text" name="phone" value="{$company->phone}"></td>
			<td colspan="2"><input type="text" name="fax" value="{$company->fax}"></td>
		</tr>
		<tr>
			<td colspan="2"><strong>Email:</strong></td>
			<td><strong>License #:</strong></td>
		</tr>
		<tr>
			<td colspan="2"><input type="text" name="email" value="{$company->email}" size="40"></td>
			<td><input type="text" name="license_number" value="{$company->license_number}"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3" align="right"><input type="submit" value="Save"></td>
		</tr>
	</table>
</form>
