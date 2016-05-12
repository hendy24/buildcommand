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
    $this->title = "My Actions";
    $projects_list = $this->load('Project')->fetchAll();

    // get the notes
    $notes = $this->load('Note')->fetchNotes();

    smarty()->assign('projects_list', $projects_list);
    smarty()->assign('notes', $notes);
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

    if (input()->type == "title") {
      if (input()->data != "") {
        $note->title = input()->data;
      } else {
        $note->title = "Untitled";
      }
    } elseif (input()->type == "content") {
      if (input()->data != "") {
        $note->content = input()->data;
      }
    }

    if ($note->save()) {
      return true;
    }

    return false;
  }


}
