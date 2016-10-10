<?php

class EstimateCategory extends AppModel {
  protected $table = "estimate_category";


  public function fetchCategoriesAndItems($project_id) {
  	$estimate_item = $this->loadTable('EstimateItem');
  	$estimate = $this->loadTable('Estimate');

  	$sql = "SELECT c.pipeline, c.name AS category, ei.id AS estimate_item_id, ei.estimate_category, ei.name AS estimate_item, ei.bid_filename, (SELECT amount FROM {$estimate->tableName()} WHERE project = :project_id AND estimate_item = ei.id) AS amount,
      (SELECT id FROM {$estimate->tableName()} WHERE project = :project_id AND estimate_item = ei.id) AS estimate_id
  		FROM {$this->tableName()} AS c
  		INNER JOIN {$estimate_item->tableName()} ei ON ei.estimate_category = c.id
  		ORDER BY c.id ASC, -ei.item_order DESC";

  	$params[":project_id"] = $project_id;

  	return $this->fetchAll($sql, $params);
  }

}
