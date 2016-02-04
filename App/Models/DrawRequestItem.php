<?php

class DrawRequestItem extends AppModel {
	protected $table = "draw_request_item";


	public function checkForExisting($draw_request_id, $payee_id, $estimate_item_id) {
		$sql = "SELECT {$this->table}.* FROM {$this->table} INNER JOIN draw_request ON draw_request.id = {$this->table}.draw_request_id WHERE draw_request.status = 'Pending' AND draw_request.id = :draw_request_id AND {$this->table}.payee_id = :payee_id AND {$this->table}.estimate_item_id = :estimate_item_id";
		$params = array(
			":draw_request_id" => $draw_request_id,
			":payee_id" => $payee_id,
			":estimate_item_id" => $estimate_item_id
		);

		$data = $this->fetchOne($sql, $params);


		if (!empty ($data)) {
			return $data;
		}

		return $this->fetchColumnNames();
	}


	public function fetchAllItems($draw_request_id) {
		$sql = "SELECT company.id AS company_id, company.name, section_item.id AS section_item_id, CONCAT(section.description, ': ', section_item.description) AS section_item_name, estimate_item.id AS estimate_id, {$this->table}.* FROM {$this->table} INNER JOIN company ON company.id = {$this->table}.payee_id INNER JOIN estimate_item ON estimate_item.id = {$this->table}.estimate_item_id INNER JOIN section_item ON section_item.id = estimate_item.section_item_id INNER JOIN section ON section.id = section_item.section_id WHERE {$this->table}.draw_request_id = :draw_request_id";
		$params[":draw_request_id"] = $draw_request_id;
		return $this->fetchAll($sql, $params);

	}




}