<?php

namespace DAO;

use DAO\IntfCompanyDAO as IntfCompanyDAO;
use Models\Company;

class CompanyDAO implements IntfCompanyDAO {

	private $companiesList;

	public function __construct() {
		$this->companiesList = array();
	}

	public function getAll() {
		$this->retrieveData();

		return $this->companiesList;
	}
	public function add(Company $company) {

		$this->retrieveData();

		array_push($this->companiesList,$company);

		$this->saveData();
	}

	private function saveData() {

		$arrayToEncode = array();

		foreach ($this->companiesList as $company) {
			/* Company  	[ Id, name, role ] */
			$valuesArray["id"] = $company->getId();
			$valuesArray["name"] = $company->getName();
			$valuesArray["role"] = $company->getRole();

			array_push($arrayToEncode, $valuesArray);
		}

		$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

		file_put_contents('Data/companies.json', $jsonContent);
	}

	private function retrieveData() {

		$this->companiesList = array();

		if (file_exists('Data/companies.json')) {
			$jsonContent = file_get_contents('Data/companies.json');

			$arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

			foreach ($arrayToDecode as $valuesArray) {
				$company = new Company();
				$company->setId($valuesArray['id']);
				$company->setName($valuesArray['name']);
				$company->setRole($valuesArray['role']);

				array_push($this->companiesList, $company);
			}
		}
	}
}
