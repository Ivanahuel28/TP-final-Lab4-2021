<?php

namespace DAO;

use DAO\IntfApplicationDAO;
use Exception;
use Models\Application;

class ApplicationDAO implements IntfApplicationDAO
{

    private $tableName = "applications";

    private $connection;

    public function __construct()
    {
    }

    public function add(Application $application)
    {

        /* try
        { */
        $query = 'INSERT INTO ' . $this->tableName .
            ' (id_user,id_job_offer,application_datetime,file_path) VALUES (:id_user,:id_job_offer,:application_datetime,:file_path);';

        $parameters['id_user'] = $application->getId_user();
        $parameters['id_job_offer'] = $application->getId_jobOffer();
        $parameters['application_datetime'] = $application->getDate();
        $parameters['file_path'] = $application->getFilePath();

        $this->connection = Connection::GetInstance();

        $this->connection->ExecuteNonQuery($query, $parameters);

        return true;
        /* }
        catch (Exception $ex)
        {
            return false;
        } */
    }

    public function getId(Application $application)
    {

        try
        {
            $query = "SELECT id_application FROM " . $this->tableName . " WHERE id_job_offer = :id_job_offer AND id_user = :id_user ;";
            $connection = Connection::GetInstance();

            $parameters['id_job_offer'] = $application->getId_jobOffer();
            $parameters['id_user'] = $application->getId_user();

            $queryResult = $connection->Execute($query, $parameters);

            if (!empty($queryResult))
            {
                return $queryResult[0]; // <--------- return 
            }
        }
        catch (Exception $ex)
        {

            return null;
        }
    }

    public function getApplyListByJobOffer($id_jobOffer)
    {

        $applicationList = array();
        $query = "SELECT * FROM " . $this->tableName . ' WHERE id_job_offer = :id_job_offer';
        $connection = Connection::GetInstance();

        $parameters['id_job_offer'] = $id_jobOffer;
        $queryResult = $connection->Execute($query, $parameters);

        if ($queryResult)
        {
            foreach ($queryResult as $queryResult)
            {

                $application = new Application();

                $application->setId_application((int)$queryResult['id_application']);
                $application->setId_user((int)$queryResult['id_user']);
                $application->setId_jobOffer((int)$queryResult['id_job_offer']);
                $application->setDate($queryResult['application_datetime']);
                $application->setFilePath($queryResult['file_path']);

                array_push($applicationList, $application);
            }
        }


        return $applicationList;
    }
}
