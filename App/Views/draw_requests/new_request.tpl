<script type="text/javascript" src="{$JS}/drawRequest.js"></script>


<h1>{$project->name}</h1>
<form action="{$SITE_URL}" method="post" id="new-request">
	<input type="hidden" name="page" value="draw_requests">
	<input type="hidden" name="action" value="submit">
	<input type="hidden" name="id" value="{$project->public_id}">
	<input type="hidden" name="path" value="{$currentUrl}">

	<table class="form">
		<tr>
			<th colspan="4">Draw Request</th>
		</tr>
		<tr>
			<td><strong>Payee</strong></td>
			<td><strong>Estimate Item</strong></td>
			<td style="width: 200px"><strong>Amount</strong></td>
			<td>&nbsp;</td>
		</tr>
		<tr class="clone-row">
			<td>
				<input type="text" class="payee-search new-payee" name="new_payee[0]" style="width: 200px">
				<input type="hidden" name="payee[0]" class="payee" value="">
			</td>
			<td>
				<input type="text" class="section-item-search" style="width: 250px">
				<input type="hidden" name="section_item[0]" class="section-item" value="">
			</td>
			<td><input type="text" name="amount[0]" class="amount" style="width: 75px"></td>
			<td style="width: 20px">
				<input type="button" name="add_row" value="Add" class="add-row">
			</td>
		</tr>
		<tr>
			<td>Profit Margin</td>
			<td></td>
		</tr>
		<tr>
			<td colspan="4">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="4">&nbsp;</td>
		</tr>
		<tr>
			<td><input type="button" value="Cancel"></td>
			<td colspan="3" class="text-right">
				<input type="button" id="save" value="Save">
				<input type="submit" id="submit" value="Submit">
			</td>
		</tr>
	</table>

</form>