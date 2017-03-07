
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width-=device-width, initial-scale=1">
	<title>{$title}  | {$COMPANY_NAME}</title>

	<link rel="stylesheet" href="{$CSS}/bootstrap.min.css">
	<link rel="stylesheet" href="{$CSS}/bootstrap-theme.min.css">
	<link rel="stylesheet" href="{$CSS}/common.css">
	<link rel="stylesheet" href="{$CSS}/login-page.css">
</head>
<body>
	<div class="container-fluid">
		<div class="page-wrapper">
			<div id="logo">
				{if $headerImage}
					<img src="{$headerImage}" alt="" height="50">
				{else}
					<img src="{$IMAGES}/logo.png" alt="">
				{/if}
			</div>

			{include file=$content}

		</div>
	</div>
{* 	<footer class="footer">
		<div class="container">
			<p class="text-muted">All content &copy; {$smarty.now|date_format:"%Y"} BuildCommand.</p>
		</div>
	</footer>
 *}

	<script src="{$JS}/jquery-3.1.1.min.js"></script>
	<script src="{$JS}/bootstrap.min.js"></script>
</body>
</html>
