<script>
	$(document).ready(function () {
		$("#partner-type").selectmenu({
			change: function (e, u) {
				var typeSelected = $("option:selected", this);
				var typeValue = typeSelected.val();
				window.location.href = SITE_URL + "/?page=partners&type=" + typeValue;
			},
			width: 100
		});

	});
</script>

<h1>{$company->name}</h1>
<div class="button-left">
	<a href="{$SITE_URL}/?page=partners&amp;action=add" class="button">New Partner</a>
</div>
	<div id="type-div" class="button-right">
		<select name="partner_type" id="partner-type">
			<option value="all">All</option>
			{foreach $partnerTypes as $type}
			<option value="{$type->name}"{if $inputType == $type->name} selected{/if}>{$type->name}</option>
			{/foreach}
		</select>
	</div>

<table id="overview">
	<tr>
		<th colspan="6">Partners</th>
	</tr>

	{foreach $data as $k => $d}
		<tr class="title-row">
			<td colspan="6">{$k}</td>
		</tr>
		{foreach $d as $p}
		<tr>
			<td style="width: 20px">&nbsp;</td>
			<td>{$p->name}</td>
			<td>{$p->contact_name}</td>
			<td>{$p->phone}</td>
			<td><a href="mailto:{$p->email}">{$p->email}</a></td>
			<td class="text-right"><a href="{$SITE_URL}/?page=partners&amp;action=edit&amp;id={$p->public_id}" class="button">Edit</a></td>
		</tr>
		{/foreach}
	{/foreach}
</table>