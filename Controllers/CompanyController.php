<?php

namespace Controllers;

use DAO\CompanyDAO as CompanyDAO;
use Models\Company as Company;

class CompanyController
{

    private $companyDAO;

    public function __construct()
    {
        $this->companyDAO = new CompanyDAO();
    }

    public function showCompaniesView()
    {

        $companiesList = $this->companyDAO->getAll();

        require_once(VIEWS_PATH . 'companies-list.php');
    }

    public function showCompaniesViewForStudent()
    {

        $companiesList = $this->companyDAO->getAllActives();

        require_once(VIEWS_PATH . 'student-companies-list.php');
    }

    public function showAddView()
    {
        require_once(VIEWS_PATH . 'company-add.php');
    }

    public function showViewEditCompany($companyCuit)
    {

        $company = $this->companyDAO->getByCuit($companyCuit);

        require_once(VIEWS_PATH . 'company-edit.php');
    }

    public function showViewCompanyInfo($companyCuit)
    {
        $company = $this->companyDAO->getByCuit($companyCuit);

        require_once(VIEWS_PATH . 'company-info.php');
    }

    public function add($cuit, $name, $role, $active = false)
    {
        $companyByCuit = $this->companyDAO->getByCuit($cuit);

        if ($companyByCuit == null || $companyByCuit->getCuit() != (int)$cuit) {
            $company = $this->createCompany($cuit, $name, $role, $active);
            $this->companyDAO->add($company);
        } else {
            $this->showExceptionMsg();
        }
        $this->showCompaniesView();
    }

    public function executeEditCompany($cuit, $name, $role, $active = false)
    {

        $companyToEdit = new Company();
        $companyToEdit->setCuit($cuit);
        $companyToEdit->setName($name);
        $companyToEdit->setRole($role);
        $companyToEdit->setActive(($active == "true") ? true : false);

        $this->companyDAO->update($companyToEdit);

        $this->showCompaniesView();
    }

    public function executeDeleteCompany($cuit)
    {

        $this->companyDAO->delete($cuit);

        $this->showCompaniesView();
    }

    /**
     * @param $cuit
     * @param $name
     * @param $role
     * @param $active
     * @return Company
     */
    private function createCompany($cuit, $name, $role, $active)
    {
        $company = new Company();

        $company->setId(count($this->companyDAO->getAll()));
        $company->setCuit($cuit);
        $company->setName($name);
        $company->setRole($role);
        $company->setActive($active == "true");
        return $company;
    }

    private function showExceptionMsg()
    {
        echo '
           <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Ups!</strong>  La compañia ingresada ya existe.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>';
    }
}
