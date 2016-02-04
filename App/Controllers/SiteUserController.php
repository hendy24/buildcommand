<?php

class SiteUserController extends MainController {

	public function add() {
		$this->title = "Add a New User";
		smarty()->assign('states', getUSAStates());
		$user = auth()->getRecord();
		
		$groups = $this->loadModel('SiteUserGroup')->fetchAll();	
		smarty()->assign('groups', $groups);
		
		// Get available projects
		$projects = $this->loadModel('Project')->fetchProjects();
		smarty()->assignByRef('projects', $projects);	
		smarty()->assign('states', getUSAStates());	

		smarty()->assign('editUser', $this->loadModel('SiteUser'));
											
		if (input()->is('post')) {	
			// Instantiate new user
			$newUser = $this->loadModel('SiteUser');


			// Validate form inputs
			if (input()->group != "") {
				$newUser->group_id = input()->group;
			} else {
				$error_message[] = "Select a group";
			}

			if (input()->first_name != "") {
				$newUser->first_name = input()->first_name;
			} else {
				$error_message[] = "Enter the first name";
			}

			if (input()->last_name != "") {
				$newUser->last_name = input()->last_name;
			} else {
				$error_message[] = "Enter the last name";
			}

			if (input()->address != "") {
				$newUser->address = input()->address;
			} 

			if (input()->city != "") {
				$newUser->city = input()->city;
			} 

			if (input()->state != "") {
				$newUser->state = input()->state;
			} 

			if (input()->zip != "") {
				$newUser->zip = input()->zip;
			} 

			if (input()->phone != "") {
				$newUser->phone = input()->phone;
			} 

			if (input()->email != "") {
				$newUser->email = input()->email;
			} else {
				$error_message[] = "Enter the username (email address)";
			}

			if (input()->password != "") {
				if (input()->password == input()->verify_password) {
					$newUser->password = auth()->encrypt_password(input()->password);
				} else {
					$error_message[] = "The passwords do not match";
				}
				
			} else {
				$error_message[] = "Enter the new users first name";
			}

			$newUser->terms = true;
			$newUser->privacy = true;
			$newUser->verified = true;


			// Give the new user the same company id as the user adding the new user
			$newUser->company_id = auth()->getRecord()->company_id;
			$newUser->account_type_id = 1;


			if (!empty ($error_message)) {
				session()->setFlash($error_message, 'error');
				$this->redirec(input()->path);
			}

			$user_id = $newUser->save();

			if ($user_id != "") {
				// Give user access to selected project(s)
				if (is_array(input()->project)){
					foreach (input()->project as $p) {
						$userProject = $this->loadModel('SiteUserProject');
						$userProject->user_id = $user_id;
						$userProject->project_id = input()->project;
						$userProject->save();
					}
				} else {
					$userProject = $this->loadModel('SiteUserProject');
					$userProject->user_id = $user_id;
					$userProject->project_id = input()->project;
					$userProject->save();
				}

				session()->setFlash("Successfully added new user", 'success');
				$this->redirect(SITE_URL);
			} else {
				session()->setFlash("Could not add new user", 'error');
				$this->redirect(input()->path);
			}



		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit() {
		$this->title = "Edit User";
		$this->content = "add";
		
		if (input()->id == "") {
			session()->setFlash("Could not find the user.", 'error');
			$this->redirect(input()->path);
		} 
			
		$editUser = $this->loadModel('SiteUser', input()->id);
		smarty()->assignByRef('editUser', $editUser);

		smarty()->assign('states', getUSAStates());
		$user = auth()->getRecord();
		
		$groups = $this->loadModel('Group')->fetchAll();						
		smarty()->assign('groups', $groups);
		
		// Get available projects
		$projects = $this->loadModel('Project')->fetchProjects();
		smarty()->assignByRef('projects', $projects);	
		smarty()->assign('states', getUSAStates());	

		if (input()->is('post')) {
			
		}
	}
 	
 	
 	
 	
 	
 	/*
 	 * -------------------------------------------------------------
 	 *  REGISTRATION PAGE
 	 * -------------------------------------------------------------
 	 * 
 	 */
 	public function register() {
	 	
	 	$this->set('states', $this->states());
	 		 	
	 	if ($this->request->is('post')) {

	 	}
 	}
 	
 	
 	/*
 	 * -------------------------------------------------------------
 	 *  USERNAME VALIDATION
 	 * -------------------------------------------------------------
 	 * 
 	 */
 	 
 	public function validate_form() {
	}

	public function verify_registration() {
	}

 	public function not_verified() {
 	}

 	public function account_verified() {
 	}

 	public function already_verified() {
 	}


/*
 *
 * -------------------------------------------------------------
 *	USER MANAGEMENT PAGES
 * -------------------------------------------------------------
 *
 */

	public function account_info() {
		$accountUser = $this->loadModel('SiteUser', auth()->getRecord()->id);

		smarty()->assign('states', getUSAStates());
		smarty()->assign('accountUser', $accountUser);

		if (input()->is('post')) {

			if (input()->first_name != "") {
				$accountUser->first_name = input()->first_name;
			} else {
				$error_message[] = "Enter a first name";
			}

			if (input()->last_name != "") {
				$accountUser->last_name = input()->last_name;
			} else {
				$error_message[] = "Enter a last name";
			}

			if (input()->address != "") {
				$accountUser->address = input()->address;
			} 

			if (input()->city != "") {
				$accountUser->city = input()->city;
			} 

			if (input()->zip != "") {
				$accountUser->zip = input()->first_name;
			} 

			if (input()->phone != "") {
				$accountUser->phone = input()->phone;
			} 

			if (input()->email != "") {
				$accountUser->email = input()->email;
			} else {
				$error_message[] = "Enter a username (email address)";
			}


			if (empty ($error_message)) {
				if ($accountUser->save()) {
					session()->setFlash("Successfully save the user info", 'success');
					$this->redirect();
				}
			} else {
				session()->setFlash($error_message, 'error');
			}
		}
	}
	

	public function manage() {
		// Only allow access to administrators
		if (!auth()->is_admin()) {
			session()->setFlash("You do not have the correct permissions to access the manage site_user page.", 'error');
			$this->redirect();
		}

		// Fetch user list for the company
		$users = $this->loadModel('SiteUser')->fetchAllByCompanyId();
		smarty()->assignByRef('users', $users);
		$this->title = "Manage site_user";
	}


	// Change password
	public function change_password() {

		$editUser = $this->loadModel('SiteUser', input()->id);
		smarty()->assign('editUser', $editUser);

		if (input()->is('post')) {
			if (input()->password != "") {
				if (input()->password == input()->verify_password) {
					$editUser->password = auth()->encrypt_password(input()->password);
				} else {
					$error_message[] = "The passwords do not match";
				}
			} else {
				$error_message[] = "Enter a password";
			}

			if (empty ($error_message)) {
				if ($editUser->save()) {
					session()->setFlash("The password was successfully changed", 'success');
					$this->redirect(array('page' => 'site_user', 'action' => 'manage'));
				}
			} else {
				session()->setFlash($error_message, 'error');
			}	
		}
	}
 	

}
