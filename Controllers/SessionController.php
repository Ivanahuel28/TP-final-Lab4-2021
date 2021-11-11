<?php

namespace Controllers;

use DAO\StudentDAO;
use DAO\UserDAO;
use Models\User;

class SessionController
{
    const ADMIN = 'admin';
    const USER = 'user';
    const STUDENT = 'student';

    private $userDAO;
    private $studentDAO;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
        $this->studentDAO = new StudentDAO();
    }

    public function loginRequest($username, $password)
    {
        $user = $this->userDAO->getUser($username, $password);

        switch ($user->getUserType()) {
            case self::ADMIN:
                $this->setSessionAndRedirect($user);
                break;
            case self::STUDENT:
                $student = $this->studentDAO->getByEmail($username);
                $student->getActive() ? $this->setSessionAndRedirect($user) : $this->rejectLogin("El estudiante no se encuentra activo");
                break;
            default:
                $this->rejectLogin("Usuario o contraseña incorrectos");
                break;
        }
    }

    public function registerUser($username, $password, $securityAnswer)
    {
        if ($this->userDAO->userIsRegistrated($username)) {
            $this->rejectLogin("El usuario ya se encuentra registrado");
        } else {
            $student = $this->studentDAO->getByEmail($username);
            $user = $this->userDAO->createUser($username, $password, !($student === null), $securityAnswer);
            $this->setSessionAndRedirect($user);
        }
    }

    public function recoverPassword($username, $password, $securityAnswer)
    {
        if (!$this->userDAO->securityAnswerMatch($username, $securityAnswer)) {
            $this->rejectLogin("No hay ningun usuario registrado con esas caracterisitcas");
        } else {
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
        $_SESSION[self::USER] = $user;
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
