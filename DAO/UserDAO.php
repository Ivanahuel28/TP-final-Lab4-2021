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
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE username = :username AND password = :password";
            $parameters['username'] = $username;
            $parameters['password'] = $password;

            $connection = Connection::GetInstance();

            $queryResult = $connection->Execute($query, $parameters);

            if ($queryResult) {

                $user->setId($queryResult[0]['id_user']);
                $user->setUsername($queryResult[0]['username']);
                $user->setPassword($queryResult[0]['password']);
                $user->setUserType($queryResult[0]['user_type']);
            }
        } catch (\Exception $ex) {
            echo '<script>console.log("Hubo un problema con la base de datos'. $ex->getMessage() . '"); </script>';
            return $user;
        }
        return $user;
    }
}
