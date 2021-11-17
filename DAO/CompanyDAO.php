<?php

namespace DAO;

use DAO\IntfCompanyDAO as IntfCompanyDAO;
use DAO\Connection as Connection;
use Exception;
use Models\Company;

class CompanyDAO implements IntfCompanyDAO
{

	private $tableName = "companies";
	/**
	 * @var \DAO\Connection|null
	 */
	private $connection;

	public function getAll()
	{
		$companiesList = array();
		try
		{
			$query = "SELECT * FROM " . $this->tableName;
			$companiesList = $this->getCompaniesList($query, $companiesList);
		}
		catch (Exception $ex)
		{
			$this->showErrorMsg($ex);
			return null;
		}

		return $companiesList;
	}

	public function getAllActives()
	{
		$companiesList = array();
		try
		{
			$query = "SELECT * FROM " . $this->tableName . " WHERE active = 1";
			$companiesList = $this->getCompaniesList($query, $companiesList);
		}
		catch (Exception $ex)
		{
			$this->showErrorMsg($ex);
			return null;
		}

		return $companiesList;
	}

	public function add(Company $company)
	{
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
	}

	public function getByCuit($cuit)
	{
		try
		{
			$query = "SELECT * FROM " . $this->tableName . " WHERE cuit = :cuit ;";
			$connection = Connection::GetInstance();

			$parameters['cuit'] = $cuit;
			$queryResult = $connection->Execute($query, $parameters);

			$company = new Company();
			if (!empty($queryResult))
			{
				$this->createCompany($company, $queryResult[0]);
			}
			else
			{
				return null;
			}
		}
		catch (Exception $ex)
		{
			$this->showErrorMsg($ex);
			return null;
		}

		return $company;
	}

	public function getCompanyById($id)
	{
		try
		{
			$query = "SELECT * FROM " . $this->tableName . " WHERE id_company = " . $id;
			$connection = Connection::GetInstance();
			$queryResult = $connection->Execute($query);

			$company = new Company();
			if (!empty($queryResult))
			{
				$this->createCompany($company, $queryResult[0]);
			}
		}
		catch (Exception $ex)
		{
			$this->showErrorMsg($ex);
			return null;
		}

		return $company;
	}

	public function update(Company $company)
	{
		try
		{
			$query = "UPDATE " . $this->tableName .
				" SET
					name = :name,
					company_role = :company_role,
					description = :description,
					link = :link,
					img_path = :img_path,
					active = :active 
				WHERE cuit = :cuit";

			$this->connection = Connection::GetInstance();


			$parameters['name'] = $company->getName();
			$parameters['company_role'] = $company->getRole();
			$parameters['description'] = ($company->getDescription()) ?: "";
			$parameters['link'] = ($company->getLink()) ?: "";
			$parameters['active'] = ($company->getActive()) ? 1 : 0;
			$parameters['cuit'] = $company->getCuit();
			$parameters['img_path'] = $company->getImg_path();

			$connection = Connection::GetInstance();

			$connection->ExecuteNonQuery($query, $parameters);
		}
		catch (Exception $ex)
		{
			$this->showErrorMsg($ex);
			return null;
		}
	}

	public function delete($cuit)
	{
		try
		{
			$query = "DELETE FROM " . $this->tableName . " WHERE cuit = :cuit";
			$parameters['cuit'] = $cuit;

			$this->connection = Connection::GetInstance();
			$connection = Connection::GetInstance();
			$connection->ExecuteNonQuery($query, $parameters);
		}
		catch (Exception $ex)
		{
			$this->showErrorMsg($ex);
			return null;
		}
	}

	private function getCompaniesList($query, array $companiesList)
	{
		$connection = Connection::GetInstance();

		$queryResult = $connection->Execute($query);

		foreach ($queryResult as $element)
		{

			$company = new Company();

			$company->setId($element['id_company']);
			$company->setName($element['name']);
			$company->setCuit((int)$element['cuit']);
			$company->setRole($element['company_role']);
			$company->setDescription($element['description']);
			$company->setLink($element['link']);
			$company->setActive(!($element['active'] === "0"));

			array_push($companiesList, $company);
		}
		return $companiesList;
	}

	/**
	 * @param Company $company
	 * @param $queryResult
	 */
	private function createCompany(Company $company, $queryResult)
	{
		$company->setId($queryResult['id_company']);
		$company->setName($queryResult['name']);
		$company->setCuit((int)$queryResult['cuit']);
		$company->setRole($queryResult['company_role']);
		$company->setDescription($queryResult['description']);
		$company->setLink($queryResult['link']);
		$company->setActive(($queryResult['active'] !== "0") ? true : false);
		$company->setImg_path($queryResult['img_path']);
	}

	public function getById($id)
	{
		try
		{
			$query = "SELECT * FROM " . $this->tableName . " WHERE id_company = " . $id;
			$connection = Connection::GetInstance();
			$queryResult = $connection->Execute($query);

			$company = new Company();
			if (!empty($queryResult))
			{
				$this->createCompany($company, $queryResult[0]);
			}
		}
		catch (Exception $ex)
		{
			$this->showErrorMsg($ex);
			return null;
		}

		return $company;
	}

	public function getNameById($id)
	{

		$companyName = "null";

		try
		{
			$query = "SELECT name FROM " . $this->tableName . " WHERE id_company = " . $id;
			$connection = Connection::GetInstance();
			$queryResult = $connection->Execute($query);

			if (!empty($queryResult))
			{
				$companyName = $queryResult[0]['name'];
			}
		}
		catch (Exception $ex)
		{
			$this->showErrorMsg($ex);
		}

		return $companyName;
	}

	private function showErrorMsg(Exception $ex)
	{
		echo '<script>console.log("Hubo un problema con la base de datos' . $ex->getMessage() . '"); </script>';
	}
}
