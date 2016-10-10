<?php

class EstimatesController extends AppController {
	private $project_id;
	private $project = array();
	private $closing = false;


	public function main() {
		if (input()->project != "") {
			$project = $this->load('Project', input()->project);
		} else {
			session()->setFlash("Could not find the selected project. Please try again.");
			$this->redirect();
		}
		
		$estimateItems = $this->load('EstimateCategory')->fetchCategoriesAndItems($project->id);

		$itemsArray = array();
		foreach ($estimateItems as $item) {
			$itemsArray[$item->category][] = $item;
		}

		smarty()->assign('project', $project);
		smarty()->assign('estimateItems', $itemsArray);

		// process submitted form
		if (input()->is("post")) {
			echo "hello"; exit;
		}
	}


	public function saveEstimateAmount() {
		if (input()->project_id != "") {
			$project = $this->load('Project', input()->project_id);
		}

		if (input()->amount != "") {
			$amount = str_replace(",", "", input()->amount);
		}
		if (input()->estimate_id != "") {
			$estimate = $this->load('Estimate', input()->estimate_id);
		} else {		
			$estimate = $this->load('Estimate')->fetchEstimate($project->id, input()->estimate_item_id);
		}
		$estimate->project = $project->id;
		$estimate->estimate_item = input()->estimate_item_id;
		$estimate->amount = $amount;
		
		if ($estimate->save()) {
			return true;
		}

		return false;
	}

	// public function general() {
	// 	$dataArray = $this->getPageData();
	// 	if (input()->is('post')) {
	// 		if ($this->submitPageData($dataArray)) {
	// 			$project = $this->getProjectById();
	// 			$this->redirect(array('page' => 'estimates', 'action' => 'rough_structure', 'id' => $project->public_id));
	// 		}

	// 	}

	// }

	// public function rough_structure() {
	// 	$dataArray = $this->getPageData();
	// 	if (input()->is('post')) {
	// 		if ($this->submitPageData($dataArray)) {
	// 			$project = $this->getProjectById();
	// 			$this->redirect(array('page' => 'estimates', 'action' => 'mechanical', 'id' => $project->public_id));
	// 		}
	// 	}
	// }

	// public function mechanical() {
	// 	$dataArray = $this->getPageData();
	// 	if (input()->is('post')) {
	// 		if ($this->submitPageData($dataArray)) {
	// 			$project = $this->getProjectById();
	// 			$this->redirect(array('page' => 'estimates', 'action' => 'interior', 'id' => $project->public_id));
	// 		}
	// 	}
	// }

	// public function interior() {
	// 	$dataArray = $this->getPageData();
	// 	if (input()->is('post')) {
	// 		if ($this->submitPageData($dataArray)) {
	// 			$project = $this->getProjectById();
	// 			$this->redirect(array('page' => 'estimates', 'action' => 'exterior', 'id' => $project->public_id));
	// 		}
	// 	}
	// }

	// 	public function exterior() {
	// 	$dataArray = $this->getPageData();
	// 	if (input()->is('post')) {
	// 		if ($this->submitPageData($dataArray)) {
	// 			$project = $this->getProjectById();
	// 			$this->redirect(array('page' => 'estimates', 'action' => 'closing', 'id' => $project->public_id));
	// 		}
	// 	}
	// }

	// public function closing() {
	// 	$this->closing = true;
	// 	$dataArray = $this->getPageData();
	// 	if (input()->is('post')) {
	// 		if ($this->submitPageData($dataArray)) {
	// 			$project = $this->getProjectById();
	// 			session()->setFlash("The estimate info has been saved", 'success');
	// 			$this->redirect(array('page' => 'projects', 'action' => 'manage', 'id' => $project->public_id));
	// 		}
	// 	}
	// }







	// /*
	//  * -------------------------------------------------------------------------
	//  *  COMMON FUNCTIONS FOR ALL ESTIMATE PAGES
	//  * -------------------------------------------------------------------------
	//  * 	NOTE:  Get all sections, section items, and estimate items (if they exist) from the database,
	//  *  and store in an array to be used to display the data on each page.  Additional section items
	//  *  can be added to the database and will automatically appear in the specified section.
	//  *
	//  */

	// private function getPageData() {
	// 	$pageTitle = stringify(input()->action);

	// 	smarty()->assign('action', input()->action);

	// 	$project = $this->getProjectById();
	// 	smarty()->assign('project', $project);

	// 	if (input()->action == "printView") {
	// 		$section = "all";
	// 	} else {
	// 		$section = input()->action;
	// 	}


