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

		try {

			$query = "SELECT * FROM " . $this->tableName . " WHERE cuit = " . $cuit;

			$connection = Connection::GetInstance();

			$queryResult = $connection->Execute($query);

			$company = new Company();

			$company->setId($queryResult[0]['id_company']);
			$company->setName($queryResult[0]['name']);
			$company->setCuit((int)$queryResult[0]['cuit']);
			$company->setRole($queryResult[0]['company_role']);
			$company->setDescription($queryResult[0]['description']);
			$company->setLink($queryResult[0]['link']);
			$company->setActive(($queryResult[0]['active'] === "0" ? false : true));
		} catch (Exception $ex) {
		}

		return $company;
	}

	public function update(Company $company) {

		/* UPDATE utnjobs.companies
		SET description='11111111',company_role='asd'
		WHERE id_company=1; */

		try{
			$query = 'UPDATE ' . $this->tableName .
			 	' SET
					name = :name,
					company_role = :company_role,
					description = :description,
					link = :link,
					active = :active 
				WHERE id_company = :id';

			$connection = Connection::GetInstance();

			
			$parameters['name'] = $company->getName();
			$parameters['company_role'] = $company->getRole();
			$parameters['description'] = ($company->getDescription()) ? $company->getDescription() : "";
			$parameters['link'] = ($company->getLink()) ? $company->getLink() : "";
			$parameters['active'] = ($company->getActive())?1:0;
			$parameters['id'] = $company->getId();

			$connection = Connection::GetInstance();

			$connection->ExecuteNonQuery($query, $parameters);


		}catch (Exception $ex) {
			throw $ex;
		}
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
