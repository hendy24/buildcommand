<?php

class Company extends AppModel {

	protected $table = "company";

	public function fetchCompany() {
		$user = $this->loadTable('User');
		$sql = "SELECT c.* FROM {$this->table} c INNER JOIN {$user->tableName()} u ON u.company = c.id WHERE u.id = :user_id";
		$params[":user_id"] = auth()->getRecord()->id;
		return $this->fetchOne($sql, $params);
	}

}
