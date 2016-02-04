<?php

class Section extends AppModel {

	protected $table = 'section';

	public function fetchByItemGroupName($name) {
		$params = array();
		$sql = "select {$this->table}.* from {$this->table} INNER JOIN item_group ON item_group.id = {$this->table}.item_group_id ";

		if ($name != "all") {
			$sql .= " WHERE item_group.name = :name";
			$params[":name"] = $name;
		}	

		$sql .= " ORDER BY item_group_id ASC, section_order ASC";	
		return $this->fetchAll($sql, $params);
	}

	public function fetchByDescription($description) {
		$sql = "select {$this->table}.* from {$this->table} WHERE {$this->table}.description = :description";
		$params[":description"] = $description;
		return $this->fetchOne($sql, $params);
	}


	public function fetchSectionItemIds($section) {
		$sql = "select id from section_item where section_id = :section_id";
		$params[":section_id"] = $section;
		$data = $this->fetchAll($sql, $params);

		$section_items = array();
		foreach ($data as $k => $d) {
			$section_items[] = $d->id;
		}
		return $section_items;
	}
}