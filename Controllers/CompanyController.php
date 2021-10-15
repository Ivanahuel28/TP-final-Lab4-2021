<?php

namespace Controllers;

use DAO\CompanyDAO as CompanyDAO;
use Models\Company as Company;

class CompanyController {

	private $companyDAO;

	public function __construct(){
		$this->companyDAO = new CompanyDAO();
	}

	public function showCompaniesView() {

		$companiesList = $this->companyDAO->getAll();

		require_once(VIEWS_PATH . 'companies-list.php');
	}

	public function showAddView() {
		require_once(VIEWS_PATH . 'company-add.php');
	}

	public function add($name,$role){

		$company = new Company();

		$company->setId(0);
		$company->setName($name);
		$company->setRole($role);

		$this->companyDAO->add($company);

		$this->showCompaniesView();
	}

}
