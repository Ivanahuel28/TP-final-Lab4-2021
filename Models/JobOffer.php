<?php

namespace Models;

class JobOffer {

	private $id_jobOffer;
	private $id_jobPosition;
	private $id_company;
	private $id_career;
	private $title;
	private $description;
	private $remote;
	private $active;
	private $creationDate;

	public function __construct() {
	}

	public function getId_jobOffer() {
		return $this->id_jobOffer;
	}

	public function setId_jobOffer($id_jobOffer) {
		$this->id_jobOffer = $id_jobOffer;
	}

	public function getId_jobPosition() {
		return $this->id_jobPosition;
	}

	public function setId_jobPosition($id_jobPosition) {
		$this->id_jobPosition = $id_jobPosition;
	}

	public function getId_company() {
		return $this->id_company;
	}

	public function setId_company($id_company) {
		$this->id_company = $id_company;
	}

	public function getId_career() {
		return $this->id_career;
	}

	public function setId_career($id_career) {
		$this->id_career = $id_career;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function getRemote() {
		return $this->remote;
	}

	public function setRemote($remote) {
		$this->remote = $remote;
	}

	public function getActive() {
		return $this->active;
	}

	public function setActive($active) {
		$this->active = $active;
	}

	public function getCreationDate()
	{
		return $this->creationDate;
	}
  
	public function setCreationDate($creationDate)
	{
		$this->creationDate = $creationDate;
	}
}
