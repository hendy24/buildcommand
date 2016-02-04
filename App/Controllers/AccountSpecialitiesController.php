<?php

class AccountSpecialitiesController extends AppController {

	public function findByAccountType() {
		$specialities = $this->loadModel('AccountSpeciality')->fetchByAccountTypeId(input()->account_type);

		$dataArray = array();
		foreach ($specialities as $k => $s) {
			$dataArray[$k]['id'] = $s->id;
			$dataArray[$k]['name'] = $s->name;
		}

		json_return($dataArray);
	}
}