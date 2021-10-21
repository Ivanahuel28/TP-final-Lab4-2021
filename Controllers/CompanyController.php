<?php

namespace Controllers;

use DAO\CompanyDAO as CompanyDAO;
use Models\Company as Company;

class CompanyController {

	private $companyDAO;

	public function __construct() {
		$this->companyDAO = new CompanyDAO();
	}

	public function showCompaniesView() {

		$companiesList = $this->companyDAO->getAll();

		require_once(VIEWS_PATH . 'companies-list.php');
	}

	public function showAddView() {
		require_once(VIEWS_PATH . 'company-add.php');
	}

	public function showViewEditCompany($companyCuit) {

		$company = $this->companyDAO->getByCuit($companyCuit);

		require_once(VIEWS_PATH . 'company-edit.php');
	}

	public function add($cuit, $name, $role, $active = false) {

		if ($this->companyDAO->getByCuit($cuit) == null) {

			$company = new Company();

			$company->setId(count($this->companyDAO->getAll()));
			$company->setCuit($cuit);
			$company->setName($name);
			$company->setRole($role);
			$company->setActive(($active == "true") ? true : false);

			$this->companyDAO->add($company);

			$this->showCompaniesView();
		}
	}

	public function executeEditCompany($cuit, $name, $role, $active = false) {

		$companyToEdit = new Company();
		$companyToEdit->setCuit($cuit);
		$companyToEdit->setName($name);
		$companyToEdit->setRole($role);
		$companyToEdit->setActive($active);

		$this->companyDAO->update($companyToEdit);

		$this->showCompaniesView();
	}

	public function executeDeleteCompany($cuit) {

		$this->companyDAO->delete($cuit);

		$this->showCompaniesView();
	}
}
