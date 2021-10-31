<?php

namespace DAO;

use DAO\IntfCompanyDAO as IntfCompanyDAO;
use DAO\Connection as Connection;
use Exception;
use Models\Company;

class CompanyDAO implements IntfCompanyDAO {

	//private $companiesList;
	private $tableName = "companies";

	public function __construct() {
		$this->companiesList = array();
	}

	public function getAll() {

		$companiesList = array();

		try {

			$query = "SELECT * FROM " . $this->tableName;

			$connection = Connection::GetInstance();

			$queryResult = $connection->Execute($query);

			foreach ($queryResult as $element) {

				$company = new Company();

				$company->setId($element['id_company']);
				$company->setName($element['name']);
				$company->setCuit((int)$element['cuit']);
				$company->setRole($element['company_role']);
				$company->setDescription($element['description']);
				$company->setLink($element['link']);
				$company->setActive(($element['active'] === "0" ? false : true));

				array_push($companiesList, $company);
			}
		} catch (Exception $ex) {
		}

		return $companiesList;
	}

	public function getAllActives() {

		$companiesList = array();

		try {

			$query = "SELECT * FROM " . $this->tableName . " WHERE active = 1";

			$connection = Connection::GetInstance();

			$queryResult = $connection->Execute($query);

			foreach ($queryResult as $element) {

				$company = new Company();

				$company->setId($element['id_company']);
				$company->setName($element['name']);
				$company->setCuit((int)$element['cuit']);
				$company->setRole($element['company_role']);
				$company->setDescription($element['description']);
				$company->setLink($element['link']);
				$company->setActive(($element['active'] === "0" ? false : true));

				array_push($companiesList, $company);
			}
		} catch (Exception $ex) {
		}

		return $companiesList;
	}

	public function add(Company $company) {

		try {
			$query = "INSERT INTO " . $this->tableName .
				" (cuit, name, company_role,description,link,active)
			  VALUES (:cuit, :name, :company_role,:description,:link,:active);";

			$parameters['cuit'] = $company->getCuit();
			$parameters['name'] = $company->getName();
			$parameters['company_role'] = $company->getRole();
			$parameters['description'] = $company->getDescription();
			$parameters['link'] = $company->getLink();
			$parameters['active'] = $company->getActive();

			$this->connection = Connection::GetInstance();

			$this->connection->ExecuteNonQuery($query, $parameters);
		} catch (Exception $ex) {
			throw $ex;
		}
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
			$company->setId($this->companiesList[$index]->getId());
			$this->companiesList[$index] = $company;
		}

		$this->saveData();
	}

	public function delete($cuit) {
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

	/* private function saveData() {

		$arrayToEncode = array();

		foreach ($this->companiesList as $company) {
			
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
	} */
}
