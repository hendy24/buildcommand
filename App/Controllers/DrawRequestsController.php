<?php

class DrawRequestsController extends AppController {

	public function index() {
		if (input()->id == "") {
			session()->setFlash("Could not find the project", 'error');
			$this->redirect();
		}

		$project = $this->loadModel('Project', input()->id);
		smarty()->assignByRef('project', $project);

		// Fetch any existing draw requests
		$drawRequests = $this->loadModel('DrawRequest')->fetchByProject($project->id);
		smarty()->assignByRef('drawRequests', $drawRequests);
	}


	public function request() {
		if (input()->id == "") {
			session()->setFlash("Could not find the project", 'error');
			$this->redirect();
		}

		// fetch the draw request
		$drawRequest = $this->loadModel('DrawRequest', input()->id);
		$margin = 0;
		$totalDrawRequest = 0;


		if (isset ($drawRequest->project_id)) {
			$project = $this->loadModel('Project', $drawRequest->project_id);	
		} else {
			$project = $this->loadModel('Project', input()->id);
		}

		$margin = round($totalDrawRequest * $project->margin,2);
		

		// fetch all the draw request items
		if (isset ($drawRequest->id)) {
			$drawRequestItems = $this->loadModel('DrawRequestItem')->fetchAllItems($drawRequest->id);
		} else {
			$drawRequestItems = array();
		}
		
		$totalItems = count($drawRequestItems);
		$company_margin = array();

		foreach ($drawRequestItems as $k => $item) {
			$totalDrawRequest += $item->amount;
			if ($item->section_item_id == 86) {
				$company_margin = $item; 
				unset ($drawRequestItems[$k]);
			}
		}

		smarty()->assignByRef('drawRequest', $drawRequest);
		smarty()->assign('companyMargin', $company_margin);
		smarty()->assignByRef('project', $project);
		smarty()->assign('margin', $margin);
		smarty()->assignByRef('drawRequestItems', $drawRequestItems);
		smarty()->assign('totalItems', $totalItems);
	}




	public function submit() {
		$project = $this->loadModel('Project', input()->id);

		// check for existing draw request item 
		$drawRequest = $this->loadModel('DrawRequest')->fetchPending($project->id);
		$company_id = auth()->getRecord()->company_id;

		// if the draw request item is empty then create a new one
		if (empty ($drawRequest)) {
			$drawRequest = $this->loadModel('DrawRequest');
			$drawRequest->project_id = $project->id;
			$drawRequest->status = "Pending";
			$drawRequest->save();
		}		

		//  Need to loop through each input item and save in a new array
		$dataArray = array();

		// create an empty array to hold variables to check db for existing items
		$recordCheckArray = array();

		// error check on payee, if not get payee id and save in record check array
		foreach (input()->payee as $k => $payee) {
			if ($payee != "") {
				$payeeCompany = $this->loadModel('Company', $payee);
				$recordCheckArray[$k]['payee_id'] = $payeeCompany->id;
			} else {
				//$error_message[] = "Enter the payee name";
			}	
		}

		// error check on section item, if not empty get the connected estimate item
		foreach (input()->section_item as $k => $section_item) {
			if ($section_item != "") {
				$estimateItem = $this->loadModel('EstimateItem')->fetchBySectionitem($project->id, $section_item);
				$recordCheckArray[$k]['estimate_item_id'] = $estimateItem->id;
			} else {
				//$error_message[] = "Enter the Estimate Item";
			}
		}

		// error check on the amount
		foreach (input()->amount as $k => $amount) {
			if ($amount != "") {
				$recordCheckArray[$k]['amount'] = $amount;
			} else {
				unset(input()->amount->$k);
				unset(input()->section_item->$k);
				unset(input()->payee->$k);
				unset(input()->new_payee->$k);
			}
		}


		// If there are errors then redirect back to page and display them
		if (!empty ($error_message)) {
			session()->setFlash($error_message, 'error');
			$this->redirect(input()->path);
		}

		// 
		foreach ($recordCheckArray as $k => $record) {
			$dataArray[$k] = $this->loadModel('DrawRequestItem')->checkForExisting($drawRequest->id, $record['payee_id'], $record['estimate_item_id']);
			$dataArray[$k]->draw_request_id = $drawRequest->id;
			$dataArray[$k]->payee_id = $record['payee_id'];
			$dataArray[$k]->estimate_item_id = $record['estimate_item_id'];
			$dataArray[$k]->amount = $record['amount'];
		}

		// Add the company profit margin to the data array
		$numOfItems = count($recordCheckArray);
		$dataArray[$numOfItems] = $this->loadModel('DrawRequestItem')->checkForExisting($drawRequest->id, $company_id, 86);
		$dataArray[$numOfItems]->draw_request_id = $drawRequest->id;
		$dataArray[$numOfItems]->payee_id = $company_id;
		$dataArray[$numOfItems]->estimate_item_id = $this->loadModel('EstimateItem')->fetchBySectionitem($project->id, 86)->id;
		$dataArray[$numOfItems]->amount = input()->margin_amount;


		//  Now loop through the data array and save the draw request items
		$success = false;
		$totalDrawAmount = 0;

		foreach ($dataArray as $item) {
			$totalDrawAmount += $item->amount;
			if (!$item->save()) {
				session()->setFlash("Could not save the draw request", 'error');
				$this->redirect(input()->path);
			}

			if (input()->type == "submit") {
				// Save the submitted values to the estimate_item actual_cost row
				$estimateItem = $this->loadModel('EstimateItem', $item->estimate_item_id);
				$estimateItem->actual_cost = $item->amount;

				// Fetch the contingency amount for the project
				$contingency = $this->loadModel('EstimateItem')->fetchBySectionItem($project->id, 85);

				// Update actual cost by adding cost just submitted to the previous actual cost amount
				$newCost = $estimateItem->actual_cost + $item->amount;
				$estimateItem->actual_cost = $newCost;

				if ($newCost > $estimateItem->estimated_cost) {
					$overage = $newCost - $estimateItem->estimated_cost;
					$contingency->estimated_cost - $overage;
				} 

				// Save the amounts
				// Need to save to actual cost in the project????

				
				if ($estimateItem->save() && $contingency->save()) {
					$success = true;
				}
			}
		}


		// need to save the total to draw request
		$drawRequest->draw_amount = $totalDrawAmount;
		if (input()->type == 'submit') {
			$drawRequest->status = "Submitted";
		}
		if ($drawRequest->save()) {
			if (input()->type == 'submit') {
				// need to send email to the homeowner and/or bank

			} 

			session()->setFlash("The draw request was saved", 'success');
			$this->redirect();
		} else {
			session()->setFlash("Could not save the draw request.  Please try again.", 'error');
			$this->redirect(input()->path);
		}		

	}


	public function remove_item() {
		if (input()->id != "") {
			$item = $this->loadModel("DrawRequestItem", input()->id);
			if ($item->delete()) {
				return true;
			}

			return false;
		}

		return false;
	}

}