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

        foreach ($queryResult as $element)
        {

            $jobOffer = new JobOffer();

            $jobOffer->setTitle($element['title']);
            $jobOffer->setRemote($element['remote']);
            $jobOffer->setDescription($element['description']);
            $jobOffer->setActive($element['active']);
            $jobOffer->setId_career($element['id_career']);
            $jobOffer->setId_company($element['id_company']);
            $jobOffer->setId_jobPosition(!($element['id_job_position'] === "0"));

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

    private function showErrorMsg(Exception $ex)
    {
        echo '<script>console.log("Hubo un problema con la base de datos' . $ex->getMessage() . '"); </script>';
    }
}
