<script>
  $(document).ready(function() {
    $(".calendar-day").dblclick(function() {
      // use this to add new calendar events

    });

    // save the new action item
    $(".new-action").keypress(function(e) {
      var key = e.which;
      var project = $("#project").val();
      if (key == 13) {
        // save the new action to the inbox...
        var name = $(this).val();
        var row = $(this).parent().parent().parent();
        $.post(SITE_URL, {
              page: "actions",
              action: "addAction",
              project: project,
              item: name
            },
            function(data) {
              // clear the new action from the input and display it in the action list
              $(this).val('');
              console.log(data);
              row.append('<tr><td><input type="checkbox" name="" value="1"> ' + data.item + '</td><td>&nbsp;</td>');

            },
            "json"
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
  });
</script>

<h1 id="header-title">{$project->name}</h1>

<div id="sidebar">
  <div class="project-module">
    <h3><a href="{$SITE_URL}/?page=actions&amp;project={$project->public_id}">Project Actions</a></h3>
    <input type="hidden" name="project" id="project" value="{$project->public_id}">
    <table>
      <tr>
        <td colspan="2"><input type="text" id="new-project-action" class="new-action" placeholder="Add a new action"></td>
      </tr>
      {foreach from=$actions item=action}
      <tr>
        <td width="80%"><input type="checkbox" class="action-checkbox" name="" value="{$action->public_id}"> {$action->item}</td>
        <td>{$action->date_due|date_format:"%m.%d"}</td>
      </tr>
      {/foreach}
    </table>
  </div>
  <div class="project-module">
    <h3>Project Notes</h3>
    <table>
      <tr>
        <td>5.2.2016</td>
        <td>This is a note snippet...</td>
      </tr>
      <tr>
        <td>4.28.2016</td>
        <td>This is another note snippet...</td>
      </tr>
      <tr>
        <td colspan="2" class="submit-button">
          <input type="submit" value="New">
        </td>
      </tr>
    </table>
  </div>
  <div class="project-module">
    <h3>Project Files</h3>

  </div>
</div>

<div id="main-page-right">
  <div id="project-calendar">
    <h2 class="text-center"><a href="{$SITE_URL}/?page=projects&amp;action=manage&amp;id={$project->public_id}&amp;month={$smarty.now|date_format:'%B'}">{$calendar->month} {$calendar->year}</a></h2>
    <div class="clear"></div>
    <div class="float-left"><a href="{$SITE_URL}/?page=projects&amp;action=manage&amp;id={$project->public_id}&amp;month={$calendar->last_month}">&laquo;Last Month</a></div>
    <div class="float-right"><a href="{$SITE_URL}/?page=projects&amp;action=manage&amp;id={$project->public_id}&amp;month={$calendar->next_month}">Next Month&raquo;</a></div>
    <table class="calendar">
      <tr>
        <th>Sun</th>
        <th>Mon</th>
        <th>Tue</th>
        <th>Wed</th>
        <th>Thu</th>
        <th>Fri</th>
        <th>Sat</th>
      </tr>
      {foreach from=$calendar->dates item=week}
      <tr class="calendar-row">
        {foreach from=$week item=day}
          <td class="calendar-day"><div class="day-number">{$day}</div></td>
        {/foreach}
      </tr>
      {/foreach}
    </table>
  </div>
  <div id="project-estimate">
    <h2 class="title">Project Estimate</h2>
  </div>
</div>
