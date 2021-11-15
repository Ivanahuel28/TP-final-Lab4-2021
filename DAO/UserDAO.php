<?php

namespace DAO;

use DAO\IntfUserDAO as IntfUserDAO;
use DAO\Connection as Connection;
use Models\User;

class UserDAO implements IntfUserDAO
{

    private $tableName = "users";

    public function getUser($username, $password)
    {
        $user = new User();
        //SELECT user_type FROM users u WHERE u.username = 'admin' AND u.password = '123';

        $query = "SELECT * FROM " . $this->tableName . " WHERE username = :username";
        $parameters['username'] = $username;
        $connection = Connection::GetInstance();
        $queryResult = $connection->Execute($query, $parameters);
        if ($queryResult && password_verify($password, $queryResult[0]['password'])) {
            $user->setId($queryResult[0]['id_user']);
            $user->setUsername($queryResult[0]['username']);
            $user->setPassword($password);
            $user->setUserType($queryResult[0]['user_type']);
        }
        return $user;
    }

    public function userIsRegistrated($username)
    {
        $user = new User();
        //SELECT user_type FROM users u WHERE u.username = 'admin' AND u.password = '123';

        $query = "SELECT * FROM " . $this->tableName . " WHERE username = :username";
        $parameters['username'] = $username;
        $connection = Connection::GetInstance();
        $queryResult = $connection->Execute($query, $parameters);
        return (bool)$queryResult;
    }

    public function securityAnswerMatch($username, $securityAnswer)
    {
        $query = "SELECT * FROM " . $this->tableName . " WHERE security_answer = :security_answer AND username = :username";
        $parameters['security_answer'] = $securityAnswer;
        $parameters['username'] = $username;
        $connection = Connection::GetInstance();
        $queryResult = $connection->Execute($query, $parameters);
        return (bool)$queryResult;
    }

    public function createUser($username, $password, $userType, $securityAnswer)
    {
        $user = new User();
        $query = "INSERT INTO " . $this->tableName . " (username,password,user_type, security_answer)
             VALUES (:username,:password,:user_type, :security_answer);";
        $connection = Connection::GetInstance();
        $parameters['username'] = $username;
        $parameters['password'] = password_hash($password, PASSWORD_DEFAULT);
        $parameters['user_type'] = $userType;
        $parameters['security_answer'] = $securityAnswer;

        $queryResult = $connection->ExecuteNonQuery($query, $parameters);
        if ($queryResult) {
            $user = $this->getUser($username, $password);
        }
        return $user;
    }

    public function updateUserPassword($username, $password)
    {
        $user = new User();
        $query = "UPDATE " . $this->tableName . " SET password = :password 
             WHERE username = :username";
        $connection = Connection::GetInstance();
        $parameters['username'] = $username;
        $parameters['password'] = password_hash($password, PASSWORD_DEFAULT);

        $queryResult = $connection->ExecuteNonQuery($query, $parameters);
        if ($queryResult) {
            $user = $this->getUser($username, $password);
        }
        return $user;
    }
}
