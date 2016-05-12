<?php
//
class Project extends AppModel {

	protected $table = "project";


	public function fetchProjects($filter = false) {
		$user_project = $this->loadTable('UserProject');
		$project_class_type = $this->loadTable('ProjectClassType');
		$project_class = $this->loadTable('ProjectClass');
		$project_type = $this->loadTable('ProjectType');

		$sql = "SELECT p.*, pc.name AS class, pt.name AS type FROM {$this->table} p
			INNER JOIN {$user_project->tableName()} up ON up.project_id = p.id
			INNER JOIN {$project_class_type->tableName()} pct ON pct.id = p.class_type_id
			INNER JOIN {$project_class->tableName()} pc ON pc.id = pct.project_class_id
			INNER JOIN {$project_type->tableName()} pt ON pt.id = pct.project_type_id
			WHERE p.status != 'Completed' AND p.status != 'Lost' AND up.user_id = :user_id";

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
