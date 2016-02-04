<?php

class CompanyController extends AppController {

	public function index() {
		// Only administrators can access this page
		if (!auth()->is_admin()) {
			session()->setFlash("You do not have authorization to access the company info page", 'error');
			$this->redirect(SITE_URL);
		}

		$company = $this->loadModel('Company')->fetchCompany();
		$states = getUSAStates();

		smarty()->assignByRef('company', $company);
		smarty()->assign('states', $states);


		if (input()->is('post')) {

			// Validate form fields
			if (input()->name != "") {
				$company->name = input()->name;
			} else {
				$error_message[] = "Enter the company name";
			}

			if (input()->address != "") {
				$company->address = input()->address;
			} 

			if (input()->city != "") {
				$company->city = input()->city;
			} 

			if (input()->state != "") {
				$company->state = input()->state;
			} else {
				$error_message[] = "Enter the company state";
			}

			if (input()->zip != "") {
				$company->zip = input()->zip;
			} else {
				$error_message[] = "Enter the company zip";
			}

			if (input()->phone != "") {
				$company->phone = input()->phone;
			} 

			if (input()->fax != "") {
				$company->fax = input()->fax;
			} 

			if (input()->email != "") {
				$company->email = input()->email;
			} 

			if (input()->license_number != "") {
				$company->license_number = input()->license_number;
			} 

			if ($company->save()) {
				session()->setFlash("Successfully saved company info", 'success');
				$this->redirect(SITE_URL);
			} else {
				session()->setFlash("Could not save company info", 'error');
				$this->redirect(input()->path);
			}

		}

	}



	public function searchNames() {
		$this->template = 'blank';
		$term = input()->query;
		if ($term != "") {
			$tokens = explode(' ', $term);
			$params = array();

			$builder_id = auth()->getRecord()->company_id;
			$params[":builder_id"] = $builder_id;

			$sql = "SELECT company.id AS companyId, company.name AS companyName FROM company INNER JOIN partner ON partner.partner_id = company.id WHERE partner.builder_id = :builder_id AND ";
			foreach ($tokens as $idx => $token) {
				$token = trim($token);
				$sql .= " company.name LIKE :term{$idx} AND ";
				$params[":term{$idx}"] = "%{$token}%";
			}
			$sql = rtrim($sql, ' AND');
			$sql .= " GROUP BY company.id";
			
			$class = $this->loadModel('Company');
			$results = $class->fetchAll($sql, $params);
		} else {
			$results = array();
		}
		$resultsArray = array();
		foreach ($results as $k => $r) {
			$resultsArray['suggestions'][$k]['value'] = $r->companyName;
			$resultsArray['suggestions'][$k]['data'] = $r->companyId;
		}

		json_return($resultsArray);
	}	


}