<script>
  $(document).ready(function() {
    var textbox = $("textarea#note-content");
    var noteDate = $("#note-date");

    $("a#new-note").click(function(e) {
      e.preventDefault();
      textbox.val('');
      noteDate.val('');
    });

    $(".clickable-row").click(function(e) {
      e.preventDefault();
      $(this).removeClass("row-alt");
      $(this).addClass("selected-row").siblings().removeClass("selected-row");
      var id = $(this).attr("id");

      // AJAX query to get the note content
      $.get(SITE_URL, {
          page: "notes",
          action: "getNote",
          id: id
        }, function(data) {
          // display the note content in the note divs
          $("#public-id").val(data.public_id);
          textbox.val(data.content);
          noteDate.val(data.datetime_modified);
        },
        "json"
      );
    });

    $(".save-content").blur(function() {
      var publicId = $("#public-id").val();
      var item = $(this).attr("id");
      var data = $(this).val();
      var project = $("#note-project").val();
      $.post(SITE_URL, {
          page: "notes",
          action: "saveNote",
          id: publicId,
          project: project,
          data: data
        }, function(data) {
          $('<td class="date">' +
            data.datetime_modified + '</td><td>' + data.project_name +
            '</td><td>' + data.content + '</td>').prependTo(".project-notes-list");
        },
        "json"
      );
    });



  });
</script>

<h1>Project Notes</h1>
<div class="title-action-item title-action-item-left">
  <a href="" id="new-note" class="button">New Note</a>
</div>

<div class="title-action-item title-action-item-right">
  <input type="text" name="search_notes" id="search-notes" style="width:300px" placeholder="Search notes">
</div>

{include file="elements/projects_nav.tpl"}

<div id="nav-sidebar-main-page-right">
  <div id="note-container">
      <table id="notes-header-table">
        <tr>
          <th>Date</th>
          <th>Project</th>
          <th>Note</th>
          <th>&nbsp;</th>
        </tr>
      </table>

    <div id="notes-list">
      <table class="notes-table">
      {foreach from=$notes item=note}
        <tr class="{cycle values="row,row-alt"} clickable-row project-notes-list" id="{$note->public_id}">
          <td class="date">{$note->datetime_modified|date_format}</td>
          <td>{$this->projectName($note->project)}</td>
          <td>{$note->content|truncate:60:"..."}</td>
          <td><img src="{$IMAGES}/cancel_16.png" alt=""></td>
        </tr>
      {/foreach}
      </table>
    </div>
    <div id="note-content">
      <table class="notes-table">
        <tr>
          <td>Project:
            <select name="note-project" id="note-project">
              {foreach from=$projects_list item=p}
              <option value="{$p->public_id}" {if $p->public_id == $project->public_id} selected{/if}>{$p->name}</option>
              {/foreach}
            </select>
          </td>
          <td class="text-right"><input type="text" id="note-date" class="text-right" value=""></td>
        </tr>
        <tr>
          <td colspan="2"></td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="hidden" id="public-id" value="">
            <textarea name="content" id="note-content" class="save-content"
              draggable="true" placeholder="Start typing here">{$selNote->content}
            </textarea>
          </td>
        </tr>
      </table>
    </div>
  </div>
</div>
<div class="clear"></div>
