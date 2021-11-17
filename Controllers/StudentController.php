<?php

namespace Controllers;
use DAO\ApplicationDAO;
use DAO\StudentDAO as StudentDAO;

class StudentController {

	private $studentDAO;
	private $applicationsDAO;

	public function __construct() {
		$this->studentDAO = new StudentDAO();
		$this->applicationsDAO = new ApplicationDAO();
	}

	public function renderPersonalData(){

		$student = $this->studentDAO->getByEmail($_SESSION['user']->getUsername());
		require_once(VIEWS_PATH.'student-personal-data.php');
	}

    public function searchStudent()
    {
        $studentList = $this->studentDAO->getAll();
        require_once(VIEWS_PATH.'students-search.php');
    }

    public function showStudentPostulations($student)
    {
        $applications = $this->applicationsDAO->getApplicationsByUser($student);
        require_once(VIEWS_PATH.'applications-list.php');
    }
}