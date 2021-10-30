<?php

namespace DAO;

use DAO\IntfUserDAO as IntfUserDAO;
use DAO\Connection as Connection;
use FFI\Exception as Exception;
use Models\User;

class UserDAO implements IntfUserDAO {

	private $connection;
	private $tableName = "users";

	public function getUser($username, $password) {

		//SELECT user_type FROM users u WHERE u.username = 'admin' AND u.password = '123';
		try {
			$query = "SELECT * FROM " . $this->tableName . " WHERE username = :username AND password = :password";

			$parameters['username'] = $username;
			$parameters['password'] = $password;

			$this->connection = Connection::GetInstance();

			$queryResult = $this->connection->Execute($query, $parameters);

			$user = new User();

			if ($queryResult) {

				$user->setId($queryResult[0]['id_user']);
				$user->setUsername($queryResult[0]['username']);
				$user->setPassword($queryResult[0]['password']);
				$user->setUserType($queryResult[0]['user_type']);
			}
		} catch (Exception $ex) {
			throw $ex;
		}

		return $user;
	}
}
