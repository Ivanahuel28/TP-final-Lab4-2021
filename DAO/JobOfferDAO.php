<?php

namespace DAO;

use Models\JobOffer;

class JobOfferDAO
{

    private $tableName = "job_offers";

    public function addOffer(JobOffer $jobOffer, $companyCuit)
    {

        try {
            $query = "INSERT INTO " . $this->tableName .
                " (publication_date, remote, description, career, job_position, active, title, id_company)
			  VALUES (:publication_date, :remote, :description,:career,:job_position,:active, :title), :id_company;";

            $parameters['publication_date'] = $jobOffer->getPublicationDate();
            $parameters['remote'] = $jobOffer->getRemote();
            $parameters['description'] = $jobOffer->getDescription();
            $parameters['career'] = $jobOffer->getCareer();
            $parameters['job_position'] = $jobOffer->getJobPosition();
            $parameters['active'] = $jobOffer->getActive();
            $parameters['title'] = $jobOffer->getTitle();
            $parameters['id_company'] = $companyCuit;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            echo '<script>console.log("Hubo un problema con la base de datos' . $ex->getMessage() . '"); </script>';
            return null;
        }
    }


}