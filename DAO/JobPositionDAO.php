<?php

namespace DAO;

use DAO\IntfJobPositionDAO as IntfJobPositionDAO;
use Models\JobPosition as JobPosition;


class JobPositionDAO implements IntfJobPositionDAO
{

	private $jobPositionList;

	public function getAll()
	{

		$this->retrieveData();

		return $this->jobPositionList;
	}

	public function getAllByCareerId($id_career)
	{

		$this->retrieveData();

		$filteredList = array();

		foreach ($this->jobPositionList as $jobPosition)
		{

			if ($jobPosition->getId_career() === $id_career)
			{
				array_push($filteredList, $jobPosition);
			}
		}

		return $filteredList;
	}

	public function getById($id)
	{

		$this->retrieveData();

		$jobPositionToReturn = null;
		$i = 0;

		while (!$jobPositionToReturn && $i < count($this->jobPositionList))
		{
			if ($id == $this->jobPositionList[$i]->getId_jobPosition())
			{
				$jobPositionToReturn = $this->jobPositionList[$i];
			}
			else
			{
				$i++;
			}
		}

		return $jobPositionToReturn;
	}

	public function getTitleById($id)
	{

		$this->retrieveData();

		$title = null;
		$i = 0;

		while (!$title && $i < count($this->jobPositionList))
		{
			if ($id === $this->jobPositionList[$i]->getId_jobPosition())
			{
				$title = $this->jobPositionList[$i]->getDescription();
			}
			else
			{
				$i++;
			}
		}

		return $title;
	}

	private function retrieveData()
	{

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, 'https://utn-students-api.herokuapp.com/api/JobPosition');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('x-api-key: 4f3bceed-50ba-4461-a910-518598664c08'));

		$data = curl_exec($curl);

		curl_close($curl);

		$arrayToDecode = ($data) ? json_decode($data, true) : array();

		$this->jobPositionList = array();

		foreach ($arrayToDecode as $valuesArray)
		{

			$jobPosition = new JobPosition();

			$jobPosition->setId_jobPosition($valuesArray['jobPositionId']);
			$jobPosition->setId_career($valuesArray['careerId']);
			$jobPosition->setDescription($valuesArray['description']);

			array_push($this->jobPositionList, $jobPosition);
		}
	}
}
