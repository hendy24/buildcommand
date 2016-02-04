<script>
	$(".delete").click(function(e) {
		alert("hello");
		e.preventDefault();
		var dataRow = $(this).parent().parent().parent();
		var item = $(this);
		$("#delete-dialog").dialog({
			buttons: {
				"Confirm": function() {
					var id = item.parent().attr('title');							
					$.ajax({
						type: 'post',
						url: SITE_URL,
						data: {
							page: "users",
							action: 'deleteId',
							id: id,
						},
						success: function() {
							dataRow.fadeOut("slow");
						}
					});
					$(this).dialog("close");

				},
				"Cancel": function() {
					$(this).dialog("close");
				}
			}
		});
	});
</script>

<h1>Manage Users</h1>
<div class="button-left">
	<a href="{$SITE_URL}/?page=users&amp;action=add" class="button">New User</a>
</div>
<table id="overview">
	<tr class="column-names">
		<th>Last Name</th>
		<th>First Name</th>
		<th>Username (Email)</th>
		<th>Group</th>
		<th style="width: 18px">&nbsp;</th>
		<th style="width: 18px">&nbsp;</th>
	</tr>
	{foreach $users as $user}
		<tr>
			<td>{$user->last_name}</td>
			<td>{$user->first_name}</td>
			<td><a href=""></a>{$user->email}</td>
			<td>{$user->group_name}</td>
			<td><a href="{$SITE_URL}/?page=users&amp;action=edit&amp;id={$user->public_id}"><img src="{$IMAGES}/pencil.png" alt=""></a></td>
			<td><span title="{$user->public_id}"><a href="#" class="delete"><img src="{$IMAGES}/cancel_16.png" alt=""></a></span></td>
		</tr>
	{/foreach}
</table>


<div id="delete-dialog" title="Confirmation Required">
	<p>Are you sure you want to delete this item? This cannot be undone.</p>
</div>