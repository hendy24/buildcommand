<?php

class SiteController extends MainController {


	/*
	 *
	 * The default public landing page is now the login page... no public facing page
	 *
	 */
	public function index() {
		$this->title = "BuildCommand | Project Management Login";
		$this->template = 'login';

		if (auth()->isLoggedIn()) {
			$this->redirect(array('page' => 'projects'));
		} 
	}


	// public function fees() {
	// 	smarty()->assign('title', 'Fees');
	// }

	// public function privacy() {
	// 	smarty()->assign('title', 'Privacy Policy');
	// }

	// public function terms() {
	// 	smarty()->assign('title', 'Terms of Use');
	// }

	// public function about() {
	// 	smarty()->assign('title', 'About Us');
	// }

	// public function contact() {
	// 	smarty()->assign('title', 'Contact Us');
	// }

	// public function thank_you() {
	// 	smarty()->assign('title', 'Thank You');
	// }


}
