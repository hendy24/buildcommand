<?php

class Estimate extends AppModel {
	protected $table = 'estimate';

	public function fetchByProjectAndSection($project_id, $section_id) {
		$sql = "select * from {$this->table} where project_id = :project_id and section_id = :section_id";
		$params[":project_id"] = $project_id;
		$params[":section_id"] = $section_id;
		$data = $this->fetchOne($sql, $params);

		if (!empty ($data)) {
			return $data;
		} else {
			return $this;
		}
	}


	public function fetchTotalProjectCost($project_id, $filter = array()) {
		$sql = "select SUM({$this->table}.estimated_cost) AS estimated_cost, SUM({$this->table}.actual_cost) AS actual_cost from {$this->table} WHERE project_id = :project_id";
		$params[":project_id"] = $project_id;
		return $this->fetchOne($sql, $params);
	}


	public function fetchEstimate($project_id, $estimate_item_id) {
		$sql = "SELECT * FROM {$this->tableName()} WHERE project = :project_id AND estimate_item = :estimate_item_id LIMIT 1";
		$params[":project_id"] = $project_id;
		$params[":estimate_item_id"] = $estimate_item_id;

		$result = $this->fetchOne($sql, $params);

		if (!empty ($result)) {
			return $result;
		} else {
			return $this;
		}
	}
}