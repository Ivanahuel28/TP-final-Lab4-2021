<?php

namespace Controllers;

use DAO\CompanyDAO;
use DAO\JobOfferDAO;
use DAO\StudentDAO;
use DAO\UserDAO;
use Models\Company;
use Models\Student;
use Models\User;

class HomeController
{
    private $jobOfferDAO;

    public function __construct()
    {
        $this->jobOfferDAO = new JobOfferDAO();
        $this->studentDAO = new StudentDAO();
        $this->companyDAO = new CompanyDAO();
    }

    public function Index($message = "")
    {

        if ($_SESSION['user'])
        {
            if ($_SESSION['user']->getUserType() === "admin")
            {
                $this->renderAdminHome();
            }
            else
            {
                $this->renderStudentHome();
            }
        }
        else
        {
            header('Location: Session/renderLoginView');
        }
    }

    public function renderStudentHome()
    {
        $student = new Student();

        $student = $this->studentDAO->getByEmail($_SESSION['user']->getUsername());

        $jobOfferList = $this->jobOfferDAO->getAllActivesByCareer($student->getCareerId());

        foreach ($jobOfferList as $jobOffer) {

            $company = new Company();

            $company = $this->companyDAO->getById($jobOffer->getId_company());
            
            $list[$jobOffer->getId_jobOffer()] = array(
                'title' => $jobOffer->getTitle(),
                'companyName' => $company->getName()
            );
        }

        /* title, company name*/

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

    public function renderRecoverPassword()
    {
        require_once(VIEWS_PATH . 'recover-passwrod.php');
    }

    public function renderLogin()
    {
        require_once(VIEWS_PATH . 'login.php');
    }
}
