<?php

class PartnersController extends AppController {


	public function index() {
		$this->title = "Building Partners";
		if (isset (input()->type)) {
			$type = input()->type;
		} else {
			$type = false;
		}
		$partners = $this->loadModel('Partner')->fetchByType($type);
		$company = $this->loadModel('Company', auth()->getRecord()->company_id);

		// Get partner types
		$partnerTypes = $this->loadModel('AccountType')->fetchTypes();
		smarty()->assign('partnerTypes', $partnerTypes);

		$data = array();
		// group partners by speciality type
		foreach ($partners as $p) {
			$data[$p->speciality][] = $p;
		}

		smarty()->assign('data', $data);
		smarty()->assign('company', $company);
		smarty()->assign('inputType', $type);
	}


	public function add() {
		$this->title = "Add new Partner";
		$partner = $this->loadModel('Company');

		// fetch account types
		$accountTypes = $this->loadModel('AccountType')->fetchTypes();
		$accountSpecialities = $this->loadModel('AccountSpeciality')->fetchAll();
		smarty()->assign('companyAccountType', false);
		smarty()->assign('editPartner', false);


		smarty()->assignByRef('partner', $partner);
		smarty()->assign('accountTypes', $accountTypes);
		smarty()->assign('accountSpecialities', $accountSpecialities);
		smarty()->assign('states', getUSAStates());
	}

	public function edit() {
		$this->content = 'add';
		$this->title = "Edit Partner";
		
		if (input()->id == "") {
			session()->setFlash("We're sorry, we could not find the company you were looking for.  Please, try again.", 'error');
			$this->redirect(array('page' => 'partners'));
		}

		// fetch account types
		$accountTypes = $this->loadModel('AccountType')->fetchTypes();
		$accountSpecialities = $this->loadModel('AccountSpeciality')->fetchAll();
		smarty()->assign('accountTypes', $accountTypes);
		smarty()->assign('accountSpecialities', $accountSpecialities);
		smarty()->assign('states', getUSAStates());
		smarty()->assign('editPartner', true);

		$partner = $this->loadModel('Company', input()->id);
		smarty()->assignByRef('partner', $partner);

		// Fetch the account type
		$companyAccountType = $this->loadModel('AccountType', $partner->account_type_id);
		smarty()->assign('companyAccountType', $companyAccountType);

		// Fetch the company speciality types
		$companySpecialityType = $this->loadModel('AccountSpeciality', $partner->account_speciality_id);
		smarty()->assign('companySpecialityType', $companySpecialityType);

		// Fetch additional speciality types
		$addSpecs = $this->loadModel('AccountSpecialityLink')->fetchTypes($partner->id);
		smarty()->assign('addSpecs', $addSpecs);

	}


	public function submit() {
		if (isset (input()->id)) {
			$partner_id = input()->id;
		} else {
			$partner_id = false;
		}
		$partner = $this->loadModel('Company', $partner_id);
		$error_message = array();
		$company_id = auth()->getRecord()->company_id;

		if (input()->name != "") {
			$partner->name = input()->name;
		} else {
			$error_message[] = "Enter the company name";
		}

		if (input()->contact_name != "") {
			$partner->contact_name = input()->contact_name;
		} 

		if (input()->account_type != "") {
			$partner->account_type_id = input()->account_type;
		} else {
			$error_message[] = "Select an account type";
		}

		if (input()->account_speciality != "") {
			$partner->account_speciality_id = input()->account_speciality;
		} 

		$partner->address = input()->address;
		$partner->city = input()->city;
		$partner->state = input()->state;
		$partner->zip = input()->zip;
		$partner->phone = input()->phone;
		$partner->fax = input()->fax;
		$partner->email = input()->email;
		$partner->license_number = input()->license_number;


		if (!empty($error_message)) {
			session()->setFlash($error_message, 'error');
			$this->redirect(input()->path);
		}

		if ($partner->save()) {

			$specialityLink = $this->loadModel('AccountSpecialityLink')->fetchAllByCompanyId($partner->id);
			//  First delete all entries in the account_speciality_link table with this
			//  company id
			foreach( $specialityLink as $link) {
				$link->delete();
			}

			//  Now save the new ones
			if (!empty (input()->account_speciality_id)) {
				foreach (input()->account_speciality_id as $id) {
					$addSpecs = $this->loadModel('AccountSpecialityLink');
					$addSpecs->company_id = $partner->id;
					$addSpecs->account_speciality_id = $partner->account_speciality_id;
					$addSpecs->save();
				}
			}

			// need to save the new company as a partner
			$partnerCompany = $this->loadModel('Partner');
			$partnerCompany->builder_id = auth()->getRecord()->company_id;
			$partnerCompany->partner_id = $partner->id;
			$partnerCompany->save();

			session()->setFlash("Successfully added {$partner->name}", 'success');
			$this->redirect(array('page' => 'partners'));
				
		} else {
			session()->setFlash("Could not add the partner.  Please try again.", 'error');
			$this->redirect(input()->path);
		}

	}

}