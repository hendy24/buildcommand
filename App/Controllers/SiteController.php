<?php

class SiteController extends MainController {


	public function index() {
		$this->title = "Construction Project Management";

		if (auth()->isLoggedIn()) {
			$this->redirect(array('page' => 'projects'));
		}
	}


	public function fees() {
		smarty()->assign('title', 'Fees');
	}

	public function privacy() {
		smarty()->assign('title', 'Privacy Policy');
	}

	public function terms() {
		smarty()->assign('title', 'Terms of Use');
	}

	public function about() {
		smarty()->assign('title', 'About Us');
	}

	public function contact() {
		smarty()->assign('title', 'Contact Us');
	}

	public function thank_you() {
		smarty()->assign('title', 'Thank You');
	}


}