<?php

namespace Models;

class JobOffer {

	private $id_jobOffer;
	private $title;
	private $publicationDate;
	private $remote;
	private $description;
	private $career;
	private $jobPosition;
	private $active;
	private $id_company;

	/**
	 * @return mixed
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param mixed $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	public function __construct() {
	}

	/**
	 * @return mixed
	 */
	public function getPublicationDate() {
		return $this->publicationDate;
	}

	/**
	 * @param mixed $publicationDate
	 */
	public function setPublicationDate($publicationDate) {
		$this->publicationDate = $publicationDate;
	}

	/**
	 * @return mixed
	 */
	public function getRemote() {
		return $this->remote;
	}

	/**
	 * @param mixed $remote
	 */
	public function setRemote($remote) {
		$this->remote = $remote;
	}

	/**
	 * @return mixed
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param mixed $description
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * @return mixed
	 */
	public function getCareer() {
		return $this->career;
	}

	/**
	 * @param mixed $career
	 */
	public function setCareer($career) {
		$this->career = $career;
	}

	/**
	 * @return mixed
	 */
	public function getJobPosition() {
		return $this->jobPosition;
	}

	/**
	 * @param mixed $jobPosition
	 */
	public function setJobPosition($jobPosition) {
		$this->jobPosition = $jobPosition;
	}

	/**
	 * @return mixed
	 */
	public function getActive() {
		return $this->active;
	}

	/**
	 * @param mixed $active
	 */
	public function setActive($active) {
		$this->active = $active;
	}

	public function getId_jobOffer() {
		return $this->id_jobOffer;
	}

	public function setId_jobOffer($id_jobOffer) {
		$this->id_jobOffer = $id_jobOffer;
	}

	public function getId_company() {
		return $this->id_company;
	}

	public function setId_company($id_company) {
		$this->id_company = $id_company;
	}
}
