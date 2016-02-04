<h1>Foundation Labor Detail</h1>

<form action="{$SITE_URL}">
	<input type="hidden" name="page" action="estimate_details">
	<input type="hidden" name="action" value="foundation_labor">
	<input type="hidden" name="path" value="{$currentUrl}">

	<table>
		<tr>
			<th>Type</th>
			<th>Linear Feet</th>
			<th>Price / Ft</th>
			<th>Cost</th>
		</tr>
		<tr>
			<td style="width: 300px">Footing Labor</td>
			<td><input type="text" name="length"></td>
			<td><input type="text" name="cost_per_item"></td>
			<td><input type="text" name="estimated_cost"></td>
		</tr>
		<tr>
			<td>Foundation Material</td>
			<td><input type="text" name="length"></td>
			<td><input type="text" name="cost_per_item"></td>
			<td><input type="text" name="estimated_cost"></td>
		</tr>
		<tr>
			<td>Rebar</td>
			<td><input type="text" name="length"></td>
			<td><input type="text" name="cost_per_item"></td>
			<td><input type="text" name="estimated_cost"></td>
		</tr>
		<tr>
			<td>Foundation Vents</td>
			<td><input type="text" name="length"></td>
			<td><input type="text" name="cost_per_item"></td>
			<td><input type="text" name="estimated_cost"></td>
		</tr>
		<tr>
			<td colspan="4" class="text-right"><input type="submit" value="Save"></td>
		</tr>
	</table>
</form>