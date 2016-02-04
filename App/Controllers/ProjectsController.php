<?php

class ProjectsController extends AppController {

	public function index() {
		$helper = $this->loadHelper('ToolMenu');
		smarty()->assign('toolMenu', $helper);
		$company = $this->loadModel('Company')->fetchCompany();
		$projects = $this->loadModel('Project')->fetchProjects();

		smarty()->assignByRef('company', $company);
		smarty()->assignByRef('projects', $projects);
		$this->title = $company->name;
	}



	public function manage() {
		$project = $this->loadModel('Project', input()->id);
		$helper = $this->loadHelper('ToolMenu');
		smarty()->assign('toolMenu', $helper);
		smarty()->assignByRef('project', $project);

		// Fetch Item Groups
		$itemGroups = $this->loadModel('ItemGroup')->fetchItemGroupData($project->id);

		$margin = $this->loadModel('EstimateItem')->fetchBySectionItem($project->id, 86);
		$contingency = $this->loadModel('EstimateItem')->fetchBySectionItem($project->id, 85);

		if (empty ($itemGroups)) {
			$itemGroups = $this->loadModel('ItemGroup')->fetchAll();
			foreach ($itemGroups as $k => $i) {
				$itemGroups[$k]->estimated_cost = "";
				$itemGroups[$k]->actual_cost = "";
				$totalEstimatedCost = "";
				$totalActualCost = "";
			}
		} else {
			$totalEstimatedCost = null;
			$totalActualCost = null;
			foreach ($itemGroups as $k => $i) {	
				if ($itemGroups[$k]->description == "Closing") {
					$itemGroups[$k]->estimated_cost = $itemGroups[$k]->estimated_cost + ($margin->estimated_cost + $contingency->estimated_cost);
				}
				$totalEstimatedCost += $i->estimated_cost;
				$totalActualCost += $i->actual_cost;
			}

		}


		smarty()->assign('itemGroups', $itemGroups);
		smarty()->assign('totalEstimatedCost', currency_format($totalEstimatedCost));
		smarty()->assign('totalActualCost', currency_format($totalActualCost));
	}


	public function add() {
		smarty()->assign('title', "Add new project");
		$user = $this->loadModel('SiteUser', auth()->getRecord()->id);


		// Form has been submitted
		if (input()->is("post")) {

			$project = $this->loadModel("Project");

			if (input()->name != "") {
				$project->name = input()->name;
			} else {
				$error_message[] = "Enter a name for the new project";
			}

			$project->company_id = $user->company_id;
			$project->project_number = input()->project_number;
			$project->owner_email = input()->owner_email;
			$project->bank_email = input()->bank_email;

			if (input()->payment_type != "") {
				$project->payment_type = input()->payment_type;
			} else {
				$error_message[] = "Select a payment type for the project";
			}

			if (input()->payment_type == "cost_plus" && input()->margin == "") {
				$error_message[] = "Enter the profit margin percentage";
			} else {
				$project->margin = input()->margin;
			}

			if (input()->contingency != "") {
				$project->contingency = input()->contingency;
			} else {
				$error_message[] = "Enter the contingency percentage";
			}

			// Enter project square footages
			$project->basement_sq_ft = input()->basement_sq_ft;
			$project->main_floor_sq_ft = input()->main_floor_sq_ft;
			$project->upper_floor_sq_ft = input()->upper_floor_sq_ft;
			$project->garage_sq_ft = input()->garage_sq_ft;
			$project->status = 'Pending';
			

			// Process the file upload
			// If plan is attached set filename and upload to webroot/files folder		
			if (isset ($_FILES['plan_filename']) && $_FILES['plan_filename']['name'] != '') {
				if (preg_match ('/^application\/pdf$/i', $_FILES['plan_filename']['type'])) {
					$filename = time() . '_' . $user->public_id . '.pdf';
					$upload = ROOT . '/App/webroot/files/plans/' . $filename;				
				} else {
					session()->setFlash("The house plan must be in a PDF format.", 'error');
					$this->redirect(array('controller' => 'projects', 'action' => 'add'));
				}
							
				if (is_uploaded_file($_FILES['plan_filename']['tmp_name'])) {
					copy($_FILES['plan_filename']['tmp_name'], $upload);
				}
				$project->plan_filename = $filename;
			}



			// BREAKPOINT !!!!!!!!!!!!!!!!!!!
			if (!empty ($error_message)) {
				session()->setFlash($error_message, 'error');
				$this->redirect(input()->path);
			}


			// If there were no errors... then save the new project
			if ($project->save()) {
				// save to site user projects so the user that created the project has access to it.
				$this->loadModel('SiteUserProject')->searchExisting($user->id, $project->id);

				session()->setFlash("Successfully added new project", 'success');
				$this->redirect(array('page' => 'projects'));
			} else {
				session()->setFlash("Could not save project.  Please try again.");
				$this->redirect(array('page' => 'projects', 'action' => 'add'));
			}
		}
	}



