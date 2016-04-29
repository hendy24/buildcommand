<?php

class LoginController extends AppController {

	public function login() {
		smarty()->assign('title', "Login");
	}


	public function logout() {
		if (auth()->logout()) {
			$this->redirect(SITE_URL);
		}
	}


	public function register() {

	}


	public function submitLogin() {
		if (input()->user == "") {
			$errorMessage[] = "Enter your username (email address)";
		} else {
			$username = input()->user;
		}

		if (input()->password == "") {
			$errorMessage[] = "Enter your password.";
		} else {
			$password = input()->password;
		}

		if (!empty ($errorMessage)) {
			session()->setFlash($errorMessage, 'error');
			$this->redirect(input()->path);
		}


		// If the username and password are correctly entered, validate the user
		if (auth()->login($username, $password)) {
			// redirect to user's default home page
			//$this->redirect(array('module' => session()->getSessionRecord('default_module')));
			$user = auth()->getRecord();
			if (isset ($user->temp_password)) {
				$this->redirect(array('page' => 'user', 'action' => 'reset_password', 'id' => $user->public_id));
			} else {
				$this->redirect(array('page' => 'project'));
			}


		} else { // send them back to the login page with an error
			session()->setFlash(array('Could not authenticate the user'), 'error');
			$this->redirect(input()->path);
		}


	}
}
