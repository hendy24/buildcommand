    <div class="container">

      <form class="form-signin">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->






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