	public function edit() {
		$this->title = "Edit project";
		$user = $this->loadModel('SiteUser', auth()->getRecord()->id);



		$project = $this->loadModel('Project', input()->id);
		smarty()->assignByRef('project', $project);


		// Form has been submitted
		if (input()->is("post")) {
			if (input()->name != "") {
				$project->name = input()->name;
			} else {
				$error_message[] = "Enter a name for the new project";
			}

			$project->company_id = $user->company_id;
			$project->project_number = input()->project_number;
			$project->owner_email = input()->owner_email;
			$project->bank_email = input()->bank_email;


			if (input()->payment_type != "") {
				$project->payment_type = input()->payment_type;
			} else {
				$error_message[] = "Select a payment type for the project";
			}

			if (input()->payment_type == "cost_plus" && input()->margin == "") {
				$error_message[] = "Enter the profit margin percentage";
			} else {
				$project->margin = input()->margin;
			}

			if (input()->contingency != "") {
				$project->contingency = input()->contingency;
			} else {
				$error_message[] = "Enter the contingency percentage";
			}

			// Enter project square footages
			$project->basement_sq_ft = input()->basement_sq_ft;
			$project->main_floor_sq_ft = input()->main_floor_sq_ft;
			$project->upper_floor_sq_ft = input()->upper_floor_sq_ft;
			$project->garage_sq_ft = input()->garage_sq_ft;
			

			// Process the file upload
			// If plan is attached set filename and upload to webroot/files folder		
			if (isset ($_FILES['plan_filename']) && $_FILES['plan_filename']['name'] != '') {
				if (preg_match ('/^application\/pdf$/i', $_FILES['plan_filename']['type'])) {
					$filename = time() . '_' . $user->public_id . '.pdf';
					$upload = ROOT . '/App/webroot/files/plans/' . $filename;				
				} else {
					session()->setFlash("The house plan must be in a PDF format.", 'error');
					$this->redirect(array('controller' => 'projects', 'action' => 'add'));
				}
							
				if (is_uploaded_file($_FILES['plan_filename']['tmp_name'])) {
					copy($_FILES['plan_filename']['tmp_name'], $upload);
				}
				$project->plan_filename = $filename;
			}



			// BREAKPOINT !!!!!!!!!!!!!!!!!!!
			if (!empty ($error_message)) {
				session()->setFlash($error_message, 'error');
				$this->redirect(input()->path);
			}


			// If there were no errors... then save the new project
			if ($project->save()) {
				$this->loadModel('SiteUserProject')->searchExisting($user->id, $project->id);

				session()->setFlash("Successfully added new project", 'success');
				$this->redirect(array('page' => 'projects'));
			} else {
				session()->setFlash("Could not save project.  Please try again.");
				$this->redirect(input()->path);
			}
		}
	}



	public function archive() {
		$project = $this->loadModel('Project', input()->id);
		$project->status = input()->status;

		if ($project->save()) {
			return true;
		}

		return false;
	}



}