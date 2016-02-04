<script>
	$(document).ready(function() {
		// $(".phone").mask("(999) 999-9999");
		$("#state").selectmenu();
	});
</script>


<h1>Account Information</h1>

<form action="{$SITE_URL}" method="post">
	<input type="hidden" name="page" value="users">
	<input type="hidden" name="action" value="account_info">
	<input type="hidden" name="path" value="{$currentUrl}">

	<table class="form">
		<tr>
			<th colspan="3">Personal</th>
		</tr>
		<tr>
			<td><strong>First Name:</strong></td>
			<td><strong>Last Name:</strong></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><input type="text" name="first_name" value="{$accountUser->first_name}"></td>
			<td colspan="2"><input type="text" name="last_name" value="{$accountUser->last_name}" style="width: 200px"></td>
		</tr>
		<tr>
			<td colspan="3"><strong>Address:</strong></td>	
		</tr>
		<tr>
			<td colspan="3"><input type="text" name="address" value="{$accountUser->address}" style="width: 400px"></td>
		</tr>
		<tr>
			<td><strong>City</strong></td>
			<td><strong>State</strong></td>
			<td><strong>Zip</strong></td>
		</tr>
		<tr>
			<td><input type="text" name="city" value="{$accountUser->city}"></td>
			<td>
				<select name="state" id="state">
					<option value="">Select...</option>
					{foreach $states as $key => $state}
						<option value="{$key}"{if $accountUser->state == $key} selected{/if}>{$state} ({$key})</option>
					{/foreach}
				</select>
			</td>
			<td><input type="text" name="zip" value="{$accountUser->zip}" style="width: 90px"></td>
		</tr>
		<tr>
			<td colspan="3"><strong>Phone:</strong></td>
		</tr>
		<tr>
			<td colspan="3"><input type="text" name="phone" value="{$accountUser->phone}"></td>

		</tr>
		<tr>
			<td colspan="2"><strong>Username (Email Address:)</strong></td>
			<td ><strong>Password:</strong></td>
		</tr>
		<tr>
			<td colspan="2"><input type="text" name="email" value="{$accountUser->email}" style="width: 300px"></td>
			{if $auth->is_admin() || $auth->getRecord()->public_id == $accountUser->public_id}
				<td><a href="{$SITE_URL}/?page=users&amp;action=change_password&amp;id={$accountUser->public_id}" class="button">Reset</a></td>
			{else}
				<td>&nbsp;</td>
			{/if}
		</tr>
			
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3" class="text-right"><input type="submit" value="Save"></td>
		</tr>


	</table>
</form>
