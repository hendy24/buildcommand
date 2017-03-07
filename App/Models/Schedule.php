<?php

class Schedule extends AppModel {
	protected $table = 'schedule';

	public function fetchEvents($project_id) {
		$sql = "SELECT * FROM {$this->tableName()} WHERE project = :project_id";
		$params[":project_id"] = $project_id;
		return $this->fetchAll($sql, $params);
	}

}