<script>
  $(document).ready(function() {

    // fetch calendar events
    function fetchEvents() {
        $.get(SITE_URL, {
          page: "schedules",
          action: "findEvents",
          project_id: {$project->id}
        }, function(data) {
          events = data;
        }, "json"
      );

      return events;

    };
    

    $("#calendar").fullCalendar({
      dayClick: function() {

      },
      theme: true,
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listMonth'
      },
      navLinks: true,
      editable: true,
      eventLimit: true,
      displayEventTime: false,
      events: function() {
        console.log(fetchEvents());
      }
    });

    // $(".new-cal-event").hide();

    // $(document).click(function() {
    //   $(".new-cal-event").hide();
    // });

    var projectId = $("#project").val();
    var margin = {$project->margin};
    var contingency = {$project->contingency};
    var totalCost = null;
    var projectMargin = null;
    var projectContingency = null;

    var calculateCosts = function() {
      $(".estimate-item-amount").each(function() {
        totalCost += Number($(this).val());
      });

      $("#total").html(parseInt(totalCost, 10));
      $("#margin").html(parseInt(totalCost * margin, 10));
      $("#contingency").html(parseInt(totalCost * contingency, 10));
    };


    // calculate the contingency, profit margin, and total cost on page load
    calculateCosts();


    // hidden right click menu
    $(".row").contextmenu(function(e) {
      e.preventDefault();
      $(".context-menu", this).addClass("context-menu--active");
    });


    // $(".calendar-day").dblclick(function() {
    //   // use this to add new calendar events
    //   $(".new-cal-event").show();
    // });

    $(".clickable-row").click(function() {
      var publicId = $(this).find("input.public-id").val();
      window.location.href = SITE_URL + "/?page=notes&project=" + projectId + "&note=" + publicId;
    });

    // save the new action item
    $(".new-action").keypress(function(e) {
      var key = e.which;
      var project = $("#project").val();
      var input = $(this);
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
              row.append('<tr><td><input type="checkbox" name="" value="1"> ' + data.item + '</td><td>&nbsp;</td>');
              input.val('');
              $(':focus').blur();
            },
            "json"
        );
      }
    });

    // $(".new-action").blur(function() {
    //   $(this).val('');
    // });

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

    $(".estimate-item input").blur(function() {
      var estimateItemId = $(this).next('input[type="hidden"][name="estimate_item_id"]').val();
      $.post(SITE_URL, {
        page: "estimates",
        action: "saveEstimateItem",
        estimate_item_id: estimateItemId,
        name: $(this).val()
      });
    });


    $(".estimate-amount input").blur(function() {
      var amount = $(this).val();
      var estimateId = $(this).next('input[type="hidden"][name="estimate_id"]').val();
      var estimateItemId = $(this).parent().children().last().val();
      $.post(SITE_URL, {
        page: "estimates",
        action: "saveEstimateAmount",
        project_id: projectId,
        estimate_id: estimateId,
        estimate_item_id: estimateItemId,
        amount: amount
      }, function (data) {
        calculateCosts()
      });
    });

    $(".estimate-item-amount").autoNumeric('init');
    $(".project-calc").autoNumeric('init');

    $(".row").on("dragStart", function(e){
      e.originalEvent.dataTransfer.setData("Text", e.target.id);
    });



  // jquery close
  });
</script>

<h1 id="header-title">{$project->name}</h1>