	// 	// Load models
	// 	$sections = $this->loadModel('Section')->fetchByItemGroupName($section);
	// 	$sectionItems = $this->loadModel('SectionItem');
	// 	$sectionDetails = $this->loadModel('SectionDetail');
	// 	$sectionEstimate = $this->loadModel('EstimateItem');

	// 	$dataArray = array();
	// 	foreach ($sections as $section) {
	// 		// Fetch estimate by sectionid
	// 		$estimateCosts = $this->loadModel('Estimate')->fetchByProjectAndSection($this->project_id, $section->id);
	// 		// Get the section items for the page section
	// 		$params = array(
	// 			'section' => array(
	// 				'id' => $section->id
	// 			)
	// 		);
	// 		$sectionItemData = $sectionItems->fetch($params);
	// 		// Save them in the dataArray
	// 		// Get the section detail items for each section
	// 		foreach ($sectionItemData as $k => $sid) {
	// 			$params = array(
	// 				'project' => array(
	// 					'id' =>$project->id
	// 				),
	// 				'estimate_item' => array(
	// 					'section_item_id' => $sid->id
	// 				)
	// 			);
	// 			$estimateData = $sectionEstimate->fetch($params);

	// 			$params = array(
	// 				'section_item' => array(
	// 					'id' => $sid->id
	// 				)
	// 			);
	// 			$sectionDetailData = $sectionDetails->fetch($params);

	// 			// Set data into the dataArray
	// 			if (!empty ($estimateData)) {
	// 				foreach ($estimateData as $estimate) {
	// 					$dataArray[$section->description]['cost'] = $estimateCosts;
	// 					$dataArray[$section->description][$sid->description] = $estimate;
	// 				}
	// 			} else {
	// 				$estimateItem = $this->loadModel('EstimateItem');
	// 				$estimateItem->section_item_id = $sid->id;
	// 				$dataArray[$section->description][$sid->description] = $estimateItem;

	// 			}


	// 		}
	// 	}

	// 	if ($this->closing) {
	// 		$margin = $this->loadModel('EstimateItem')->fetchItemBySectionItemId($this->project->id, 86);
	// 		$contingency = $this->loadModel('EstimateItem')->fetchItemBySectionItemId($this->project->id, 85);
	// 	} else {
	// 		$margin = array();
	// 		$contingency = array();
	// 	}

	// 	smarty()->assign('margin', $margin);
	// 	smarty()->assign('contingency', $contingency);

	// 	smarty()->assign('title', $this->project_name . ": " . $pageTitle);
	// 	smarty()->assign('pageTitle', $pageTitle);
	// 	smarty()->assignByRef('pageData', $dataArray);
	// 	return $dataArray;

	// }


	// //  Submit the form page data to save to database

	// private function submitPageData($dataArray = array()) {
	// 	//  Process form data
	// 	foreach ($dataArray as $name => $data) {
	// 		unset($data['cost']);
	// 		foreach ($data as $sectionItem) {
	// 			//  If the project_id is not set then we are saving values for a new project
	// 			if (!isset($sectionItem->project_id)) {
	// 				$project = $this->getProjectById();
	// 				$sectionItem->project_id = $project->id;
	// 			}


	// 			foreach (input()->estimated_cost as $section_item_id => $estimated_cost) {
	// 				if ($sectionItem->section_item_id == $section_item_id) {
	// 					$sectionItem->estimated_cost = $estimated_cost;
	// 				}
	// 			}
	// 			if (isset (input()->actual_cost)) {
	// 				foreach (input()->actual_cost as $section_item_id => $actual_cost) {
	// 					if ($sectionItem->section_item_id == $section_item_id) {
	// 						$sectionItem->actual_cost = $actual_cost;
	// 					}
	// 				}
	// 			}



	// 			if ($sectionItem->id == '') {
	// 				$sectionItem->id = $sectionItem->save();
	// 				if ($sectionItem->id == '') {
	// 					$error_message[] = "Could not save the " . $name . " section";
	// 				}
	// 			} elseif ($sectionItem->save()) {
	// 				$success = true;
	// 			} else {
	// 				$error_message[] = "Could not save the " . $name . " section";
	// 			}

	// 		}

	// 	}

	// 	//  Save the section totals
	// 	$this->totalSectionItems($dataArray);

	// 	if (!empty ($error_message)) {
	// 		session()->setFlash($error_message, 'error');
	// 		$this->redirect(input()->path);
	// 	}

