<?php

namespace Models;

class Career {
	private $id_career;
	private $description;
	private $active;

	public function __construct() {
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

	public function getActive() {
		return $this->active;
	}

	public function setActive($active) {
		$this->active = $active;
	}
}
