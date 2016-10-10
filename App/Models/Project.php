<?php
//
class Project extends AppModel {

	protected $table = "project";


	public function fetchProjects($filter = false) {
		$user_project = $this->loadTable('UserProject');

		$sql = "SELECT p.* FROM {$this->table} p
			INNER JOIN {$user_project->tableName()} up ON up.project = p.id
			WHERE p.status != 'Completed' AND p.status != 'Lost' AND up.user = :user_id";

		if ($filter) {
			$sql .= " AND p.status = :filter";
			$params[":filter"] = $filter;
		}
		$sql .= " ORDER BY p.name ASC";
		$params[":user_id"] = auth()->getRecord()->id;

		return $this->fetchAll($sql, $params);
	}


/*
 * -----------------------------------------------------------------------------
 * Fetch project names for the actions page
 * -----------------------------------------------------------------------------
 * If the project is found, then return the project.
 *
 */
	public function fetchProjectForActions($proj_pub_id) {
		$sql = "SELECT p.id, p.public_id, p.name FROM {$this->tableName()} p WHERE
			p.public_id = :public_id";
		$params[":public_id"] = $proj_pub_id;
		return $this->fetchOne($sql, $params);
	}

}
