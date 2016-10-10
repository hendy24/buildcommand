<h1>Manage Estimate Items</h1>

<form action="{$SITE_URL}" method="post">
  <input type="hidden" name="page" value="estimate_items">
  <input type="hidden" name="action" value="manage">

  <table id="estimate">
    <tr>
      <th>Estimate Item</th>
      <th>Estimate Category</th>
      <th>Project Class</th>
      <th>Project Type</th>
    </tr>
    {foreach from=$estimateItems item=item}
    <tr>
      <td class="estimate-item">{$item->name}</td>
      <td>
        <select name="estimate_category[{$item->id}]" id="estimate-category">
          <option value="">Select a category...</option>
          {foreach from=$estimateCategories item=category}
            <option value="{$category->id}" {if $item->estimate_category == $category->id} selected{/if}>{$category->name}</option>
          {/foreach}
        </select>
      </td>
      <td>
        <input type="checkbox" name="project_class[{$item->id}][]" value="1"> Residential<br />
        <input type="checkbox" name="project_class[{$item->id}][]" value="2"> Commercial
      </td>
      <td>
        <input type="checkbox" name="project_type[{$item->id}][]" value="1"> New Construction<br />
        <input type="checkbox" name="project_type[{$item->id}][]" value="2"> Remodel<br />
        <input type="checkbox" name="project_type[{$item->id}][]" value="3"> Addition<br />
      </td>
    </tr>
    {/foreach}
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" class="text-right"><input type="submit" value="Save"></td>
    </tr>
  </table>
</form>
<script>
  $(document).ready(function() {
    $(.estimate-item).hover(function(
      $(this).css('cursor', 'pointer');
    ));
    $(.estimate-item).click(function(
      $(this).append('<input type="text" value="">');
    ));
  });
</script>
