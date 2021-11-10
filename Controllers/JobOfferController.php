<?php

namespace Controllers;

use DAO\CareerDAO;
use DAO\CompanyDAO as CompanyDAO;
use DAO\JobOfferDAO;
use DAO\JobPositionDAO;
use Models\Company;
use Models\JobOffer;
use Models\JobPosition;

class JobOfferController
{
    private $jobOfferDAO;
    private $companyDAO;
    private $careerDAO;
    private $jobPositionDAO;

    public function __construct()
    {
        $this->jobOfferDAO = new JobOfferDAO();
        $this->companyDAO = new CompanyDAO();
        $this->careerDAO = new CareerDAO();
        $this->jobPositionDAO = new JobPositionDAO();
    }

    public function requestAddNew($id_company, $id_career, $id_jobPosition, $title, $description, $isRemote = "", $active = "")
    {

        $jobOffer = $this->jobOfferFactory((int)$id_company, (int)$id_career,(int) $id_jobPosition, $title, $description, $isRemote, $active);

        if (!$this->jobOfferDAO->find($jobOffer))
        {
            $this->jobOfferDAO->addOffer($jobOffer);
            $this->printSuccessfullyAdded();
        }
        else
        {
            $this->printAlertAlreadyExist();
        }

        $this->renderJobOfferList();
    }

    public function renderView_Create_FirstStep()
    {

        $companiesList = $this->companyDAO->getAllActives();

        $careersList = $this->careerDAO->getAllActives();

        require_once(VIEWS_PATH . 'job-offer-create-first-step.php');
    }

    public function renderView_Create_FinalStep($id_company, $id_career)
    {

        $company = $this->companyDAO->getById((float)$id_company);
        $career = $this->careerDAO->getById((int)$id_career);

        $jobPositionList = $this->jobPositionDAO->getAllByCareerId((int)$id_career);

        require_once(VIEWS_PATH . 'job-offer-create-final-step.php');
    }

    public function renderJobOfferList()
    {

        $jobOfferList = $this->jobOfferDAO->getAll();

		if (isset($jobOfferList)) {
			foreach ($jobOfferList as $jobOffer) {

                $company = new Company();
                $company = $this->companyDAO->getById($jobOffer->getId_company());

                $jobPosition = new JobPosition();
                $jobPosition = $this->jobPositionDAO->getById($jobOffer->getId_jobPosition());

				$list[$jobOffer->getId_jobOffer()] = array(
					'title' => $jobOffer->getTitle(),
					'companyName' => $company->getName(),
                    'jobPositionTitle' => $jobPosition->getDescription()
				);
			}
		}

        require_once(VIEWS_PATH . 'job-offer-list.php');
    }

    public function studentRequestJobOfferDetails($id_jobOffer){

        $jobOffer = new JobOffer();

        $jobOffer = $this->jobOfferDAO->getById($id_jobOffer);

        $companyName = $this->companyDAO->getNameById($jobOffer->getId_company());

        $jobPosition = $this->jobPositionDAO->getTitleById($jobOffer->getId_jobPosition());

        require_once(VIEWS_PATH.'job-offer-detail.php');
    }

    private function jobOfferFactory($id_company, $id_career, $id_jobPosition, $title, $description, $isRemote, $active)
    {

        $jobOffer = new JobOffer();

        $jobOffer->setId_company((int)$id_company);
        $jobOffer->setId_career((int)$id_career);
        $jobOffer->setId_jobPosition((int)$id_jobPosition);

        $jobOffer->setTitle($title);
        $jobOffer->setDescription($description);

        $jobOffer->setRemote($isRemote === "true");
        $jobOffer->setActive($active === "true");

        $jobOffer->setCreationDate(date('Y-m-d H:i:s'));

        return $jobOffer;
    }

    private function printAlertAlreadyExist()
    {
        echo '
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			 <strong>Ups!</strong>  Ya existe una Oferta Laboral para esa empresa y posicion 
			 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	  	</div>';
    }

    private function printSuccessfullyAdded()
    {
        echo '
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			 <strong>Felicidades!</strong>  Oferta laboral creada con exito :)
			 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	  	</div>';
    }
}
