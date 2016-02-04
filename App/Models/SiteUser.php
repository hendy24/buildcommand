<?php

class SiteUser extends AppModel {

	protected $table = "site_user";


	public function fetchAllByCompanyId() {
		$sql = "SELECT {$this->table}.*, site_user_group.name AS group_name FROM {$this->table} INNER JOIN site_user_group ON site_user_group.id = {$this->table}.group_id WHERE {$this->table}.company_id = :company_id ORDER BY {$this->table}.last_name ASC";
		$params[":company_id"] = auth()->getRecord()->company_id;
		return $this->fetchAll($sql, $params);
	}

}