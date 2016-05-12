<?php

class Note extends AppModel {

  protected $table = "note";


  public function fetchNotes() {
    $sql = "SELECT * FROM {$this->tableName()} note ORDER BY note.datetime_modified DESC";

    return $this->fetchAll($sql);
  }

}
