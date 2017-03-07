<div class="container">
  <div class="login-container">
    <form class="form-signin" action="{$SITE_URL}" method="post">
      <input type="hidden" name="page" value="login">
      <input type="hidden" name="action" value="submitLogin">
      <input type="hidden" name="path" value="{$currentUrl}">
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" class="form-control"  name="user" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
      <div class="checkbox text-right">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
      </div>
      <input class="btn btn-lg btn-primary btn-block" type="submit" value="Login">
    </form>
  </div>
</div> <!-- /container -->

