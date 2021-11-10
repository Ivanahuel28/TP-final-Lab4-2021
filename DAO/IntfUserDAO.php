<?php

namespace DAO;

interface IntfUserDAO {

	public function getUser($username, $password);
	public function userIsRegistrated($username);
	public function createUser($username, $password, $isStudent,  $securityAnswer);
}