<div id="sidebar">
  <div class="project-module">
    <a href="{$SITE_URL}/?page=actions&amp;project={$project->public_id}"><h3>Project Actions</h3></a>
    <input type="hidden" name="project" id="project" value="{$project->public_id}">
    <table>
      <tr>
        <td colspan="2"><input type="text" id="new-project-action" class="new-action" placeholder="Add a new action"></td>
      </tr>
      {foreach from=$actions item=action}
      <tr>
        <td width="80%"><input type="checkbox" class="action-checkbox" name="" value="{$action->public_id}"> {$action->item}</td>
        <td>{$action->date_due|date_format:"%m/%d/%y"}</td>
      </tr>
      {/foreach}
    </table>
  </div>
  <div class="project-module">
    <a href="{$SITE_URL}/?page=notes&amp;project={$project->public_id}"><h3>Project Notes</h3></a>
    <table class="project-module-table">
      {foreach from=$notes item=note}
      <tr class="clickable-row">
        <td>
            <input type="hidden" class="public-id" name="note_id" value="{$note->public_id}">
            {$note->datetime_modified|date_format:"%m/%d/%y"}
        </td>
        <td>{$note->content|truncate:32:"..."}</td>
      </tr>
      {/foreach}
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" class="text-right">
          <a href="{$SITE_URL}/?page=notes&amp;project={$project->public_id}" class="button">New Note</a>
        </td>
      </tr>
    </table>
  </div>
  <div class="project-module">
    <h3>Project Files</h3>

  </div>
</div>

<div id="main-page-right">

  <!--****** Calendar **********************************-->
  <div id="calendar"></div>

{*   <div id="project-calendar">
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
          <div class="day">
            <td class="calendar-day"><div class="day-number">{$day}</div></td>

            <!-- Add new event to the calendar -->
            <div class="new-cal-event">
              Name: <input type="text"> <br>
              Date Start: <br>
              Date End: <br>
            </div>

          </div>

        {/foreach}
      </tr>
      {/foreach}
    </table>
  </div>
 *}


  <!--****** Project Estimate *********************************-->
  <div id="project-estimate">
    <form action="{$SITE_URL}" method="post" name="project_estimate">
      <input type="hidden" name="page" value="estimates">
      <input type="hidden" name="action" value="main">
      <input type="hidden" name="path" value="{$currentUrl}">
      
      <table id="estimate" class="project-page">
      {foreach from=$estimateItems key=category item=item}
        <tr>
          <th colspan="4" class="category"><input type="text" value="{$category}"></th>
        </tr>


        {foreach from=$item item=i}
          <tr class="row" draggable="true">
            <td style="width:5px">&nbsp;</td>
            <td class="estimate-item">
              <input class="ei" type="text" value="{$i->estimate_item}">
              <input type="hidden" name="estimate_item_id" value="{$i->estimate_item_id}">
            </td>
            {if $i->bid_filename != ""}
            <td class="bid"><a href="{$SITE_URL}/{$project->public_id}/bids/{$i->bid_filename}" target="_blank"><img src="{$IMAGES}/file_pdf.png" alt=""></a></td>
            {else}
            <td class="bid">&nbsp;</td>
            {/if}
            <td class="estimate-amount">
              <input type="text" class="estimate-item-amount" value="{$i->amount|default:"0.00"}">
              <input type="hidden" name="estimate_id" value="{$i->estimate_id}">
              <input type="hidden" name="estimate_item_id" value="{$i->estimate_item_id}">
            </td>
          </tr>

          <!--** Hidden right click menu *************************************************************-->
          <nav class="context-menu">
            <ul class="context-menu_items">
              <li class="context-menu_item">
                <a href="#" class="context-menu_link">
                  <i class="fa fa-edit"></i> Edit Item Name
                </a>
              </li>
            </ul>
          </nav>

        {/foreach}

      {/foreach}
        <tr class="row">
          <td></td>
          <td>Contingency</td>
          <td></td>
          <td class="text-right"><div id="contingency" class="project-calc"></div></td>
        </tr>
        <tr class="row">
          <td></td>
          <td>Profit Margin</td>
          <td></td>
          <td class="text-right"><div id="margin" class="project-calc"></div></td>
        </tr>
        <tr class="project-total">
          <td colspan="3">Total</td>
          <td id="total-cost" class="text-right"><div id="total" class="project-calc"></div></td>
        </tr>
      </table>
    </form>

  </div>
</div>