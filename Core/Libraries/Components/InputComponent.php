<?php

class Input {

	public $input = array();
	public $_post = array();
	public $_get = array();

	public function __construct() {
		foreach ($_REQUEST as $key => $value) {
			if (is_array($value)) {
				foreach ($value as $k => $v) {
					if (!isset ($this->$key)) {
						$this->$key = new StdClass;
						$this->$key->$k = "";
					}
					if (is_array ($v)) {
						foreach ($v as $i) {
							if (!isset ($this->$key->$k)) {
								$this->$key->$k = new StdClass;
								$this->$key->$k->$i = "";
							}
							$this->$key->$k->$i = stripslashes($i);
						}
					} else {
						$this->$key->$k = stripslashes($v);
					}
				}
			} elseif (isset ($_POST[$key])) {
				$this->$key = stripslashes($value);
			} elseif (isset ($_GET[$key])) {
				$this->$key = stripslashes($value);
			}
		}

	}

	public function is($data) {
		if ($data == 'post') {
			if ($_POST) {
				return true;
			}
		}
	}

	public function post($name = false) {
		if ($name != false) {
			return $this->_post[$name];
		} else {
			return $this->_post;
		}
	}

	public function get($name = false) {
		if ($name != false) {
			return $this->_get[$name];
		} else {
			return $this->_get;
		}
	}

}
