<?php

class MySqlDb {

	private $db;
	public $username;
	public $username2;
	public $password;
	public $password2;
	public $dbname;
	public $dbname2;
	public $host;
	public $host2;

	
	public function __construct() {
		
	}
	
	public function conn() {
		try {
			$conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
			if (DEVELOPMENT) {
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}

			$conn2 = new PDO("mysql:host={$this->host2};dbname={$this->dbname2}", $this->username, $this->password);
			if (DEVELOPMENT) {
				$conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			
		} catch (PDOException $e) {
			echo "ERROR: " . $e->getMessage();
		}
		
		$this->db = $conn;
		
	}
	
	public function getConnection() {
		return $this->db;
	}


	/*
	 * Write database query functions to be used site-wide
	 *
	 */
	 
	public function fetchRows($sql, $params, $class) {
		$className = get_class($class);
		$conn = $this->getConnection();
		$stmt = $conn->prepare($sql);
		$stmt->execute($params);
		$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $className);
		$result = $stmt->fetchAll();

		// Get the table name for the called class	
		$table = $class->fetchTable();
		//	Check if the public_id already has a value
		if ($className != 'AdmissionDashboard') {
			$this->checkPublicId($result, $table);
		}
		
		return $result;
	}
	
	public function fetchRow($sql, $params, $class) {
		$conn = $this->getConnection();
		$stmt = $conn->prepare($sql);
		$stmt->execute($params);
		$className = get_class($class);
		$stmt->setFetchMode(PDO::FETCH_CLASS, $className);
		
		$result = $stmt->fetch();
		if (method_exists($class, 'fetchTable')) {
			$table = $class->fetchTable();
		} else {
			$table = null;
		}

		if (!empty ($result)) {
			$this->checkPublicId($result, $table);
		}

		
		return $result;
	}

	public function fetchColumns($sql, $params, $class) {
		$conn = $this->getConnection();
		$stmt = $conn->prepare($sql);
		$stmt->execute($params);
		return $stmt->fetchAll(PDO::FETCH_COLUMN);
	}

	public function fetchColumnNames($table) {
		$conn = $this->getConnection();
		$stmt = $conn->prepare("DESCRIBE {$table}");
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_COLUMN);
	}

	public function fetchCount($table) {
		$sql = "SELECT count('id') AS items FROM `{$table}`";
		$conn = $this->getConnection();
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	public function update($sql, $params = null) {
		$conn = $this->getConnection();
		$stmt = $conn->prepare($sql);
		$stmt->execute($params);
	}

	public function destroy($data) {
		$table = $data->fetchTable();
		$sql = "DELETE FROM `{$table}` WHERE `{$table}`.`id`=:id";
		$params[':id'] = $data->id;

		$conn = $this->getConnection();
		$stmt = $conn->prepare($sql);
		$stmt->execute($params);
	}

	public function saveRow($data) {
		$table = $data->fetchTable();
		$numOfItems = count((array)$data);
		$count = 1;
		$dataSet = $this->setDataStamps($data);
		$sql = "INSERT INTO {$table} (";
		foreach ($dataSet as $k => $d) {
			$sql .= "{$k}";
			if ($count < $numOfItems) {
				$count++;
				$sql .= ", ";
			}
			
		}
		$sql = trim($sql, ', ');
		$sql .= ") VALUES (";
		$count = 1;
		foreach ($dataSet as $k => $d) {
			$sql .= ":{$k}";
			if ($count < $numOfItems) {
				$count++;
				$sql .= ", ";
			}
			$params[":$k"] = $d;
		}
		$sql = trim($sql, ', ');
		$sql .= ")";
		$conn = $this->getConnection();
		$stmt = $conn->prepare($sql);
		$stmt->execute($params);
		$dataSet->id = $conn->lastInsertId();
		return $conn->lastInsertId();
	}


	public function updateRow($data) {
		$table = $data->fetchTable();
		$numOfItems = count((array)$data);
		$count = 1;


		$dataSet = $this->setDataStamps($data);

		$sql = "UPDATE {$table} SET ";
		foreach ($dataSet as $k => $d) {
			$params[":$k"] = $d;
			$sql .= "{$k} = :{$k}";

			if ($count < $numOfItems) {
				$count++;
				$sql .= ", ";
			}
			
		}
		$sql = trim($sql, ', ');

		$sql .= " WHERE {$table}.id = " . $data->id;

		$conn = $this->getConnection();
		$stmt = $conn->prepare($sql);
		$stmt->execute($params);

		return true;
	}

	
	private function checkPublicId($array, $tables) {
		if (is_object($array)) {
			if (isset ($array->public_id)) {
				if ($array->public_id == '') {
					$array->public_id = getRandomString();					
					$this->updatePublicId($array, $tables);	
				} else {
					return true;
				}
				
			}
		} else {
			foreach ($array as $r) {
				if (is_object($r)) {
					if (isset ($r->publid_id)) {
						if ($r->public_id == '') {
							$r->public_id = getRandomString();
							$this->updatePublicId($r, $tables);
						}
					}
				} else {
					if ($r['public_id'] == '') {
						$r['public_id'] = getRandomString();
						$this->updatePublicId($r, $tables);
					}
				}
			}
		}
	}
	
	private function updatePublicId($array, $tables) {
		if (is_array($tables)) {
			foreach ($tables as $t) {
				$table = underscoreString($t);
				$sql = "UPDATE {$table} SET {$table}.public_id=:public_id WHERE {$table}.id=:id";
				$params = array(
					':public_id' => $array->public_id,
					':id' => $array->id
				);
				$this->update($sql, $params);
			}
		} else {
			$table = underscoreString($tables);
			$sql = "UPDATE {$table} SET {$table}.public_id=:public_id WHERE {$table}.id=:id";
			$params = array(
				':public_id' => $array->public_id,
				':id' => $array->id
			);
			$this->update($sql, $params);
		}
		
		
	}
	
	public function findByPubId($public_id, $table) {
		$sql = "SELECT * FROM :table WHERE public_id = :public_id";
		$params[':table'] = lcfirst($table);
		$params[':public_id'] = $public_id;
				
		return $this->getResults($sql, $params);
	}
	

	public function setDataStamps($data) {
		//	Check for public id
		

		if (array_key_exists('public_id', $data)) {
			if ($data->public_id == '') {
				$data->public_id = getRandomString();
			}
		} 
		
		if (array_key_exists ('datetime_created', $data)) {
			if ($data->datetime_created == null || $data->datetime_created == '0000-00-00 00:00:00') {
				$data->datetime_created = mysql_datetime();
			}
		} 
		
		if (array_key_exists ('datetime_modified', $data)) {
			$data->datetime_modified = mysql_datetime();
		}	

		if (array_key_exists('datetime_last_login', $data)) {
			$data->datetime_last_login = mysql_datetime();
		}			

		//	Get user data from the session
		$user = auth()->getRecord();

		if (array_key_exists('user_created', $data) && ($data->user_created == '' || $data->user_created == 0)) {
			$data->user_created = $user->id;
		}

		if (array_key_exists('user_modified', $data)) {
			$data->user_modified = $user->id;
		}

		foreach ($data as $k => $d) {
			if (($d != 0 || $d != false) && $d == '') {
				unset ($data->$k);
			}
		}

		return $data;
	}

	
}