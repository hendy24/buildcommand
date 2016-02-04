<?php

class ItemGroup extends AppModel {
	protected $table = 'item_group';


	public function fetchItemDataByName($name) {
		$sql = "SELECT 
			section.id AS SectionId,
			section.name AS SectionName,
			section.description AS SectionDescription,
			section.section_order AS SectionOrder,
			section_item.id AS SectionItemId,
			section_item.name AS SectionItemName,
			section_item.description AS SectionItemDescription,
			section_detail.id AS SectionDetailId,
			section_detail.name AS SectionDetailName,
			section_detail.description AS SectionDetailDescription
			FROM {$this->table} 
			INNER JOIN section ON section.item_group_id = {$this->table}.id 
			INNER JOIN section_item ON section_item.section_id = section.id
			LEFT JOIN section_detail ON section_detail.section_item_id = section_item.id
			WHERE {$this->table}.name = :name";
		$params[":name"] = $name;
		return $this->fetchAll($sql, $params);
	}


	public function fetchItemGroupData($project_id) {
		$sql = "select {$this->table}.*, SUM(estimate.estimated_cost) AS estimated_cost, SUM(estimate.actual_cost) AS actual_cost from item_group inner join section on section.item_group_id = item_group.id INNER JOIN estimate ON estimate.section_id = section.id where estimate.project_id = :project_id GROUP BY item_group.id";
		$params[":project_id"] = $project_id;
		return $this->fetchAll($sql, $params);
	}


}