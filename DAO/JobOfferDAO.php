<?php

namespace DAO;

use DAO\CompanyDAO as CompanyDAO;
use FFI\Exception;
use Models\Company;
use Models\JobOffer;

class JobOfferDAO implements IntfJobOfferDAO
{

    private $tableName = "job_offers";
    private $companyDAO;
    private $careerDAO;
    private $jobPositionDAO;
    public function __construct()
    {
        $this->companyDAO = new CompanyDAO();
        $this->careerDAO = new CareerDAO();
        $this->jobPositionDAO = new JobPositionDAO();
    }
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
            $query = "SELECT * FROM " . $this->tableName . " WHERE id_company = :id_company AND id_job_position = :id_job_position ";

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

    public function downloadOffer()
    {
        $connect = mysqli_connect("localhost", "root", "", "utnjobs");
        $output = '';
        $query = "SELECT * FROM " . $this->tableName;
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) > 0)
        {
            $output .= '
        <table class="table" bordered="1">  
                    <tr>  
                         <th>Title</th>  
                         <th>Remote</th>  
                         <th>Description</th>  
                        <th>Active</th>
                        <th>Creation Date</th>
                        <th>Company Name</th>
                        <th>Carrera</th>
                        <th>Posicion de Trabajo</th>
                    </tr>
            ';
            while ($row = mysqli_fetch_array($result))
            {
                $remote = $row["remote"] == '1' ? 'Yes' : 'No';
                $active = $row["active"] == '1' ? 'Active' : 'Inactive';
                $company = $this->companyDAO->getCompanyById($row["id_company"]);
                $career = $this->careerDAO->getById($row["id_career"]);
                $jobPosition = $this->jobPositionDAO->getById($row["id_job_position"]);
                $output .= '
                    <tr>  
                         <td>' . $row["title"] . '</td>  
                         <td>' . $remote  . '</td>  
                         <td>' . $row["description"] . '</td>  
                        <td>' . $active . '</td>  
                        <td>' . $row["creation_date"] . '</td>
                        <td>' . $company->getName() . '</td>
                        <td>' . $career->getDescription() . '</td>
                        <td>' . $jobPosition->getDescription() . '</td>
                    </tr>
            ';
            }
            $output .= '</table>';
            header('Content-Type: application/xls');
            header('Content-Disposition: attachment; filename=utn-job-offers.xls');
            echo $output;
        }
        else
        {
            echo '
               <div class="alert alert-warning alert-dismissible fade show" role="alert">
			 No hay ofertas que descargar.
			 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	  	    </div>';
        }
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

    public function update(JobOffer $jobOffer){

        try{

            $query = "UPDATE " . $this->tableName .
                    " SET
                        title = :title,
                        description = :description,
                        remote = :remote,
                        active = :active 
                    WHERE id_job_offer = :id_job_offer";
    
            $parameters['id_job_offer'] = $jobOffer->getId_jobOffer();
            $parameters['title'] = $jobOffer->getTitle();
            $parameters['description'] = $jobOffer->getDescription();
            $parameters['remote'] = $jobOffer->getRemote();
            $parameters['active'] = $jobOffer->getActive();
    
            $connection = Connection::GetInstance();
    
            $connection->ExecuteNonQuery($query, $parameters);

            return true;
        }
        catch(Exception $ex)
        {
            return false;
        }

    }

    private function showErrorMsg(Exception $ex)
    {
        echo '<script>console.log("Hubo un problema con la base de datos' . $ex->getMessage() . '"); </script>';
    }
}
