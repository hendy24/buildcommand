<?php

class AppModel {


	public function generate($id = null, $class = null) {
		if ($id == null) {
			$class = get_called_class();
			return new $class;
		} else {
			if ($class != null) {
				$called_class = $class;
			} else {
				$called_class = get_called_class();
			}

			$class = new $called_class;
			return $this->fetchById($id, $class);

		}
	}



	/*
	 * -------------------------------------------------------------------------
	 *  FETCH ONE
	 * -------------------------------------------------------------------------
	 *
	 * NOTE: Uses a sql query prepared in the model with provided params to fetch
	 * a single result from the database
	 */	
	
	public function fetchOne($sql, $params = array(), $class = null) {
		if ($class != null) {
			$called_class = $class;
		} else {
			$called_class = get_called_class();
		}
		
		$class = new $called_class;
		try {
			return db()->fetchRow($sql, $params, $class);
		} catch (PDOException $e) {
			echo $e;
		}
	}



	/*
	 * -------------------------------------------------------------------------
	 *  FETCH ALL
	 * -------------------------------------------------------------------------
	 *
	 * NOTE: Uses a sql query prepared in the model with provided params to fetch
	 * all results from the database
	 */
	
	public function fetchAll($sql = null, $params = array()) {
		$called_class = get_called_class();
		$class = new $called_class;
		$table = $class->fetchTable();

		if ($sql == null) {
			$sql = "SELECT * FROM `{$table}`";
		}
		try {
			return db()->fetchRows($sql, $params, $class);
		} catch (PDOException $e) {
			echo $e;
		}
	}




	/*
	 * -------------------------------------------------------------------------
	 *  COMMON FETCH FUNCTION
	 * -------------------------------------------------------------------------
	 *
	 * NOTE: UseS the belongs to array from the model to join with another table and fetch the contents
	 */

	public function fetch($paramsArray = array()) {
		$sql = "select {$this->table}.* FROM {$this->table} ";

		if (!empty ($this->belongsTo)) {
			$sql .= " " . $this->belongsTo['join_type'] . " JOIN " . $this->belongsTo['table'] . " ON " . $this->belongsTo['table'] . "." . $this->belongsTo['foreign_key'] . " = {$this->table}." . $this->belongsTo['inner_key'];
		}
		if (!empty ($this->hasOne)) {
			$sql .= " " . $this->hasOne['join_type'] . " JOIN " . $this->hasOne['table'] . " ON " . $this->hasOne['table'] . "." . $this->hasOne['foreign_key'] . " = {$this->table}." . $this->hasOne['inner_key'];
		}
		if (!empty ($paramsArray)) {
			$sql .= " WHERE";

			foreach ($paramsArray as $key => $param) {
				foreach ($param as $k => $p) {
					$params[":{$key}"] = $p;
				}
				
				// Adding the .id to the query limits this as a universal function
				$sql .= " {$key}.{$k} = :{$key} AND";
			}
		}
		
		$sql = trim($sql, ' AND');
		return $this->fetchAll($sql, $params);
	}





	public function fetchAllData() {
		$table = $this->fetchTable();
		$sql = "SELECT `{$table}`.* FROM `{$table}`";
		$params = array();

		try {
			return db()->fetchRows($sql, $params, $this);
		} catch (PDOException $e) {
			echo $e;
		}

	}

	public function save($data = false) {
		try {
			if ($data) {
				if (!isset ($this->id) || $this->id != '') {
					db()->updateRow($this);
				} else {
					return db()->saveRow($this);
				}
				
			} else {
				if (isset ($this->id) && $this->id != '') {
					db()->updateRow($this);
				} else {
					return db()->saveRow($this);
				}
				
			}
		} catch (PDOException $e) {
			echo $e;
		}
		return true;
	}



	/*
	 * -------------------------------------------------------------------------
	 *  DELETE ITEM BY ID
	 * -------------------------------------------------------------------------
	 */
	
	public function delete($data = false) {
		try {
			if ($data) {
				db()->destroy($data);
			} else {
				db()->destroy($this);
			}

		} catch (PDOException $e) {
			echo $e;
		}

		return true;
	}
	
	public function fetchById($id, $className = null) {
		$params[':id'] = $id;

		if ($className != null) {
			$model = $className;
		} else {
			$model = get_class($this);
		}

		$class = new $model;
		$table = $class->fetchTable();
		
		
		$sql = "SELECT `{$table}`.*";
		$belongsTo = $class->fetchBelongsTo();

		if (!empty ($belongsTo)) {
			// foreach ($class->belongsTo as $k => $b) {
			// 	if (isset ($b['join_field'])) {
			// 		$sql .= ", `{$b['table']}`.`{$b['join_field']['column']}` AS {$b['join_field']['name']} ";
			// 	}
					
			// }

			$sql .= " FROM `{$table}`";

			// foreach ($belongsTo as $k => $b) {
			// 	$sql .= " {$b['join_type']} JOIN `{$b['table']}` ON `{$b['table']}`.`{$b['foreign_key']}` = `{$table}`.`{$b['inner_key']}`";
			// }
		} else {
			$sql .= " FROM `{$table}`";
		} 

		$sql .= " WHERE `{$table}`.";

		if (is_numeric($id)) {
			if ($model == 'HomeHealthSchedule') {
				$sql .= "patient_id=:id";
			} else {
				$sql .= "id=:id";
			}
			
		} else {
			$sql .= "public_id=:id";
		}
		return $this->fetchOne($sql, $params, $class);
	}


	public function fetchFields() {
		return $this->_manage_fields;
	}

	public function fetchTable() {
		return $this->table;
	}

	public function fetchColumnNames() {
		$table = $this->fetchTable();
		$columnNames =  db()->fetchColumnNames($table);

		foreach ($columnNames as $n) {
			$this->$n = null;
		}

		return $this;
	}

	public function fetchBelongsTo() {
		if (isset ($this->belongsTo)) {
			return $this->belongsTo;
		}
		return false;
	}

	public function fetchHasMany() {
		if (isset ($this->hasMany)) {
			return $this->hasMany;
		}
		return false;
	}

	public function fetchColumnsToInclude() {
		return $this->_add_fields;
	}


	/*
	 * -------------------------------------------------------------------------
	 *  FETCH ALL DATA FOR MANAGE PAGE
	 * -------------------------------------------------------------------------
	 */

	public function fetchManageData($loc = false, $orderby = false) {
		if (isset (input()->type)) {
			$model = ucfirst(camelizeString(depluralize(input()->type)));
			$class = new $model;

			if (isset (input()->page_num)) {
				$_pageNum = input()->page_num;
			} else {
				$_pageNum = false;
			}

			$pagination = new Paginator();
			return $pagination->fetchResults($class, $orderby, $_pageNum, $loc);
		}

		return false;
	}


	// public function fetchColumnNames() {
	// 	$called_class = get_called_class();
	// 	$class = new $called_class;
	// 	$table = $class->fetchTable();
	// 	$sql = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`=:dbname AND `TABLE_NAME`=:table";
	// 	$params[':table'] = $table;
	// 	$params[':dbname'] = db()->dbname;
	// 	try {
	// 		return db()->fetchColumns($sql, $params, $class);
	// 	} catch (PDOException $e) {
	// 		echo $e;
	// 	}
	// }


	public function fullName() {
		return $this->last_name . ", " . $this->first_name;
	}
	
	
	
	
}