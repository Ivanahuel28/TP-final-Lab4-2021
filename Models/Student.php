<?php

namespace Models;

class Student {
	
	private $id;
	private $careerId;
	private $firstname;
	private $lastname;
	private $dni;
	private $fileNumber;
	private $gender;
	private $birthDate;
	private $email;
	private $phoneNumber;
	private $active;

	public function __construct() {
	}

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getCareerId() {
		return $this->careerId;
	}

	public function setCareerId($careerId) {
		$this->careerId = $careerId;
	}

	public function getFirstname() {
		return $this->firstname;
	}

	public function setFirstname($firstname) {
		$this->firstname = $firstname;
	}

	public function getLastname() {
		return $this->lastname;
	}

	public function setLastname($lastname) {
		$this->lastname = $lastname;
	}

	public function getDni() {
		return $this->dni;
	}

	public function setDni($dni) {
		$this->dni = $dni;
	}

	public function getFileNumber() {
		return $this->fileNumber;
	}

	public function setFileNumber($fileNumber) {
		$this->fileNumber = $fileNumber;
	}

	public function getGender() {
		return $this->gender;
	}

	public function setGender($gender) {
		$this->gender = $gender;
	}

	public function getBirthDate() {
		return $this->birthDate;
	}

	public function setBirthDate($birthDate) {
		$this->birthDate = $birthDate;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function getPhoneNumber() {
		return $this->phoneNumber;
	}

	public function setPhoneNumber($phoneNumber) {
		$this->phoneNumber = $phoneNumber;
	}

	public function getActive() {
		return $this->active;
	}

	public function setActive($active) {
		$this->active = $active;
	}
}
