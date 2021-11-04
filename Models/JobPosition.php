<?php

namespace Models;

class JobPosition {

	private $id_jobPosition;
	private $id_career;
	private $description;

	public function __construct() {
	}

	public function getId_jobPosition() {
		return $this->id_jobPosition;
	}

	public function setId_jobPosition($id_jobPosition) {
		$this->id_jobPosition = $id_jobPosition;
	}

	public function getId_career() {
		return $this->id_career;
	}

	public function setId_career($id_career) {
		$this->id_career = $id_career;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setDescription($description) {
		$this->description = $description;
	}
}
