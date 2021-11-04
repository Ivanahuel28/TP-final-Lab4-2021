<?php

namespace DAO;

use DAO\IntfJobPosition as IntfJobPosition;
use Models\JobPosition as JobPosition;


class JobPositionDAO implements IntfJobPosition {

	private $jobPositionList;

	public function getAll() {

		$this->retrieveData();

		return $this->jobPositionList;
	}

	private function retrieveData() {

		$ch = curl_init("https://utn-students-api.herokuapp.com/api/JobPosition");
		$fp = fopen("Data/jobPositions.json", "w");

		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("x-api-key: 4f3bceed-50ba-4461-a910-518598664c08"));

		curl_exec($ch);
		curl_close($ch);
		fclose($fp);

		$this->jobPositionList = array();

		if (file_exists('Data/jobPositions.json')) {
			$jsonContent = file_get_contents('Data/jobPositions.json');

			$arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

			foreach ($arrayToDecode as $valuesArray) {

				$jobPosition = new JobPosition();

				$jobPosition->setId_jobPosition($valuesArray['jobPositionId']);
				$jobPosition->setId_career($valuesArray['careerId']);
				$jobPosition->setDescription($valuesArray['description']);

				array_push($this->jobPositionList, $jobPosition);
			}
		}
	}
}
