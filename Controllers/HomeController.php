<?php

namespace Controllers;

use DAO\JobOfferDAO;
use DAO\StudentDAO;
use DAO\UserDAO;
use Models\User;

class HomeController
{
    private $jobOfferDAO;

    public function __construct()
    {
        $this->jobOfferDAO = new JobOfferDAO();
    }

    public function Index($message = "")
    {

        if ($_SESSION['user']) {
            if ($_SESSION['user']->getUserType() === "admin") {
                $this->renderAdminHome();
            } else {
                $this->renderStudentHome();
            }
        } else {
            header('Location: Session/renderLoginView');
        }
    }

    public function renderStudentHome()
    {
        $jobsList = $this->jobOfferDAO->getAll();
        require_once(VIEWS_PATH . 'student-home.php');
    }

    public function renderAdminHome()
    {
        require_once(VIEWS_PATH . 'admin-home.php');
    }

    public function renderRegisterUser()
    {
        require_once(VIEWS_PATH . 'register.php');
    }

    public function renderLogin()
    {
        require_once(VIEWS_PATH . 'login.php');
    }
}
