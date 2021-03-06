<script>
	$(document).ready(function(e) {
		$(".delete").click(function(e) {
			e.preventDefault();
			var dataRow = $(this).parent().parent().parent().parent().parent().parent().parent();
			var item = $(this);
			$("#delete-dialog").dialog({
				buttons: {
					"Confirm": function() {
						var id = item.parent().attr('title');
						$.ajax({
							type: 'post',
							url: SITE_URL,
							data: {
								page: "projects",
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


		$(".archive").click(function(e) {
			e.preventDefault();
			var dataRow = $(this).parent().parent().parent().parent().parent().parent().parent();
			var item = $(this);
			$("#archive-dialog").dialog({
				buttons: {
					"Completed": function() {
						var id = item.parent().attr('title');

						$.ajax({
							type: 'post',
							url: SITE_URL,
							data: {
								page: "projects",
								action: 'archive',
								id: id,
								status: "Completed"
							},
							success: function() {
								dataRow.fadeOut("slow");
							}
						});
						$(this).dialog("close");

					},
					"Lost": function() {
						var id = item.parent().attr('title');

						$.ajax({
							type: 'post',
							url: SITE_URL,
							data: {
								page: "projects",
								action: 'archive',
								id: id,
								status: "Lost"
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


		$("#project-status").selectmenu({ width: 120 });

	});
</script>
<div id="manage-projects">
	<div class="button-left">
		<a href="{$SITE_URL}/?page=projects&amp;action=add" class="btn btn-primary float-left">New Project</a>
	</div>

	<div class="clear"></div>
	<table id="overview">
		<tr class="column-names">
			<th style="width: 250px">Project Name</td>
			<th>Class</td>
			<th>Type</td>
			<th>Pipeline</td>
			<th style="width: 25px">&nbsp;</td>
		</tr>
		{foreach $projects as $p}
		<tr>
			<td><a href="/?page=projects&amp;action=manage&amp;id={$p->public_id}">{$p->name}</a></td>
			<td></td>
			<td></td>
			<td>&nbsp;</td>
			<td>{* {$toolMenu->options($p)} *}</td>
		</tr>
		{/foreach}
	</table>
</div>




<div id="delete-dialog" title="Confirmation Required">
	<p>Are you sure you want to delete this item? This cannot be undone.</p>
</div>
<div id="archive-dialog" title="Confirmation Required">
	<p>Are you sure you want to archive this project? This project will no longer be visible on the home page.</p>
</div>
