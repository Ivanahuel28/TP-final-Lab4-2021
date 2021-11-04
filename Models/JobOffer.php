<?php

namespace Models;

class JobOffer {

	private $id_jobOffer;
	private $title;
	private $remote;
	private $description;
	private $career;
	private $jobPosition;
	private $active;
	private $id_company;

	public function __construct() {
	}

	public function getId_jobOffer() {
		return $this->id_jobOffer;
	}

	public function setId_jobOffer($id_jobOffer) {
		$this->id_jobOffer = $id_jobOffer;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function getRemote() {
		return $this->remote;
	}

	public function setRemote($remote) {
		$this->remote = $remote;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function getCareer() {
		return $this->career;
	}

	public function setCareer($career) {
		$this->career = $career;
	}

	public function getJobPosition() {
		return $this->jobPosition;
	}

	public function setJobPosition($jobPosition) {
		$this->jobPosition = $jobPosition;
	}

	public function getActive() {
		return $this->active;
	}

	public function setActive($active) {
		$this->active = $active;
	}

	public function getId_company() {
		return $this->id_company;
	}

	public function setId_company($id_company) {
		$this->id_company = $id_company;
	}
}
