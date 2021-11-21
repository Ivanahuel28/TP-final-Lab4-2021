<?php

namespace DAO;

use DAO\IntfStudentDAO as IntfStudentDAO;
use Exception;
use Models\Student as Student;

class StudentDAO implements IntfStudentDAO
{

    const API_KEY = "4f3bceed-50ba-4461-a910-518598664c08";
    private $studentList;

    public function __construct()
    {
        $this->studentList = array();
    }

    public function getAll()
    {
        $this->retrieveData();

        return $this->studentList;
    }

    public function getByEmail($email)
    {

        $this->retrieveData();

        $studentToReturn = null;
        $i = 0;

        while (!$studentToReturn && $i < count($this->studentList))
        {
            if ($email === $this->studentList[$i]->getEmail())
            {
                $studentToReturn = $this->studentList[$i];
            }
            else
            {
                $i++;
            }
        }

        return $studentToReturn;
    }

    private function retrieveData()
    {
        $this->studentList = array();

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://utn-students-api.herokuapp.com/api/Student');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('x-api-key: 4f3bceed-50ba-4461-a910-518598664c08'));

        $data = curl_exec($curl);

        curl_close($curl);

        $arrayToDecode = ($data) ? json_decode($data, true) : array();

        if ($arrayToDecode === null) /* si no puede armar el array por JSON utilizo el backup */
        {
            $arrayToDecode = $this->useBackup();
        }
        else /* Si hay datos actualizo el backup */
        {
            $jsonContent = json_encode($arrayToDecode, JSON_PRETTY_PRINT);

            file_put_contents(API_BACKUP_PATH . 'students.json', $jsonContent);
        }

        foreach ($arrayToDecode as $valuesArray)
        {
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

    public function useBackup()
    {
        if (file_exists(API_BACKUP_PATH . 'students.json'))
        {
            $jsonContent = file_get_contents(API_BACKUP_PATH . 'students.json');

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
        }

        return $arrayToDecode;
    }
}
