<?php

namespace DAO;

use FFI\Exception;
use Models\Company;
use Models\JobOffer;

class JobOfferDAO implements IntfJobOfferDAO
{

    private $tableName = "job_offers";

    public function addOffer(JobOffer $jobOffer)
    {
        $query = "INSERT INTO " . $this->tableName .
            " (id_job_position,id_company,id_career,title,description,remote,active,creation_date)
			  VALUES (:id_job_position,:id_company,:id_career,:title,:description,:remote,:active,:creation_date);";

        $parameters['id_job_position'] = $jobOffer->getId_jobPosition();
        $parameters['id_company'] = $jobOffer->getId_company();
        $parameters['id_career'] = $jobOffer->getId_career();
        $parameters['title'] = $jobOffer->getTitle();
        $parameters['description'] = $jobOffer->getDescription();
        $parameters['remote'] = $jobOffer->getRemote();
        $parameters['active'] = $jobOffer->getActive();
        $parameters['creation_date'] = $jobOffer->getCreationDate();

        $connection = Connection::GetInstance();

        $connection->ExecuteNonQuery($query, $parameters);
    }

    public function getAll()
    {
        $jobsList = array();
        $query = "SELECT * FROM " . $this->tableName;
        $connection = Connection::GetInstance();
        $queryResult = $connection->Execute($query);

        foreach ($queryResult as $queryResult)
        {

            $jobOffer = new JobOffer();

            $jobOffer->setId_jobOffer($queryResult['id_job_offer']);
            $jobOffer->setId_jobPosition((int)$queryResult['id_job_position']);
            $jobOffer->setId_company((int)$queryResult['id_company']);
            $jobOffer->setId_career((int)$queryResult['id_career']);
            $jobOffer->setTitle($queryResult['title']);
            $jobOffer->setDescription($queryResult['description']);
            $jobOffer->setCreationDate($queryResult['creation_date']);
            $jobOffer->setRemote(($queryResult['remote'] !== "0") ? true : false);
            $jobOffer->setActive(($queryResult['active'] !== "0") ? true : false);

            array_push($jobsList, $jobOffer);
        }
        return $jobsList;
    }

    public function find(JobOffer $jobOffer)
    {
        try
        {
            $query = "SELECT * FROM " . $this->tableName . " WHERE id_company = :id_company AND id_job_position = :id_job_position ;";

            $parameters['id_company'] = $jobOffer->getId_company();
            $parameters['id_job_position'] = $jobOffer->getId_jobPosition();

            $connection = Connection::GetInstance();

            $queryResult = $connection->Execute($query, $parameters);
        }
        catch (Exception $ex)
        {
            $this->showErrorMsg($ex);
            return null;
        }

        return $queryResult;
    }

    public function getAllActivesByCareer($id_career)
    {
        $jobsList = array();
        $query = "SELECT * FROM " . $this->tableName . ' WHERE id_career = :id_career AND active = 1 ;';
        $connection = Connection::GetInstance();

        $parameters['id_career'] = $id_career;
        $queryResult = $connection->Execute($query, $parameters);

        foreach ($queryResult as $queryResult)
        {

            $jobOffer = new JobOffer();

            

            $jobOffer->setId_jobOffer((int)$queryResult['id_job_offer']);
            $jobOffer->setId_jobPosition((int)$queryResult['id_job_position']);
            $jobOffer->setId_company((int)$queryResult['id_company']);
            $jobOffer->setId_career((int)$queryResult['id_career']);
            $jobOffer->setTitle($queryResult['title']);
            $jobOffer->setDescription($queryResult['description']);
            $jobOffer->setCreationDate($queryResult['creation_date']);
            $jobOffer->setRemote(($queryResult['remote'] !== "0") ? true : false);
            $jobOffer->setActive(($queryResult['active'] !== "0") ? true : false);

            array_push($jobsList, $jobOffer);
        }
        return $jobsList;
    }

    public function getById($id)
    {
        try
        {
            $query = "SELECT * FROM " . $this->tableName . " WHERE id_job_offer = " . $id;
            $connection = Connection::GetInstance();
            $queryResult = $connection->Execute($query);

            $jobOffer = new JobOffer();
            if (!empty($queryResult))
            {
                $this->createJobOffer($jobOffer, $queryResult[0]);
            }
        }
        catch (Exception $ex)
        {
            $this->showErrorMsg($ex);
            return null;
        }

        return $jobOffer;
    }

    private function createJobOffer($jobOffer, $queryResult)
    {

        $jobOffer->setId_jobOffer($queryResult['id_job_offer']);
        $jobOffer->setId_jobPosition((int)$queryResult['id_job_position']);
        $jobOffer->setId_company((int)$queryResult['id_company']);
        $jobOffer->setId_career((int)$queryResult['id_career']);
        $jobOffer->setTitle($queryResult['title']);
        $jobOffer->setDescription($queryResult['description']);
        $jobOffer->setCreationDate($queryResult['creation_date']);
        $jobOffer->setRemote(($queryResult['remote'] !== "0") ? true : false);
        $jobOffer->setActive(($queryResult['active'] !== "0") ? true : false);
    }
    private function showErrorMsg(Exception $ex)
    {
        echo '<script>console.log("Hubo un problema con la base de datos' . $ex->getMessage() . '"); </script>';
    }
}
