<div id="login-page">
	<h1 class="text-center">Login</h2>

	<form action="{$SITE_URL}" method="post">
		<input type="hidden" name="page" value="login">
		<input type="hidden" name="action" value="submitLogin">
		<input type="hidden" name="path" value="{$currentUrl}">
		<table>
			<tr>
				<td>Username: </td>
				<td><input type="text" name="user" style="width: 200px"></td>
			</tr>
			<tr>
				<td>Password: </td>
				<td><input type="password" name="password" style="width: 200px"></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: right;"><input type="submit" value="Login"></td>
			</tr>
		</table>
	</form>

</div>

