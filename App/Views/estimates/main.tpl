<h1>{$project->name} Estimate</h1>
<form action="{$SITE_URL}" method="post" name="project_estimate">
	<input type="hidden" name="page" value="estimates">
	<input type="hidden" name="action" value="main">
	<input type="hidden" name="path" value="{$currentUrl}">
	
	<table id="estimate">
	{foreach from=$estimateItems key=category item=item}
	  <tr>
	    <th colspan="4" class="category"><input type="text" value="{$category}"></th>
	  </tr>
	  {foreach from=$item item=i}
	  <tr>
	  	<td class="expand-item"><a href="" class="expand">+</a></td>
	  	<td class="estimate-item"><input class="ei" type="text" value="{$i->estimate_item}"></td>
	  	{if $i->bid_filename != ""}
	  	<td class="bid"><a href="{$SITE_URL}/{$project->public_id}/bids/{$i->bid_filename}" target="_blank"><img src="{$IMAGES}/file_pdf.png" alt=""></a></td>
	  	{else}
	  	<td class="bid">&nbsp;</td>
	  	{/if}
	  	<td class="estimate-amount">$<input type="text" value="{$i->amount}"></td>
	  </tr>
	  {/foreach}

	{/foreach}
	<tr>
	  <td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td><a href="" class="button">Cancel</a></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  	<td class="text-right"><input type="submit" value="Save"></td>
	</tr>
	</table>
</form>
<script>
	$(document).ready(function() {
		$(".expand").click(function(e) {
			e.preventDefault();
			// fetch the subcategories for this estimate item

		});
	});
</script>