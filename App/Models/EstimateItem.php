<?php

class EstimateItem extends AppModel {
	protected $table = 'estimate_item';
	protected $belongsTo = array(
		'table' => 'project',
		'foreign_key' => 'id',
		'inner_key' => 'project_id',
		'join_type' => 'INNER'
	);
	protected $hasOne = array(
		'table' => 'section_item',
		'foreign_key' => 'id',
		'inner_key' => 'project_id',
		'join_type' => 'LEFT'
	);


	public function hasSectionDetail($name) {
		$method = underscore_string($name);
		if (method_exists('EstimateDetailsController', $method)) {
			return true;
		}

		return false;
	}



	public function fetchBySectionItem($project_id, $section_item_id) {
		$sql = "SELECT * FROM {$this->table} WHERE {$this->table}.section_item_id = :section_item_id AND project_id = :project_id";
		$params[":section_item_id"] = $section_item_id;
		$params[":project_id"] = $project_id;

		$data = $this->fetchOne($sql, $params);

		if (!empty ($data)) {
			return $data;
		} else {
			return $this;
		}
	}


	public function fetchItemBySectionItemId($project_id, $id) {
		$sql = "SELECT * FROM {$this->table} WHERE project_id = :project_id AND section_item_id = :id";
		$params[":project_id"] = $project_id;
		$params[":id"] = $id;
		return $this->fetchOne($sql, $params);
	}


}