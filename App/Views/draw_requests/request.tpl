<script type="text/javascript" src="{$JS}/drawRequest.js"></script>

<h1>{$project->name}</h1>

<form action="{$SITE_URL}" method="post" id="submit-request">
	<input type="hidden" name="page" value="draw_requests">
	<input type="hidden" name="action" value="submit">
	<input type="hidden" name="id" value="{$project->public_id}">
	<input type="hidden" name="path" value="{$currentUrl}">
	<input type="hidden" name="profit_margin" id="profit-margin" value="{$project->margin}">

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
		{foreach $drawRequestItems as $k => $item name=requests}
		<tr>
			<td>
				<input type="text" class="payee-search new-payee" name="new_payee[{$k}]" value="{$item->name}" style="width: 200px">
				<input type="hidden" name="payee[{$k}]" class="payee" value="{$item->company_id}">
			</td>
			<td>
				<input type="text" class="section-item-search" value="{$item->section_item_name}" style="width: 250px">
				<input type="hidden" name="section_item[{$k}]" class="section-item" value="{$item->section_item_id}">
			</td>
			<td><input type="text" name="amount[{$k}]" class="amount" value="{$item->amount}" style="width: 75px"></td>
			<td><a href="" class="delete" id="{$item->id}"><img src="{$IMAGES}/trash.png" alt=""></a></td>
		</tr>
		{/foreach}
		<tr class="clone-row">
			<td>
				<input type="text" class="payee-search new-payee" name="new_payee[{$totalItems}]" style="width: 200px">
				<input type="hidden" name="payee[{$totalItems}]" class="payee" value="">
			</td>
			<td>
				<input type="text" class="section-item-search" style="width: 250px">
				<input type="hidden" name="section_item[{$totalItems}]" class="section-item" value="">
			</td>
			<td><input type="text" name="amount[{$totalItems}]" class="amount" value="" style="width: 75px"></td>
			<td><a href="" class="delete"><img src="{$IMAGES}/trash.png" alt=""></a></td>
		</tr>
		<tr>
			<td>{$company->name}</td>
			<td>Profit Margin</td>
			<td><input type="text" id="margin" name="margin_amount" value="{$companyMargin->amount}" style="width:75px"></td>
		</tr>
		<tr>
			<td colspan="4">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="4">&nbsp;</td>
		</tr>
		<tr>
			<td><input type="button" value="Cancel" onclick="history.go(-1)"> </td>
			<td colspan="3" class="text-right">
				<input type="submit" value="Submit">
				<input type="button" id="save" value="Save">
			</td>
		</tr>

	</table>



<div id="dialog" title="Submit the Draw Request">
	<p>Submitting this draw request will send an automated email to the homeowner and/or bank.  Are you ready to proceed?</p>
</div>
<div id="delete-dialog" title="Remove Draw Request Item">
	<p>Are you sure? This draw request item will be permanately removed.</p>
</div>
</form>