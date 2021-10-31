<?php

namespace DAO;

use DAO\IntfStudentDAO as IntfStudentDAO;
use Models\Student as Student;

class StudentDAO implements IntfStudentDAO {

	private $studentList;

	public function __construct() {
		$this->studentList = array();
	}

	public function getAll() {
		$this->retrieveData();

		return $this->studentList;
	}

	public function getByEmail($email) {

		$this->retrieveData();

		$studentToReturn = null;
		$i = 0;

		while (!$studentToReturn && $i < count($this->studentList)) {
			if ($email->getUsername() === $this->studentList[$i]->getEmail()) {
				$studentToReturn = $this->studentList[$i];
			} else {
				$i++;
			}
		}

		return $studentToReturn;
	}

	private function retrieveData() {

		$ch = curl_init("https://utn-students-api.herokuapp.com/api/Student");
		$fp = fopen("Data/students.json", "w");

		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("x-api-key: 4f3bceed-50ba-4461-a910-518598664c08"));

		curl_exec($ch);
		curl_close($ch);
		fclose($fp);

		$this->studentList = array();

		if (file_exists('Data/students.json')) {
			$jsonContent = file_get_contents('Data/students.json');

			$arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

			foreach ($arrayToDecode as $valuesArray) {
				$student = new Student();

				$student->setId($valuesArray['studentId']);
				$student->setCareerId($valuesArray['careerId']);
				$student->setFirstname($valuesArray['firstName']);
				$student->setLastname($valuesArray['lastName']);
				$student->setDni($valuesArray['dni']);
				$student->setFileNumber($valuesArray['fileNumber']);
				$student->setGender($valuesArray['gender']);
				$student->setBirthDate($valuesArray['birthDate']);
				$student->setEmail($valuesArray['email']);
				$student->setPhoneNumber($valuesArray['phoneNumber']);
				$student->setActive($valuesArray['active']);

				array_push($this->studentList, $student);
			}
		}
	}
}
