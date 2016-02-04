<?php

class Project extends AppModel {

	protected $table = "project";


	public function fetchProjects($filter = false) {
		$sql = "SELECT * FROM {$this->table} INNER JOIN site_user_project ON site_user_project.project_id = {$this->table}.id WHERE {$this->table}.status != 'Completed' AND {$this->table}.status != 'Lost' AND site_user_project.user_id = :user_id";

		if ($filter) {
			$sql .= " AND {$this->table}.status = :filter";
			$params[":filter"] = $filter;
		}
		$sql .= " ORDER BY {$this->table}.name ASC";

		$params[":user_id"] = auth()->getRecord()->id;

		return $this->fetchAll($sql, $params);
	}
}