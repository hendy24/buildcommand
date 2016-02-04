<?php

class AccountType extends AppModel {
	protected $table = 'account_type';
	
	public function fetchTypes() {
		$sql = "SELECT * FROM {$this->table} WHERE id != 1 ORDER BY name ASC";
		return $this->fetchAll($sql);
	}
}