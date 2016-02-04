<h1>{$company->name}: {$project->name}</h1>

	<table width="100%">
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
			<td colspan="2"><strong>{$sectionName}</strong></td>
			<td class="text-center"><strong>{if isset($data['cost'])  && $data['cost']->estimated_cost != ""}{currency_format($data['cost']->estimated_cost|default: "$0.00")}{else}$0.00{/if}</strong></td>
			<td class="text-center"><strong>{if isset($data['cost']) && $data['cost']->actual_cost != ""}{currency_format($data['cost']->actual_cost|default: "$0.00")}{else}$0.00{/if}</strong></td>
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
					{$item->estimated_cost|default: "0.00"}
				{/if}
			</td>

			{if isset ($item->estimated_cost) && $item->estimated_cost != "0.00"}
			<td>
				${$item->actual_cost|default: "0.00"}
			</td>
			{else}
			<td>&nbsp;</td>
			{/if}			


		</tr>
		{/if}
		{/foreach}
		{/foreach}
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr style="border-top:1px solid #000">
			<td colspan="2"><strong>Total Project Cost</strong></td>
			<td><strong>${$project->estimated_cost}</strong></td>
			<td><strong>${$project->actual_cost}</strong></td>
		</tr>
	</table>

<br />
<div style="float:right; font-size: 10px">
	All Content &copy; BuildCommand, LLC. All rights reserved.
</div>