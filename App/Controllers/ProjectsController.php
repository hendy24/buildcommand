<?php

class ProjectsController extends AppController {

/*
 * -----------------------------------------------------------------------------
 * MAIN PROJECTS PAGE
 * -----------------------------------------------------------------------------
 * This is the main landing page after logging in from which all projects
 * can be accessed.
 *
 */
	public function index() {
		$helper = $this->loadHelper('ToolMenu');
		smarty()->assign('toolMenu', $helper);
		$company = $this->load('Company')->fetchCompany();
		$projects = $this->load('Project')->fetchProjects();

		smarty()->assignByRef('company', $company);
		smarty()->assignByRef('projects', $projects);
		$this->title = $company->name;
	}



	public function manage() {
		$project = $this->load('Project', input()->id);
		$helper = $this->loadHelper('ToolMenu');
		smarty()->assign('toolMenu', $helper);
		smarty()->assignByRef('project', $project);


		// set the year
		if (isset (input()->year)) {
			$year = date('Y', strtotime(input()->year));
		} else {
			$year = date('Y', strtotime("now"));
		}

		// set the month
		if (isset (input()->month)) {
			$month = date('F', strtotime("first day of " . input()->month . "  " . $year));
		} else {
			$month = date('F', strtotime("now"));
		}

		// get the actions for this project
		$actions = $this->load('Action')->fetchActions($project->id);
		smarty()->assign('actions', $actions);

		$notes = $this->load('Note')->fetchNotes($project->id, 5);
		smarty()->assign('notes', $notes);

		// get the calendar dates for the month
		$calendar = new Calendar;
		$calendar->getMonth($month, $year);
		smarty()->assignByRef('calendar', $calendar);

		// $margin = $this->load('EstimateItem')->fetchBySectionItem($project->id, 86);
		// $contingency = $this->load('EstimateItem')->fetchBySectionItem($project->id, 85);

	}


/*
 * -----------------------------------------------------------------------------
 * ADD A NEW PROJECT
 * -----------------------------------------------------------------------------
 * Creates a new project associated with the user who created it and the company
 * with which the user is associated.
 *
 */
	public function add() {
		smarty()->assign('title', "Add new project");
		$user = $this->load('User', auth()->getRecord()->id);

		// get project classes
		$class = $this->load('ProjectClass')->fetchAll();
		$type = $this->load('ProjectType')->fetchAll();

		smarty()->assign('class', $class);
		smarty()->assign('type', $type);

		// Form has been submitted
		if (input()->is("post")) {
			$project = $this->load('Project');
			$project_class_type = $this->load('ProjectClassType');

			if (input()->class != "") {
				$project_class_type->project_class_id = input()->class;
			}

			if (input()->type != "") {
				$project_class_type->project_type_id = input()->type;
			}

			if ($project_class_type->save()) {
				$project->class_type_id = $project_class_type->id;
			} else {
				// $error_message[] = "Could not save the project class and type.";
			}

			if (input()->name != "") {
				$project->name = input()->name;
			} else {
				$error_message[] = "Enter a name for the new project";
			}

			$project->company_id = $user->company_id;
			if (input()->owner_email != "") {
				$project->owner_email = input()->owner_email;
			}
			if (input()->lender_email != "") {
				$project->lender_email = input()->lender_email;
			}

			if (input()->bid_type != "") {
				$project->bid_type = input()->bid_type;
			} else {
				$error_message[] = "Select a bid type for the project";
			}

			if (input()->margin != "") {
				// need to make sure this number is a decimal percentage
				if (strstr(input()->margin, ".")) {
					$project->margin = input()->margin;
				} else {
					$project->margin = input()->margin / 100;
				}

			}

			if (input()->contingency != "") {
				if (strstr(input()->contingency, ".")) {
					$project->contingency = input()->contingency;
				} else {
					$project->contingency = input()->contingency / 100;
				}

			}

			// Enter project square footages
			$project->finished_sq_ft = input()->finished_sq_ft;
			$project->unfinished_sq_ft = input()->unfinished_sq_ft;
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
				$this->load('UserProject')->searchExisting($user->id, $project->id);

				session()->setFlash("Successfully added new project", 'success');
				$this->redirect(array('page' => 'projects'));
			} else {
				session()->setFlash("Could not save project.  Please try again.");
				$this->redirect(array('page' => 'projects', 'action' => 'add'));
			}
		}
	}




/*
 * -----------------------------------------------------------------------------
 * EDIT PROJECT INFO
 * -----------------------------------------------------------------------------
 * Page to edit and make changes to project specific information.
 *
 */
	public function edit() {
		$this->title = "Edit project";
		$user = $this->load('User', auth()->getRecord()->id);



		$project = $this->load('Project', input()->id);
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
				$this->load('UserProject')->searchExisting($user->id, $project->id);

				session()->setFlash("Successfully added new project", 'success');
				$this->redirect(array('page' => 'projects'));
			} else {
				session()->setFlash("Could not save project.  Please try again.");
				$this->redirect(input()->path);
			}
		}
	}




/*
 * -----------------------------------------------------------------------------
 * ARCHIVE A PROJECT
 * -----------------------------------------------------------------------------
 * Archive a completed project. This is accessed from a wrench menu via an ajax
 * call.
 *
 */
	public function archive() {
		$project = $this->load('Project', input()->id);
		$project->status = input()->status;

		if ($project->save()) {
			return true;
		}

		return false;
	}



}
