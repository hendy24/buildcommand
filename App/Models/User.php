<?php

class User extends AppModel {

	protected $table = "user";


	public function fetchAllByCompanyId() {
		$group = $this->loadTable('Group');
		$sql = "SELECT u.*, group.name FROM {$this->table} u INNER JOIN {$group->tableName()} group ON group.id = {u.group WHERE u.company = :company_id ORDER BY u.last_name ASC";
		$params[":company_id"] = auth()->getRecord()->company_id;
		return $this->fetchAll($sql, $params);
	}

}
