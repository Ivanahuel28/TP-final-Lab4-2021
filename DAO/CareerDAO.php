<?php

namespace DAO;

use DAO\IntfCareerDAO as IntfCareerDAO;
use Models\Career as Career;

class CareerDAO implements IntfCareerDAO {

	private $careerList;

	public function __construct()
	{
		$this->careerList = array();
	}

	public function getAll() {
		$this->retrieveData();

		return $this->careerList;
	}

	public function getAllActives(){
		
		$this->retrieveData();

		$activesList = array();

		foreach ($this->careerList as $career) {
			
			if($career->getActive()){
				array_push($activesList,$career);
			}
		}

		return $activesList;
	}

	public function getById($id){
		
		$this->retrieveData();

		$careerToReturn = null;
		$i = 0;

		while (!$careerToReturn && $i < count($this->careerList)) {
			if ($id == $this->careerList[$i]->getId_career()) {
				$careerToReturn = $this->careerList[$i];
			} else {
				$i++;
			}
		}

		return $careerToReturn;
	}

	private function retrieveData() {

		$ch = curl_init("https://utn-students-api.herokuapp.com/api/Career");
		$fp = fopen("Data/careers.json", "w");

		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("x-api-key: 4f3bceed-50ba-4461-a910-518598664c08"));

		curl_exec($ch);
		curl_close($ch);
		fclose($fp);

		$this->jobPositionList = array();

		if (file_exists('Data/careers.json')) {

			$jsonContent = file_get_contents('Data/careers.json');

			$arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

			foreach ($arrayToDecode as $valuesArray) {

				$career = new Career();

				$career->setId_career($valuesArray['careerId']);
				$career->setDescription($valuesArray['description']);
				$career->setActive($valuesArray['active']);

				array_push($this->careerList, $career);
			}
		}
	}
}
