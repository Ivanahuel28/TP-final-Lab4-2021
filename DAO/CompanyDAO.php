<?php

namespace DAO;

use DAO\IntfCompanyDAO as IntfCompanyDAO;
use DAO\Connection as Connection;
use Exception;
use Models\Company;

class CompanyDAO implements IntfCompanyDAO
{

    //private $companiesList;
    private $tableName = "companies";

    public function __construct()
    {
        $this->companiesList = array();
    }

    public function getAll()
    {
        $companiesList = array();
        try {
            $query = "SELECT * FROM " . $this->tableName;
            $companiesList = $this->getCompaniesList($query, $companiesList);
        } catch (Exception $ex) {
            echo '<script>console.log("Hubo un problema con la base de datos' . $ex->getMessage() . '"); </script>';
            return null;
        }

        return $companiesList;
    }

    public function getAllActives()
    {
        $companiesList = array();
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE active = 1";
            $companiesList = $this->getCompaniesList($query, $companiesList);
        } catch (Exception $ex) {
            echo '<script>console.log("Hubo un problema con la base de datos' . $ex->getMessage() . '"); </script>';
            return null;
        }

        return $companiesList;
    }

    public function add(Company $company)
    {

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
            echo '<script>console.log("Hubo un problema con la base de datos' . $ex->getMessage() . '"); </script>';
            return null;
        }
    }

    public function getByCuit($cuit)
    {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE cuit = " . $cuit;
            $connection = Connection::GetInstance();
            $queryResult = $connection->Execute($query);

            $company = new Company();
            if (!empty($queryResult)) {
                $this->createCompany($company, $queryResult[0]);
            }
        } catch (Exception $ex) {
            echo '<script>console.log("Hubo un problema con la base de datos' . $ex->getMessage() . '"); </script>';
            return null;
        }

        return $company;
    }

    public function update(Company $company)
    {

        /* UPDATE utnjobs.companies
        SET description='11111111',company_role='asd'
        WHERE id_company=1; */

        try {
            $query = "UPDATE " . $this->tableName .
                " SET
					name = :name,
					company_role = :company_role,
					description = :description,
					link = :link,
					active = :active 
				WHERE id_company = :id";

            $this->connection = Connection::GetInstance();


            $parameters['name'] = $company->getName();
            $parameters['company_role'] = $company->getRole();
            $parameters['description'] = ($company->getDescription()) ?: "";
            $parameters['link'] = ($company->getLink()) ?: "";
            $parameters['active'] = ($company->getActive()) ? 1 : 0;
            $parameters['id'] = $company->getId();

            $connection = Connection::GetInstance();

            $connection->ExecuteNonQuery($query, $parameters);


        } catch (Exception $ex) {
            echo '<script>console.log("Hubo un problema con la base de datos' . $ex->getMessage() . '"); </script>';
            return null;
        }
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

    private function getIndexByCuit($cuit)
    {

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
    /**
     * @param $query
     * @param array $companiesList
     * @return array
     * @throws Exception
     */
    private function getCompaniesList($query, array $companiesList)
    {
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
        $company->setActive(!($queryResult['active'] == "0"));
    }
}
