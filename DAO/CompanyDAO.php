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

		array_push($this->companiesList, $company);

		$this->saveData();
	}

	public function getByCuit($cuit) {

		$this->retrieveData();

		$companyToReturn = null;
		$i = 0;

		while (!$companyToReturn && $i < count($this->companiesList)) {
			if ($cuit === $this->companiesList[$i]->getCuit()) {
				$companyToReturn = $this->companiesList[$i];
			} else {
				$i++;
			}
		}

		return $companyToReturn;
	}

	public function update(Company $company) {

		$this->retrieveData();

		$index = $this->getIndexByCuit($company->getCuit());

		if ($index !== false) {
			$this->companiesList[$index] = $company;
		}

		$this->saveData();
	}

	public function delete($cuit)
	{
		$this->retrieveData();

		$index = $this->getIndexByCuit($cuit);

		if ($index !== false) {
			unset($this->companiesList[$index]);

			$this->saveData();
		}		
	}

	private function getIndexByCuit($cuit) {

		$this->retrieveData();

		$i = 0;
		$index = false;

		while (($index === false) && ($i < count($this->companiesList))) {
			if ($cuit === $this->companiesList[$i]->getCuit()) {
				$index = $i;
			} else {
				$i++;
			}
		}

		return $index;
	}

	private function saveData() {

		$arrayToEncode = array();

		foreach ($this->companiesList as $company) {
			/* Company  	[ Id,, cuit, name, role ] */
			$valuesArray["id"] = $company->getId();
			$valuesArray["cuit"] = $company->getCuit();
			$valuesArray["name"] = $company->getName();
			$valuesArray["role"] = $company->getRole();
			$valuesArray["active"] = $company->getActive();

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
				$company->setCuit($valuesArray['cuit']);
				$company->setName($valuesArray['name']);
				$company->setRole($valuesArray['role']);
				$company->setActive($valuesArray['active']);

				array_push($this->companiesList, $company);
			}
		}
	}
}
