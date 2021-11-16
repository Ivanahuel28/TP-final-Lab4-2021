<?php

namespace Controllers;
use DAO\StudentDAO as StudentDAO;

class StudentController {

	private $studentDAO;

	public function __construct() {
		$this->studentDAO = new StudentDAO();
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
}
