<script>
  $(document).ready(function() {

    $("a.note-link").click(function(e) {
      e.preventDefault();
      var id = $(this).attr("id");
      var textbox = $("#content");

      // AJAX query to get the note content
      $.get(SITE_URL, {
          page: "notes",
          action: "getNote",
          id: id
        }, function(data) {
          // display the note content in the note divs
          $("#title").val(data.title);
          $("#public-id").val(data.public_id);
          $("textarea#content").val(data.content);
        },
        "json"
      );
    });

    $(".save-content").blur(function() {
      var publicId = $("#public-id").val();
      var item = $(this).attr("id");
      var data = $(this).val();
      console.log(item);
      $.post(SITE_URL, {
          page: "notes",
          action: "saveNote",
          type: item,
          id: publicId,
          data: data
        }, function(data) {

        },
        "json"
      );
    });



  });
</script>

<h1>My Notes</h1>
<div id="button-top-right">
  <a href="{$SITE_URL}/?page=notes&amp;action=new_note" rel="shadowbox;width:200px"
  id="new-note" class="button">New Note in Inbox</a>
</div>

<div id="sidebar">
  <div class="action-list"><a href="{$SITE_URL}/?page=notes&amp;project=inbox"
    id="inbox">Inbox</a></div>
  <div class="action-list"><a href="{$SITE_URL}/?page=notes&amp;project=all"
    id="all">All</a></div>
  {foreach from=$projects_list item=project_item}
  <div class="action-list">
    <a href="{$SITE_URL}/?page=notes&amp;project={$project_item->public_id}"
    id="{$project->public_id}">{$project_item->name}</a>
  </div>
  {/foreach}
</div>

<div id="main-page-right">
  <div id="note-container">
    <div id="notes-list">
      <table class="notes-table">
        <tr>
          <td class="bold">Date</td>
          <td class="bold">Title</td>
        </tr>
      {foreach from=$notes item=note}
        <tr>
          <td class="date"><a href="" id="{$note->public_id}" class="note-link">{$note->datetime_modified|date_format}</a></td>
          <td><a href="" id="{$note->public_id}" class="note-link">{$note->title}</a></td>
        </tr>
      {/foreach}
      </table>
    </div>
    <div id="note-content">
      <table class="notes-table">
        <tr>
          <td>
            <input type="text" name="title" id="title" class="save-content" placeholder="Untitled">
            <input type="hidden" id="public-id" value="">
          </td>
        </tr>
        <tr>
          <td></td>
        </tr>
        <tr>
          <td><textarea name="content" id="content" class="save-content" placeholder="Start typing here"></textarea></td>
        </tr>
        <tr>
          <td><a href="" class="button float-right">Save</a></td>
        </tr>
      </table>
    </div>

  </div>
</div>
