<?php

class Partner extends AppModel {
	protected $table = 'partner';

	public function fetchByType($type = false) {
		$sql = "select company.id, company.public_id, company.name, company.contact_name, company.phone, company.email, account_speciality.name AS speciality from company INNER JOIN account_speciality_link ON account_speciality_link.company = company.id INNER JOIN account_speciality ON account_speciality.id = account_speciality_link.account_speciality INNER JOIN account_type ON account_type.id = company.account_type  where company.id in (select partner.partner_id from partner where builder_id = :builder_id)";
		$params[":builder_id"] = auth()->getRecord()->company_id;

		if ($type != false && $type != 'all') {
			$sql .= " AND account_type.name = :account_type";
			$params[":account_type"] = $type;
		}
		
		$sql .= " ORDER BY speciality ASC, company.name ASC";
		return $this->fetchAll($sql, $params);
	}
}