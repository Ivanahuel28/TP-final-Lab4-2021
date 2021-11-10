<?php

namespace Models;

class Application
{

    private $id_application;
    private $id_user;
    private $id_student;
    private $id_jobOffer;
    private $date;
    private $filePath;

    public function __construct()
    {
    }

    public function getId_application()
    {
        return $this->id_application;
    }

    public function setId_application($id_application)
    {
        $this->id_application = $id_application;
    }

    public function getId_user()
    {
        return $this->id_user;
    }

    public function setId_user($id_user)
    {
        $this->id_user = $id_user;
    }

    public function getId_student()
    {
        return $this->id_student;
    }

    public function setId_student($id_student)
    {
        $this->id_student = $id_student;
    }
    public function getId_jobOffer()
    {
        return $this->id_jobOffer;
    }

    public function setId_jobOffer($id_jobOffer)
    {
        $this->id_jobOffer = $id_jobOffer;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getFilePath()
    {
        return $this->filePath;
    }

    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;
    }
}
