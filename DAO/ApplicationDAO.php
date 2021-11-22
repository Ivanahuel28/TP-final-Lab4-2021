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

    private $userDAO;


    public function __construct()
    {
        $this->userDAO = new UserDAO();
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

    public function getEmailsByJobOfferId($id_jobOffer)
    {
        try
        {
            $query = "SELECT id_user FROM " . $this->tableName . ' WHERE id_job_offer = :id_job_offer';
            $connection = Connection::GetInstance();
            $parameters['id_job_offer'] = $id_jobOffer;
            $queryResult = $connection->Execute($query, $parameters);
            
            $idList = array();
            if ($queryResult)
            {
                foreach ($queryResult as $row)
                {
                    array_push($idList, (int)$row['id_user']);
                }
            }

            if ($idList) {
                $emails = $this->userDAO->getUsernamesByIdList($idList);
                
            } else {
                return null;
            }
            

        }
        catch(Exception $e){
            $emails = null;
        }

        return $emails;
    }
}
