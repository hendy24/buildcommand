<?php

class User extends AppModel {

	protected $table = "user";


	public function fetchAllByCompanyId() {
		$group = $this->loadTable('Group');
		$sql = "SELECT u.*, group.name FROM {$this->table} u INNER JOIN {$group->tableName()} group ON group.id = {u.group_id WHERE u.company_id = :company_id ORDER BY u.last_name ASC";
		$params[":company_id"] = auth()->getRecord()->company_id;
		return $this->fetchAll($sql, $params);
	}

}
