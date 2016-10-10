<?php

class ActionsController extends AppController {



/*
 * -----------------------------------------------------------------------------
 * Main page for all the actions
 * -----------------------------------------------------------------------------
 * This page and functionality should be similar to Wunderlist
 *
 */
  public function index() {
    $this->title = "My Actions";
    $projects_list = $this->load('Project')->fetchAll();

    if (isset (input()->project)) {
      $project = $this->load('Project', input()->project);
      smarty()->assign('project_name', $project->name);
    } else {
      input()->project = "all";
      $project_id = "all";
    }

    if (!empty ($project)) {
      $actions = $this->load('Action')->fetchActions($project->id);
    } else {
      if (input()->project == "inbox") {
        smarty()->assign('project_name', "Inbox");
      } else {
        smarty()->assign('project_name', "");
      }
      $actions = $this->load('Action')->fetchActions(input()->project);
    }

    $action_array = array();
    foreach ($actions as $a) {
      if ($a->project_name == "") {
        $action_array["Inbox"][] = $a;
      } else {
        $action_array[$a->project_name][] = $a;
      }
    }

    smarty()->assign('actions', $action_array);
    smarty()->assign('projects_list', $projects_list);
    smarty()->assign('project', $project);
    smarty()->assign('projectId', $project_id);
  }




/*
 * -----------------------------------------------------------------------------
 * AJAX request to add a new action
 * -----------------------------------------------------------------------------
 *
 *
 */
  public function addAction() {
    $action = $this->load('Action');

    if (input()->project != "") {
      $project = $this->load('Project', input()->project);
      $action->project = $project->id;
    }

    if (input()->item != "") {
      $action->item = input()->item;
    }

    if ($action->save()) {
      json_return($action);
    }

    return false;

  }



/*
 * -----------------------------------------------------------------------------
 * AJAX call to save action
 * -----------------------------------------------------------------------------
 *
 *
 */
    public function saveAction() {
      if (input()->action_id != "") {
        $action = $this->load('Action', input()->action_id);
      }

      if (input()->date != "") {
        $action->date_due = mysql_date(input()->date);
      }

      if ($action->save()) {
        return true;
      }
      return false;

    }






/*
 * -----------------------------------------------------------------------------
 * AJAX request to mark the action as complete
 * -----------------------------------------------------------------------------
 *
 *
 */
  public function completeAction() {
    if (input()->item != "") {
      $action = $this->load('Action', input()->item);
    }

    $action->complete = 1;

    if ($action->save()) {
      return true;
    }

    return false;

  }


/*
 * -----------------------------------------------------------------------------
 * AJAX request to get all completed actions for a project
 * -----------------------------------------------------------------------------
 *
 *
 */
    public function getCompletedActions() {
      if (input()->project != "") {
        $project = $this->load('Project', input()->project);
        $actions = $this->load('Action')->fetchProjectActions($project->id, "completed");
        json_return ($actions);
      }

      return false;
    }

}
