<?php

class SectionItemsController extends AppController {

	public function searchItems() {
		$this->template = 'blank';
		$term = input()->query;
		if ($term != "") {
			$tokens = explode(' ', $term);
			$params = array();

			$sql = "SELECT section.description AS sectionDescription, section_item.id AS sectionItemId, section_item.description AS sectionItemDescription FROM section_item INNER JOIN section ON section.id = section_item.section_id WHERE (";
			foreach ($tokens as $idx => $token) {
				$token = trim($token);
				$sql .= " section_item.description LIKE :term{$idx} AND ";
				$params[":term{$idx}"] = "%{$token}%";
			}
			$sql = rtrim($sql, ' AND');
			$sql .= ") OR (";
			foreach ($tokens as $idx => $token) {
				$token = trim($token);
				$sql .= " section.description LIKE :term{$idx} AND ";
				$params[":term{$idx}"] = "%{$token}%";
			}
			$sql = rtrim($sql, ' AND');
			$sql .= ")";
			
			$class = $this->loadModel('SectionItem');
			$results = $class->fetchAll($sql, $params);
		} else {
			$results = array();
		}
		$resultsArray = array();
		foreach ($results as $k => $r) {
			$resultsArray['suggestions'][$k]['value'] = $r->sectionDescription . ": " . $r->sectionItemDescription;
			$resultsArray['suggestions'][$k]['data'] = $r->sectionItemId;
		}

		json_return($resultsArray);
	}	
}