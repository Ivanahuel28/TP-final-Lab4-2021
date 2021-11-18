<?php

namespace DAO;

use DAO\IntfApplicationDAO;
use Exception;
use Models\Application;
use Models\Student;

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


    public function getApplicationsByUser(Student $student){

        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE id_user = :id_user ;";
            $connection = Connection::GetInstance();

            $parameters['id_user'] = $student->getId();

            $queryResult = $connection->Execute($query,$parameters);

            if (!empty($queryResult)) {
                return $queryResult[0]; // <--------- return
            }
        } catch (Exception $ex) {
            return null;
        }
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
            foreach ($queryResult as $row)
            {

                $application = new Application();

                $application->setId_application((int)$row['id_application']);
                $application->setId_user((int)$row['id_user']);
                $application->setId_jobOffer((int)$row['id_job_offer']);
                $application->setDate($row['application_datetime']);
                $application->setFilePath($row['file_path']);

                array_push($applicationList, $application);
            }
        }


        return $applicationList;
    }
}
