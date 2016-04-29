<?php

class Project extends AppModel {

	protected $table = "project";


	public function fetchProjects($filter = false) {
		$user_project = $this->loadTable('UserProject');
		$sql = "SELECT * FROM {$this->table} p INNER JOIN {$user_project->tableName()}
			up ON up.project_id = p.id WHERE p.status != 'Completed' AND p.status !=
			'Lost' AND up.user_id = :user_id";

		if ($filter) {
			$sql .= " AND p.status = :filter";
			$params[":filter"] = $filter;
		}
		$sql .= " ORDER BY p.name ASC";

		$params[":user_id"] = auth()->getRecord()->id;

		return $this->fetchAll($sql, $params);
	}
}
