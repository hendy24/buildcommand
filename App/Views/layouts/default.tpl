
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
	<link rel="stylesheet" href="{$CSS}/styles.css">

{* 	<link rel="stylesheet" href="{$JS}/jquery-ui-1.11.2.custom/jquery-ui.min.css">
	<script type="text/javascript" src="{$JS}/moment.js"></script>
	<link rel="stylesheet" href="{$JS}/jQuery-Autocomplete-master/content/styles.css" />
	<link rel="stylesheet" href="{$CSS}/styles.css">
	<script src="{$JS}/jquery-2.2.3.min.js"></script>
	<!-- <script type="text/javascript" src="{$JS}/colorbox-master/jquery.colorbox.js"></script> -->
	<script type="text/javascript" src="{$JS}/jquery-validation-1.13.0/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="{$JS}/jquery-ui-1.11.2.custom/jquery-ui.min.js"></script>
	<script type="text/javascript" src="{$JS}/jQuery-Autocomplete-master/dist/jquery.autocomplete.min.js"></script>
	<script type="text/javascript" src="{$JS}/jquery-dateFormat.min.js"></script>
	<script type="text/javascript" src="{$JS}/autoNumeric.js"></script>
	<script type="text/javascript" src="{$JS}/fullcalendar-3.0.1/fullcalendar.min.js"></script>
	<script type="text/javascript" src="{$JS}/shadowbox-3.0.3/shadowbox.js"></script>
	<link rel="stylesheet" href="{$JS}/fullcalendar-3.0.1/fullcalendar.min.css">
	<link rel="stylesheet" href="{$JS}/shadowbox-3.0.3/shadowbox.css">
	<script type="text/javascript" src="{$JS}/general.js"></script>
	<script>
		var SITE_URL = '{$SITE_URL}';
		Shadowbox.init();
	</script>
 *}</head>
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
			<nav id="navbar" class="navbar-collapse collapse float-right">
				<ul class="nav navbar-nav">
					<li><a href="#">Home</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Projects</a>
						<ul class="dropdown-menu">
							<li>Hansen Residence</li>
						</ul>
					</li>
				</ul>
			</nav>

			{include file=$content}

		</div>
	</div>


	<script src="{$JS}/jquery-3.1.1.min.js"></script>
	<script src="{$JS}/bootstrap.min.js"></script>
</body>
</html>
