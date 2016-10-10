<?php

class Note extends AppModel {

  protected $table = "note";


  public function fetchNotes($project, $num_results = false) {
    $params = array();
    $sql = "SELECT * FROM {$this->tableName()} note ";

    if ($project != "all") {
      $sql .= " WHERE note.project = :project_id";
      $params[":project_id"] = $project;
    }
    $sql .= " ORDER BY note.datetime_created DESC";

    if ($num_results) {
      $sql .= " LIMIT {$num_results}";
    }

    return $this->fetchAll($sql, $params);
  }

}
