<?php

class AppController extends MainController {

	protected function siteData() {
		if (auth()->isLoggedIn()) {
			smarty()->assignByRef('companyProjects', $this->loadModel('Project')->fetchProjects());
			smarty()->assignByRef('user', $this->loadModel('User', auth()->getRecord()->id));
			smarty()->assignByRef('company', $this->loadModel('Company', auth()->getRecord()->company_id));


			if (file_exists(APP_DIR . DS . 'Webroot' . DS . 'images' . DS . 'logo.png')) {
				$headerImage = IMAGES . DS . 'logo.png';
			} elseif (file_exists(APP_DIR . DS . 'Webroot' . DS . 'images' . DS . 'logo.jpg')) {
				$headerImage = IMAGES . DS . 'logo.jpg';
			} else {
				$headerImage = false;
			}

		} else {
			$headerImage = false;
		}

		smarty()->assign('headerImage', $headerImage);

	}

}
