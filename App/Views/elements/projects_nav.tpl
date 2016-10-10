<div id="nav-sidebar">
  <div class="action-list">
    <a href="{$SITE_URL}/?page={$this->pageName()}&amp;project=all" id="all" class="{if $projectId == "all"} selected-project{/if}">All</a>
  </div>
  {foreach from=$projects_list item=project_item}
  <div class="action-list">
    <a href="{$SITE_URL}/?page={$this->pageName()}&amp;project={$project_item->public_id}"
    id="{$project_item->public_id}" class="{if $project_item->public_id == $project->public_id} selected-project{/if}">{$project_item->name}</a>
  </div>
  {/foreach}
</div>
