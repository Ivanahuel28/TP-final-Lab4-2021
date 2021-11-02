<?php

namespace Controllers;

use DAO\CompanyDAO as CompanyDAO;
use DAO\JobOfferDAO;
use DateTime;
use Models\JobOffer;

class JobOfferController {
	private $jobOfferDAO;
	private $companyDAO;

	public function __construct() {
		$this->jobOfferDAO = new JobOfferDAO();
		$this->companyDAO = new CompanyDAO();
	}

	public function createJobOffer() {
		//TODO: call api when it's working
		require_once(VIEWS_PATH . 'job-offer-add.php');
	}


	public function add($isRemote, $description, $title, $jobPosition, $career, $companyCuit) {
		$jobOffer = $this->offerFactory($career, $description, $jobPosition, $isRemote, $title);


		$companyByCuit = $this->jobOfferDAO->addOffer($jobOffer, $companyCuit);
	}

	public function requestJobOfferList() {

		$jobOfferList = $this->jobOfferDAO->getAll();

		$associatedCompanyList = $this->getIdCompanyNameArray($this->companyDAO->getAll());

		$list = array();

		foreach ($jobOfferList as $jobOffer) {

			array_push($list, array(
				'id_jobOffer' => $jobOffer->getId_jobOffer(),
				'title' => $jobOffer->getTitle(),
				'companyName' => $associatedCompanyList[$jobOffer->getCompanyId()]
			));
		}

		/* $element =  */

		/*
		id oferta
		Titulo oferta
		Nombre empresa
		Hace cuanto se creo la oferta
		 */
	}

	private function getIdCompanyNameArray($companyList){

		foreach($companyList as $company){

			$associatedList[$company->getId()] = $company->getName();
		}

		return $associatedList;

	}





	/**
	 * @param $career
	 * @param $description
	 * @param $jobPosition
	 * @param $isRemote
	 * @param $title
	 */
	private function offerFactory($career, $description, $jobPosition, $isRemote, $title) {
		$jobOffer = new JobOffer();
		$jobOffer->setActive(true);
		$jobOffer->setCareer($career);
		$jobOffer->setDescription($description);
		$jobOffer->setJobPosition($jobPosition);
		$jobOffer->setPublicationDate(new DateTime('NOW'));
		$jobOffer->setRemote($isRemote);
		$jobOffer->setTitle($title);
		return $jobOffer;
	}
}
