<?php


class Action extends AppModel {

  protected $table = "action";

  public function fetchProjectActions($project_id) {
    $sql = "SELECT * FROM {$this->tableName()} a WHERE a.project = :project_id AND a.complete = 0 ORDER BY a.date_due ASC";
    $params[":project_id"] = $project_id;
    $actions = $this->fetchAll($sql, $params);

    if (empty ($actions)) {
      return $this->fetchColumnNames();
    } else {
      return $actions;
    }
  }

  public function fetchActions($type = "all") {
    $project = $this->loadTable('Project');
    $params[":user"] = auth()->getRecord()->id;

    $sql = "SELECT a.*";
    if (is_numeric($type)) {
      $sql .= ", p.name AS project_name FROM {$this->tableName()} a
        INNER JOIN {$project->tableName()} p ON p.id = a.project WHERE
        p.id = :project AND a.user_created = :user";
      $params[":project"] = $type;
    } elseif ($type == "inbox") {
      $sql .= " FROM {$this->tableName()} a WHERE a.project IS NULL AND
        a.user_created = :user";

    } elseif ($type == "all") {
      $sql .= " , p.name AS project_name FROM {$this->tableName()} a LEFT JOIN
        {$project->tableName()} p ON p.id = a.project WHERE a.user_created = :user";
    }
    $sql .= " AND (a.complete = 0 OR a.complete IS NULL) ORDER BY a.project, a.date_due ASC";
    return $this->fetchAll($sql, $params);
  }



}
