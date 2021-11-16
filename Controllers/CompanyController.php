<?php

namespace Controllers;

use DAO\CompanyDAO as CompanyDAO;
use Models\Company as Company;
use FFI\Exception;

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

    public function add($cuit, $name, $role, $description, $link = "", $active = false)
    {
        if (is_numeric($cuit) && strlen($cuit))
        {
            $companyByCuit = $this->companyDAO->getByCuit($cuit);

            if ($companyByCuit == null || $companyByCuit->getCuit() != (int)$cuit)
            {
                $company = $this->createCompany($cuit, $name, $role, $description, $link, $active);
                $this->companyDAO->add($company);
            }
            else
            {
                $this->showExceptionMsg();
            }
        }
        else
        {
            $this->printCuitErrorMsg();
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

    public function companyExecuteEditProfile($cuit, $name, $role = "", $description = "", $link = "", $active, $file)
    {

        try
        {
            $fileName = $file["name"];
            $tempFileName = $file["tmp_name"];
            $type = $file["type"];

            $filePath = COMPANY_IMG_PATH . basename($fileName);

            $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

            $imageSize = getimagesize($tempFileName);

            if ($imageSize !== false)
            {
                if (move_uploaded_file($tempFileName, $filePath))
                {
                    $companyToEdit = new Company();
                    $companyToEdit->setCuit((int)$cuit);
                    $companyToEdit->setName($name);
                    $companyToEdit->setRole($role);
                    $companyToEdit->setDescription($description);
                    $companyToEdit->setLink($link);
                    $companyToEdit->setActive($active === "true");
                    $companyToEdit->setImg_path($filePath);

                    $this->companyDAO->update($companyToEdit);
                }
                else
                    $this->printAlertMessageOnTop("warning", "ocurrio un problema al subir la imagen", "Error");
            }
            else
                $this->printAlertMessageOnTop("warning", "El archivo no corresponde a una imagen", "Atencion!");
        }
        catch (Exception $ex)
        {
            $message = $ex->getMessage();
        }
        //$this->showCompaniesView();
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
    private function createCompany($cuit, $name, $role, $description, $link, $active)
    {
        $company = new Company();

        $company->setId(count($this->companyDAO->getAll()));
        $company->setCuit($cuit);
        $company->setName($name);
        $company->setRole($role);
        $company->setDescription($description);
        $company->setLink($link);
        $company->setActive($active == "true");
        return $company;
    }

    private function showExceptionMsg()
    {
        echo '
           <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Ups!</strong>  Ya existe una Empresa con ese cuit
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>';
    }

    private function printCuitErrorMsg()
    {
        echo '
           <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Atencion!</strong>  El cuit debe constar solamente de 11 digitos
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>';
    }

    private function printAlertMessageOnTop($type = "secondary",  $message = "", $strong = "")
    {
        echo '
		<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">
			 <strong>' . $strong . '</strong> ' . $message . '
			 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	  	</div>';
    }
}
