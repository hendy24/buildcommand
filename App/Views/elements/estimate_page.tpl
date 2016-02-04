<script>
	$(document).ready(function() {
		$("#estimateForm").validate();

		$("#cancel").click(function (e) {
			e.preventDefault();
			window.location = SITE_URL + "/?page=projects&action=manage&id=" + $("#project-id").val();
		});
	});
</script>

<div id="icons">
	<a href="{$SITE_URL}/files/plans/{$project->plan_filename}" target="_blank">
		<img src="{$IMAGES}/house_building.png" alt="">
	</a>
	<a href="{$SITE_URL}/?page=estimates&amp;action=printView&amp;id={$project->public_id}"><img src="{$SITE_URL}/images/printer.png" alt=""></a>
</div>

<div id="cost-totals">
	<div id="cost-left"><span class=" text-grey">Estimated Cost:</span> &nbsp;<strong>{currency_format($project->estimated_cost)}</strong></div>
	<div id="cost-right"><span class=" text-grey">Actual Cost:</span> &nbsp;<strong>{currency_format($project->actual_cost)}</strong></div>
</div>

<form id="estimateForm" action="{$SITE_URL}" method="post">
	<input type="hidden" name="page" value="estimates">
	<input type="hidden" name="action" value="{$action}">
	<input type="hidden" id="project-id" name="id" value="{$project->id}">
	<input type="hidden" name="path" value="{$currentUrl}">

	<table id="estimate-table">
		<tr>
			<th colspan="6">{$pageTitle}</th>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td style="width:85px"><span class="text-12 text-grey">Estimated Cost</span></td>
			<td style="width:85px"><span class="text-12 text-grey">Actual Cost</span></td>
		</tr>
		{foreach $pageData as $sectionName => $data name=count}
		{if $smarty.foreach.count.iteration != 1}
		<tr>
			<td>&nbsp;</td>
		</tr>
		{/if}
		<tr class="title-row">
			<td colspan="2">{$sectionName}</td>
			<td class="text-center">{if isset($data['cost'])  && $data['cost']->estimated_cost != ""}{currency_format($data['cost']->estimated_cost|default: "$0.00")}{else}$0.00{/if}</td>
			<td class="text-center">{if isset($data['cost']) && $data['cost']->actual_cost != ""}{currency_format($data['cost']->actual_cost|default: "$0.00")}{else}$0.00{/if}</td>
			<td></td>
			<td></td>
		</tr>
		{foreach $data as $sectionItemName => $item}
		{if $sectionItemName != "cost"}
		<tr>
			<td style="width:5px">&nbsp;</td>
			<td>{$sectionItemName}</td>
			
			<td>$
				{if $sectionItemName == "Margin" && $project->margin != "" && isset ($margin->estimated_cost)}
					{$margin->estimated_cost}
				{elseif $sectionItemName == "Contingency" && $project->contingency != "" && isset ($contingency->estimated_cost)}
					{$contingency->estimated_cost}
				{else}

				<input class="estimate-number {if $item->estimated_cost == '0.00'}text-grey{/if}" type="text" name="estimated_cost[{$item->section_item_id}]" value="{$item->estimated_cost|default: "0.00"}" pattern="[0-9]*" {if $auth->read_only()}readonly{/if}>
				{/if}
			</td>

			{if isset ($item->estimated_cost) && $item->estimated_cost != "0.00"}
			<td>
				${$item->actual_cost|default: "0.00"}
			</td>
			{else}
			<td>&nbsp;</td>
			{/if}
			{if $item->hasSectionDetail($sectionItemName)}
			<td class="icon-link"><a href="{$SITE_URL}/?page=estimate_details&amp;action={underscore_string($sectionItemName)}&amp;id={$projectId}" rel="shadowbox;width=800"><img src="{$IMAGES}/details-icon.png" alt="Show section details"></a></td>
			{else}
			<td>&nbsp;</td>
			{/if}
			<td class="icon-link"><img src="{$IMAGES}/file_pdf.png" alt="Upload a contractor estimate"></td>
			

			
			<tr class="details-table">
				<td>
					<table class="detail">
						<tr>
							<td>Test</td>
						</tr>
					</table>
				</td>
			</tr>


		</tr>
		{/if}
		{/foreach}
		{/foreach}
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2"><input type="button" value="Cancel" id="cancel"></td>
			<td colspan="5" class="text-right">
				<input type="button" value="Back" onclick="history.go(-1)">
				{if $pageTitle == "Closing"}
				<input type="submit" value="Done">
				{else}
				<input type="submit" value="Next">
				{/if}
			</td>
		</tr>
	</table>
</form>
