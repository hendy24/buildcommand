<?php

class NotesController extends AppController {


/*
 * -----------------------------------------------------------------------------
 * This is the main page for the notes
 * -----------------------------------------------------------------------------
 * Notes for all projects and unassigned notes can be seen and managed from this
 * page.
 *
 */
  public function index() {
    $this->title = "Project Notes";
    $projects_list = $this->load('Project')->fetchAll();

    if (isset (input()->project)) {
      if (input()->project == "all") {
        $project_id = "all";
      } else {
        $project = $this->load('Project', input()->project);
        $project_id = $project->id;
      }
    } else {
      $project_id = "all";
      $project = $this->load('Project');
    }

    if (isset (input()->note)) {
      $note = $this->load('Note', input()->note);
    } else {
      $note = $this->load('Note');
    }

    // get the notes
    $notes = $this->load('Note')->fetchNotes($project_id);

    smarty()->assign('projects_list', $projects_list);
    smarty()->assign('project', $project);
    smarty()->assign('projectId', $project_id);
    smarty()->assign('notes', $notes);
    smarty()->assign('selNote', $note);
  }


/*
 * -----------------------------------------------------------------------------
 * Create a new note
 * -----------------------------------------------------------------------------
 *
 *
 */
  public function new_note() {
    $this->template = "blank";
  }


/*
 * -----------------------------------------------------------------------------
 * AJAX request to get content for a specific note
 * -----------------------------------------------------------------------------
 *
 *
 */
 public function get_note() {
   if (input()->id != "") {
     $note = $this->load('Note', input()->id);
     json_return ($note);
   }
   return false;
 }


/*
 * -----------------------------------------------------------------------------
 * AJAX request to save the note content
 * -----------------------------------------------------------------------------
 *
 *
 */
  public function save_note() {
    // if an existing item fetch it with the id, otherwise create a new object
    $note = $this->load('Note', input()->id);

    if (input()->data != "") {
      $note->content = input()->data;
    } else {
      return false;
    }

    if (input()->project != "") {
      $project = $this->load('Project', input()->project);
      $note->project = $project->id;
    }

    if ($note->save()) {
      return true;
    }

    return false;
  }


}
