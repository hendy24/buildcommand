<script>
	$(document).ready(function() {
	});
</script>


<h1>Change Password<br />
<span class="text-18">for <br>{$editUser->fullName()}</span></h1>

<form action="{$SITE_URL}" method="post"> 
	<input type="hidden" name="page" value="users">
	<input type="hidden" name="action" value="change_password">
	<input type="hidden" name="id" value="{$editUser->public_id}">
	<input type="hidden" name="path" value="{$currentUrl}">

	<table class="form">
		<tr>
			<td><strong>Password:</strong></td>
			<td><input type="password" name="password"></td>
		</tr>
		<tr>
			<td><strong>Verify Password:</strong></td>
			<td><input type="password" name="verify_password"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><input type="button" value="Cancel" onclick="history.go(-1)"> </td>
			<td align="right"><input type="submit" value="Save"></td>
	</table>
</form>