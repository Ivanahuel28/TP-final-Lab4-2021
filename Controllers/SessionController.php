<?php

namespace Controllers;

use DAO\StudentDAO;
use DAO\UserDAO;
use Models\User;
use DAO\CompanyDAO;
use Models\Student;

class SessionController
{
    const ADMIN = 'admin';
    const USER = 'user';
    const STUDENT = 'student';
    const COMPANY = 'company';

    private $userDAO;
    private $studentDAO;
    private $companyDAO;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
        $this->studentDAO = new StudentDAO();
        $this->companyDAO = new CompanyDAO();
    }

    public function loginRequest($username, $password)
    {
        $user = $this->userDAO->getUser($username, $password);

        if ($user)
        {
            switch ($user->getUserType())
            {
                case self::ADMIN:
                    $this->setSessionAndRedirect($user);
                    break;
                case self::STUDENT:
                    $student = $this->studentDAO->getByEmail($username);
                    if ($student->getActive())
                        $this->setSessionAndRedirect($user);
                    else
                        $this->rejectLogin("El estudiante no se encuentra activo");
                    break;
                case self::COMPANY:
                    $this->setSessionAndRedirect($user);
                    break;
                default:
                    break;
            }
        }
        else
            $this->rejectLogin("Usuario o contraseña incorrectos");
    }

    public function requestRegisterUser($username, $password, $userType, $securityAnswer)
    {
        if (!$this->userDAO->userIsRegistrated($username)) // comprueba si no esta registrado
        {
            $flag = false;
            switch ($userType)
            {
                case 'company':
                    if ($this->companyDAO->getByCuit($username))
                        $flag = true;
                    else
                        $message = "No hay una empresa con es cuit activa en el sistema";
                    break;
                case 'student':
                    if ($this->studentDAO->getByEmail($username))
                        $flag = true;
                    else
                        $message = "No hay una alumno con ese correo activo en el sistema";
                    break;
                case 'admin':
                    if ($username === 'admin')
                        $flag = true;
                    else
                        $message = "no es posible crear el usuario";
                    break;

                default:
                    $message = "no es posible crear el usuario";
                    break;
            }

            if ($flag)
            {
                $user = $this->userDAO->createUser($username, $password, $userType, $securityAnswer);
                $this->setSessionAndRedirect($user);
            }
            else
            {
                $this->rejectLogin($message);
            }
        }
        else
        {
            $this->rejectLogin("El usuario ya se encuentra registrado");
        }
    }

    public function recoverPassword($username, $password, $securityAnswer)
    {
        if (!$this->userDAO->securityAnswerMatch($username, $securityAnswer))
        {
            $this->rejectLogin("No hay ningun usuario registrado con esas caracterisitcas");
        }
        else
        {
            $this->userDAO->updateUserPassword($username, $password);
            echo '<div class="alert alert-success position-absolute alert-fixed" role="alert">Contraseña actualizada con exito</div>';
            $this->renderLoginView();
        }
    }

    public function renderLoginView()
    {
        require_once(VIEWS_PATH . 'login.php');
    }

    public function logout()
    {
        session_destroy();
        header('Location: ' . FRONT_ROOT);
    }

    private function setSessionAndRedirect(User $user)
    {
        $_SESSION['user'] = $user;
        header('Location: ' . FRONT_ROOT);
    }

    private function rejectLogin($errorMsg)
    {
        unset($_SESSION[self::USER]);
        $this->showErrorMsg($errorMsg);
        $this->renderLoginView();
    }

    private function showErrorMsg($errorMsg)
    {

        echo '
               <div class="alert alert-warning position-absolute alert-fixed" role="alert">' . $errorMsg . '</div>
         ';
    }
}
