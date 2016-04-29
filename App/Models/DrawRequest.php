<?php

class DrawRequest extends AppModel {
	protected $table = "draw_request";

	// public function fetchByProject($project_id, $status = false) {
	// 	$sql = "SELECT {$this->table}.* FROM {$this->table} WHERE {$this->table}.project_id = :project_id";
	//
	// 	if ($status) {
	// 		$sql .= " AND {$this->table}.status = :status";
	// 		$params[":status"] = $status;
	// 	}
	// 	$sql .= " ORDER BY {$this->table}.datetime_created ASC";
	// 	$params[":project_id"] = $project_id;
	// 	$data = $this->fetchAll($sql, $params);
	// 	if (!empty ($data)) {
	// 		return $data;
	// 	}
	//
	// 	return false;
	// }
	//
	// public function fetchPending($project_id) {
	// 	$sql = "SELECT {$this->table}.* FROM {$this->table} WHERE {$this->table}.project_id = :project_id AND {$this->table}.status = 'Pending'";
	// 	$params[":project_id"] = $project_id;
	// 	$data = $this->fetchOne($sql, $params);
	// 	if (!empty ($data)) {
	// 		return $data;
	// 	}
	//
	// 	return false;
	// }
}