	// 	return true;

	// }


	// private function getProjectById() {
	// 	if (input()->id == "") {
	// 		session()->setFlash("Could not find the project", 'error');
	// 		$this->redirect();
	// 	} else {
	// 		$project_id = input()->id;
	// 	}
	// 	$project = $this->loadModel('Project', $project_id);
	// 	smarty()->assign('projectId', $project_id);
	// 	smarty()->assignByRef('project', $project);
	// 	$this->project_id = $project->id;
	// 	$this->project_name = $project->name;
	// 	$this->project = $project;
	// 	return $project;
	// }


	// private function totalSectionItems($dataArray) {
	// 	foreach ($dataArray as $description => $data) {
	// 		$section[] = $this->loadModel('Section')->fetchByDescription($description);
	// 		foreach ($section as $s) {
	// 			$section_items = $this->loadModel('Section')->fetchSectionItemIds($s->id);
	// 			$estimate = $this->loadModel('Estimate')->fetchByProjectAndSection($this->project_id, $s->id);

	// 			// Clear the values stored for estimated and actual costs
	// 			$estimate->estimated_cost = null;
	// 			$estimate->actual_cost = null;

	// 			$estimate->project_id = $this->project_id;
	// 			$estimate->section_id = $s->id;
	// 			foreach (input()->estimated_cost as $k => $ec) {
	// 				if (in_array($k, $section_items)) {
	// 					$estimate->estimated_cost += $ec;
	// 				}
	// 			}
	// 			if (isset (input()->actual_cost)) {
	// 				foreach (input()->actual_cost as $k => $ec) {
	// 					if (in_array($k, $section_items)) {
	// 						$estimate->actual_cost += $ec;
	// 					}
	// 				}
	// 			}

	// 			// If the project is cost plus then calculate the margin
	// 			if ($this->project->margin != "") {
	// 				$margin = $this->loadModel('EstimateItem');
	// 				$margin->project_id = $this->project->id;
	// 				$margin->section_item_id = 86;
	// 				$margin->estimated_cost = $estimate->estimated_cost * $this->project->margin;
	// 			} else {
	// 				$margin = array();
	// 			}

	// 			if ($estimate->id == "") {
	// 				$estimate->id = $estimate->save();
	// 				if ($estimate->id == "") {
	// 					$error_message[] = "Could not save the " . $description . " section total";
	// 				}
	// 			} elseif ($estimate->save()) {
	// 				$success = true;
	// 			} else {
	// 				$error_message[] = "Could not save the " . $description . " section data";
	// 			}
	// 		}
	// 	}

	// 	// Save total project cost
	// 	$this->totalProjectCost();

	// 	if (!empty ($error_message)) {
	// 		session()->setFlash($error_message, 'error');
	// 		$this->redirect(input()->path);
	// 	}

	// 	return true;


	// }


	// public function totalProjectCost() {
	// 	$estimate = $this->loadModel('Estimate')->fetchTotalProjectCost($this->project_id);
	// 	$project = $this->loadModel('Project', $this->project_id);

	// 	// If job is cost plus add that amount
	// 	if ($this->project->margin != "") {
	// 		$margin = $this->loadModel('EstimateItem')->fetchBySectionItem($this->project->id, 86);
	// 		$margin->project_id = $this->project->id;
	// 		$margin->section_item_id = 86;
	// 		$margin->estimated_cost = $estimate->estimated_cost * $this->project->margin;
	// 	} else {
	// 		$margin = array();
	// 	}
	// 	// If a contingency value is set then calculate contingency
	// 	if ($this->project->contingency != "") {
	// 		$contingency = $this->loadModel('EstimateItem')->fetchBySectionItem($this->project->id, 85);
	// 		$contingency->project_id = $this->project->id;
	// 		$contingency->section_item_id = 85;
	// 		$contingency->estimated_cost = $estimate->estimated_cost * $this->project->contingency;
	// 	} else {
	// 		$contingency = array();
	// 	}

	// 	$margin->save();
	// 	$contingency->save();

	// 	$project->estimated_cost = $estimate->estimated_cost + ($margin->estimated_cost + $contingency->estimated_cost);
	// 	$project->actual_cost = $estimate->actual_cost;

	// 	$project->save();
	// 	return true;
	// }


	// public function printView() {
	// 	$this->template = "blank";
	// 	$dataArray = $this->getPageData();

	// 	$company = $this->loadModel('Company', auth()->getRecord()->company_id);
	// 	smarty()->assign('company', $company);

	// }

}
