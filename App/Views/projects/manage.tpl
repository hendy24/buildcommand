<h1>
	{$project->name} Dashboard
		<a href="{$SITE_URL}/files/plans/{$project->plan_filename}" target="_blank">
			<img class="plan-link" src="{$IMAGES}/house_building.png" alt="">
		</a>
</h1>


	


<table id="project-costs">
	<tr>
		<th colspan="3">Project Costs</th>
		<td id="wrench-menu">{$toolMenu->options($project)}</td>
	</tr>
	<tr>
		<td style="width: 175px">&nbsp;</td>
		<td><strong>Estimated</strong></td>
		<td><strong>Actual</strong></td>
	</tr>
	{foreach $itemGroups as $group}
	<tr>
		<td><a href="{$SITE_URL}/?page=estimates&amp;action={$group->name}&amp;id={$project->public_id}">{$group->description}</a></td>
		<td>{currency_format($group->estimated_cost)}</td>
		<td>{currency_format($group->actual_cost)}</td>
	</tr>
	{/foreach}

	<tr class="title-row">
		<td>Total Cost</td>
		<td>{$totalEstimatedCost}</td>
		<td>{$totalActualCost}</td>
	</tr>

</table>