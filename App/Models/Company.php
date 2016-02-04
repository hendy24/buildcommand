<?php

class Company extends AppModel {

	protected $table = "company";

	public function fetchCompany() {
		$sql = "SELECT {$this->table}.* FROM {$this->table} INNER JOIN site_user ON site_user.company_id = {$this->table}.id WHERE site_user.id = :user_id";
		$params[":user_id"] = auth()->getRecord()->id;
		return $this->fetchOne($sql, $params);
	}

}