<?php

namespace DAO;

use DAO\IntfCareerDAO as IntfCareerDAO;
use Models\Career as Career;

class CareerDAO implements IntfCareerDAO
{

	private $careerList;

	public function __construct()
	{
		$this->careerList = array();
	}

	public function getAll()
	{
		$this->retrieveData();

		return $this->careerList;
	}

	public function getAllActives()
	{

		$this->retrieveData();

		$activesList = array();

		foreach ($this->careerList as $career)
		{

			if ($career->getActive())
			{
				array_push($activesList, $career);
			}
		}

		return $activesList;
	}

	public function getById($id)
	{

		$this->retrieveData();

		$careerToReturn = null;
		$i = 0;

		while (!$careerToReturn && $i < count($this->careerList))
		{
			if ($id == $this->careerList[$i]->getId_career())
			{
				$careerToReturn = $this->careerList[$i];
			}
			else
			{
				$i++;
			}
		}

		return $careerToReturn;
	}

	private function retrieveData()
	{	
		$this->careerList = array();

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, 'https://utn-students-api.herokuapp.com/api/Career');
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

            file_put_contents(API_BACKUP_PATH . 'careers.json', $jsonContent);
        }

		foreach ($arrayToDecode as $valuesArray)
		{
			$career = new Career();

			$career->setId_career($valuesArray['careerId']);
			$career->setDescription($valuesArray['description']);
			$career->setActive($valuesArray['active']);

			array_push($this->careerList, $career);
		}
	}

	public function useBackup()
    {
        if (file_exists(API_BACKUP_PATH . 'careers.json'))
        {
            $jsonContent = file_get_contents(API_BACKUP_PATH . 'careers.json');

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
        }

        return $arrayToDecode;
    }
}
