<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{$title}</title>
	<link rel="stylesheet" href="{$CSS}/blank.css" />
	
	<script src="{$FRAMEWORK_JS}/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="{$FRAMEWORK_JS}/jquery-validation-1.13.0/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="{$FRAMEWORK_JS}/jquery-ui-1.11.2.custom/jquery-ui.min.js"></script>
	<script type="text/javascript" src="{$JS}/general.js"></script>
	<script>
		var SITE_URL = '{$SITE_URL}';
	</script>
	
</head>
<body>
	<div id="wrapper">
		<div id="content">
			{include file=$content}
		</div>
		
	</div>
</body>
</html>