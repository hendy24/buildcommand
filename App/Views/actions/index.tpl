<script>
  $(document).ready(function() {

    $(".new-action").keypress(function(e) {
      var key = e.which;
      var project = $("#project").val();
      if (key == 13) {
        // save the new action to the inbox...
        var name = $(this).val();
        $.post(SITE_URL, {
              page: "actions",
              action: "addAction",
              project: project,
              item: name
            },
            function(data) {
              // clear the new action from the input and display it in the action list
              $(this).val('');

              console.log("success");
            }
        );
      }
    });

    // mark the action item complete
    $(".action-checkbox").click(function() {
      var row = $(this).parent().parent()
      $.post(SITE_URL, {
          page: "actions",
          action: "completeAction",
          item: $(this).val()
        }, function(data) {
          // make the row fade out here if success

          row.fadeOut(4000);
        }
      );
    });


    // display the completed actions

  });
</script>

<h1>Project Actions</h1>

{include file="elements/projects_nav.tpl"}

<div id="nav-sidebar-main-page-right">
  <input type="hidden" id="project" name="project" value="{$project->public_id}">
  <div id="new-action-div">
    <input type="text" id="new-inbox-action" class="new-action" placeholder='Add a new action to the "Inbox"'>
  </div>
  <div class="clear"></div>
  <div id="actions">

    <table id="actions-table">
      {foreach from=$actions item=action key=project_name}
      <tr>
        <th colspan="2">{$project_name}</th>
      </tr>
      {foreach from=$action item=a}
      <tr>
        <td><input type="checkbox" class="action-checkbox" name="" value="{$a->public_id}"> {$a->item}</td>
        <td>{$a->date_due|date_format}</td>
      </tr>
      {/foreach}
      {/foreach}
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table>
    <a href="" id="show-completed" class="button">Show Completed Actions</a>
  </div>
</div>
<div class="clear"></div>
