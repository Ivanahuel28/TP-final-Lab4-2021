<?php

namespace Models;

class User {

	private $id;
	private $username;
	private $password;
	private $userType;
	private $securityAnswer;

    /**
     * @return mixed
     */
    public function getSecurityAnswer()
    {
        return $this->securityAnswer;
    }

    /**
     * @param mixed $securityAnswer
     */
    public function setSecurityAnswer($securityAnswer)
    {
        $this->securityAnswer = $securityAnswer;
    }

	public function __construct() {
	}

	public function getUsername() {
		return $this->username;
	}

	public function setUsername($username) {
		$this->username = $username;
	}

	public function getPassword() {
		return $this->password;
	}

	public function setPassword($password) {
		$this->password = $password;
	}

	public function getUserType() {
		return $this->userType;
	}

	public function setUserType($userType) {
		$this->userType = $userType;
	}

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}
}
