
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{$title}  | {$COMPANY_NAME}</title>
	<link rel="stylesheet" href="{$JS}/jquery-ui-1.11.2.custom/jquery-ui.min.css">
	<link rel="stylesheet" href="{$JS}/jQuery-Autocomplete-master/content/styles.css" />
	<link rel="stylesheet" href="{$CSS}/styles.css">
	<script src="{$JS}/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="{$JS}/jquery-validation-1.13.0/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="{$JS}/jquery-ui-1.11.2.custom/jquery-ui.min.js"></script>
	<script type="text/javascript" src="{$JS}/jQuery-Autocomplete-master/dist/jquery.autocomplete.min.js"></script>
	<script type="text/javascript" src="{$JS}/shadowbox-3.0.3/shadowbox.js"></script>
	<link rel="stylesheet" href="{$JS}/shadowbox-3.0.3/shadowbox.css">
	<script type="text/javascript" src="{$JS}/general.js"></script>
	<script>
		var SITE_URL = '{$SITE_URL}';
		Shadowbox.init();
	</script>
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<div id="logo">
				{if $headerImage}
					<img src="{$headerImage}" alt="" height="50">
				{else}
					<img src="{$IMAGES}/buildcommand_beta_logo.png" alt="">
				{/if}
			</div>
			<div id="login">
				{if !$auth->isLoggedIn()}
				<a href="{$SITE_URL}/login">Login</a>&nbsp;|&nbsp; <a href="{$SITE_URL}/register">Register</a>
				{else}
				Hello, {$auth->getRecord()->fullName()}&nbsp;|&nbsp; <a href="{$SITE_URL}/logout">Logout</a>
				{/if} 

				
			</div>
			<nav>
				{if $auth->isLoggedIn()}
					{include file="elements/user_nav.tpl"}
				{else}
					{include file="elements/navigation.tpl"}
				{/if}
			</nav>
		</div>
		<div id="content">
			{if $flashMessages}
			<div id="flash-messages">
				{foreach $flashMessages as $class => $message}
				<div class="{$class}">
					<ul>
					{foreach $message as $m}
						<li>{$m}</li>
					{/foreach}
					</ul>
				</div>
				<div class="clear"></div>
				{/foreach}
			</div>
			{/if}

			<div id="page-content">
				{include file=$content}
			</div>
			
		</div>
	</div>
	<div id="footer">All content &copy; {$smarty.now|date_format: "%Y"} BuildCommand. Powered by <a href="http://www.aptitudeit.net" target="_blank">aptitude</a>.</div>
	
</body>
</html>