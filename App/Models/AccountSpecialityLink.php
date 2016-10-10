<?php

class AccountSpecialityLink extends AppModel {
	protected $table = 'account_speciality_link';

	public function fetchAllByCompanyId($id) {
		$sql = "SELECT * FROM {$this->table} WHERE company = :id";
		$params[":id"] = $id;
		return $this->fetchAll($sql, $params);
	}

	public function fetchTypes($id) {
		$sql = "SELECT account_speciality.* FROM {$this->table} INNER JOIN account_speciality ON account_speciality.id = {$this->table}.account_speciality_id WHERE {$this->table}.company = :id";
		$params[":id"] = $id;
		return $this->fetchAll($sql, $params);
	}
}