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

	<h1>{$company->name}</h1>

	<div class="button-left">
		<a href="{$SITE_URL}/?page=projects&amp;action=add" class="button">New Project</a>
	</div>
	<div class="button-right">
		<select name="project_status" id="project-status">
			<option value="all">All</option>
			<option value="pending">Pending</option>
			<option value="active">Active</option>
		</select>
	</div>

	<table id="overview">
		<tr>
			<th colspan="7">Projects</th>
		</tr>
		<tr class="column-names">
			<td style="width: 250px">Project Name</td>
			<td>Sq Ft</td>
			<td>Start</td>
			<td>Completion</td>
			<td>Estimate</td>
			<td>Actual</td>
			<td style="width: 25px">&nbsp;</td>
		</tr>
		{foreach $projects as $p}
		<tr>
			<td><a href="/?page=projects&amp;action=manage&amp;id={$p->public_id}">{$p->name}</a></td>
			<td>{$p->basement_sq_ft + $p->main_floor_sq_ft + $p->upper_floor_sq_ft}</td>
			<td>{$p->start_date|date_format: "%m/%d/%y"}</td>
			<td></td>
			<td>{currency_format($p->estimated_cost)}</td>
			<td>{currency_format($p->actual_cost)}</td>
			<td>{$toolMenu->options($p)}</td>
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
