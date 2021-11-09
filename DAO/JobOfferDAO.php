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
            " (id_job_position,id_company,id_career,title,description,remote,active)
			  VALUES (:id_job_position,:id_company,:id_career,:title,:description,:remote,:active);";

        $parameters['id_job_position'] = $jobOffer->getId_jobPosition();
        $parameters['id_company'] = $jobOffer->getId_company();
        $parameters['id_career'] = $jobOffer->getId_career();
        $parameters['title'] = $jobOffer->getTitle();
        $parameters['description'] = $jobOffer->getDescription();
        $parameters['remote'] = $jobOffer->getRemote();
        $parameters['active'] = $jobOffer->getActive();

        $connection = Connection::GetInstance();

        $connection->ExecuteNonQuery($query, $parameters);
    }

    public function getAll()
    {
        $jobsList = array();
        $query = "SELECT * FROM " . $this->tableName;
        $connection = Connection::GetInstance();
        $queryResult = $connection->Execute($query);

        foreach ($queryResult as $element) {

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

}
