<?php

class AccountSpeciality extends AppModel {
	protected $table = 'account_speciality';

	public function fetchByAccountTypeId($account_id = false) {
		if ($account_id) {
			$sql = "SELECT {$this->table}.* FROM {$this->table} WHERE account_type_id = :account_id";
			$params[":account_id"] = $account_id;
			return $this->fetchAll($sql, $params);
		}

		return false;
	}
	
}