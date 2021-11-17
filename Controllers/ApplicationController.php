<?php

namespace Controllers;

use DAO\ApplicationDAO;
use DAO\CompanyDAO as CompanyDAO;
use DAO\JobOfferDAO;
use Models\Company as Company;
use FFI\Exception;

class ApplicationController
{

    private $companyDAO;
    private $jobOfferDAO;
    private $applicationDAO;

    public function __construct()
    {
        $this->companyDAO = new CompanyDAO();
        $this->jobOfferDAO = new JobOfferDAO();
        $this->applicationDAO = new ApplicationDAO();
    }

    public function executeDownloadApplicants($id_jobOffer)
    {
        $applicationList = $this->applicationDAO->getApplyListByJobOffer((int)$id_jobOffer);

        

        foreach ($applicationList as $application) {
            
        }

        $controller = new JobOfferController();
        $controller->adminRequestJobOfferDetails("1");

    }

    public function download(){
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
}
