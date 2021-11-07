<?php

namespace Controllers;

use DAO\CareerDAO;
use DAO\CompanyDAO as CompanyDAO;
use DAO\JobOfferDAO;
use DAO\JobPositionDAO;
use Models\JobOffer;

class JobOfferController {
	private $jobOfferDAO;
	private $companyDAO;
	private $careerDAO;
	private $jobPositionDAO;

	public function __construct() {
		$this->jobOfferDAO = new JobOfferDAO();
		$this->companyDAO = new CompanyDAO();
		$this->careerDAO = new CareerDAO();
		$this->jobPositionDAO = new JobPositionDAO();
	}

	public function requestAddNew($id_company,$id_career,$id_jobPosition ,$title ,$description,$isRemote = "",$active = "") {

		$jobOffer = new JobOffer();

		$jobOffer->setId_company((int)$id_company);
		$jobOffer->setId_career((int)$id_career);
		$jobOffer->setId_jobPosition((int)$id_jobPosition);
		
		$jobOffer->setTitle($title);
		$jobOffer->setDescription($description);

		$jobOffer->setRemote($isRemote === "true");
		$jobOffer->setActive($active === "true");

		$this->jobOfferDAO->addOffer($jobOffer);

		$this->renderJobOfferList();
		
	}

	public function renderView_Create_FirstStep() {

		$companiesList = $this->companyDAO->getAllActives();

		$careersList = $this->careerDAO->getAllActives();

		require_once(VIEWS_PATH . 'job-offer-create-first-step.php');
	}

	public function renderView_Create_FinalStep($id_company,$id_career) {

		/* echo $id_company . $id_career ;

		var_dump((int)$id_company);
		var_dump($id_career); */

		$company = $this->companyDAO->getById((float)$id_company);
		$career = $this->careerDAO->getById((int)$id_career);

		$jobPositionList = $this->jobPositionDAO->getAll();

		require_once(VIEWS_PATH . 'job-offer-create-final-step.php');
	}

	public function renderJobOfferList() {

		/* $jobOfferList = $this->jobOfferDAO->getAll();

		$companyList = $this->makeAssocArrayByCompanyId($this->companyDAO->getAll());

		if (isset($jobOfferList)) {
			foreach ($jobOfferList as $jobOffer) {

				$list[$jobOffer->getId()] = array(
					'title' => $jobOffer->getTitle(),
					'companyName' => (isset($companyList[$jobOffer->getCompanyId()])) ? $companyList[$jobOffer->getCompanyId()] : ""
				);
			}
		} */

		require_once(VIEWS_PATH . 'job-offer-list.php');
	}

	/* private function makeAssocArrayByCompanyId($companyList) {

		foreach ($companyList as $company) {

			$associatedList[$company->getId()] = $company->getName();
		}

		return $associatedList;
	}

	public function getCareersAndJobPositionsStrings() {

		$careerList = $this->careerDAO->getAll();
		$jobPositionList = $this->jobPositionDAO->getAll();
		$optionList = array();

		foreach ($careerList as $career) {

			if ($career->getActive() === true) {

				foreach ($jobPositionList as $jobPosition) {

					if ($jobPosition->getId_Career() === $career->getId_Career()) {
						array_push($optionList, $career->getDescription() . " - " . $jobPosition->getDescription());
					}
				}
			}
		}

		return $optionList;
	} */

	/* private function offerFactory($career, $description, $jobPosition, $isRemote, $title) {
		$jobOffer = new JobOffer();
		$jobOffer->setActive(true);
		$jobOffer->setCareer($career);
		$jobOffer->setDescription($description);
		$jobOffer->setJobPosition($jobPosition);
		$jobOffer->setRemote($isRemote);
		$jobOffer->setTitle($title);
		return $jobOffer;
	} */
}
