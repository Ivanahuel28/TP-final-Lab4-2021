<?php

namespace Controllers;

use DAO\UserDAO;
use Models\User;

class SessionController
{
    private $userDAO;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
    }

    public function loginRequest($username, $password)
    {
        $user = $this->userDAO->getUser($username, $password);
        if ($user->getUserType()) {
            $_SESSION['user'] = $user;
            header('Location: ' . FRONT_ROOT);
        } else {
            unset($_SESSION['user']);
            $this->showErrorMsg();
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

    private function showErrorMsg()
    {
        echo '
        <div class="container align-content-center">
           <div class="flex-column py-2" >
               <div class="alert alert-danger" role="alert">
	        		    Nombre de usuario y/o contraseña inconrrectos
                 </div>
             </div>
         </div>';
    }
}
