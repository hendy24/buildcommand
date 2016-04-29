<?php

class UserProject extends AppModel {
	protected $table = "user_project";


	public function searchExisting($user_id, $project_id) {
		$sql = "SELECT * FROM {$this->table} WHERE user_id = :user_id AND project_id = :project_id";
		$params = array(
			":user_id" => $user_id,
			":project_id" => $project_id
		);

		$data = $this->fetchOne($sql, $params);

		if (empty($data)) {
			$this->user_id = $user_id;
			$this->project_id = $project_id;
			$this->save();
		}

		return true;

	}

}
