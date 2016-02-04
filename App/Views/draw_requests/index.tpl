	
	<h1>{$project->name}</h1>

	<div class="button-left">
		<a href="{$SITE_URL}/?page=draw_requests&amp;action=request&amp;id={$project->public_id}" class="button">New Draw Request</a>
	</div>
	{if $drawRequests}
		<table id="overview">
			<tr>
				<th colspan="6">Project Draws</th>
			</tr>
			<tr class="column-names">
				<td>Draw Created</td>
				<td>Draw Submitted</td>
				<td>Draw Amount</td>
				<td>Status</td>
				<td style="width: 110px"></td>
			</tr>
			
		
			{foreach $drawRequests as $request}
			<tr>
				<td>{$request->datetime_created|date_format}</td>
				<td>{$request->datetime_submitted|date_format}</td>
				<td>{currency_format($request->draw_amount)}</td>
				<td>{$request->status}</td>
				<td class="text-right">
					{if $request->status == "Pending"}
					<a href="{$SITE_URL}/?page=draw_requests&amp;action=submit&amp;id={$project->public_id}&amp;type=submit" class="button">Submit</a>
					{/if}
					<a href="{$SITE_URL}/?page=draw_requests&amp;action=request&amp;id={$request->public_id}" class="button">Edit</a>
				</td>
			</tr>
			{/foreach}
		</table>
	{else}
		<p class="text-center">No draw requests have been created. You can <a href="{$SITE_URL}/?page=draw_requests&amp;action=request&amp;id={$project->public_id}">create a new one</a> now.</p>
	{/if}


