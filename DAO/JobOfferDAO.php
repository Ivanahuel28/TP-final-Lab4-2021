<?php

namespace DAO;

use Models\JobOffer;
use FFI\Exception;

class JobOfferDAO {

	private $tableName = "job_offers";

	public function addOffer(JobOffer $jobOffer) {

		try {
			$query = "INSERT INTO " . $this->tableName .
				" (remote, description, career, job_position, active, title, id_company)
			  VALUES (:remote, :description,:career,:job_position,:active, :title,:id_company);";

			$parameters['remote'] = $jobOffer->getRemote();
			$parameters['description'] = $jobOffer->getDescription();
			$parameters['career'] = $jobOffer->getCareer();
			$parameters['job_position'] = $jobOffer->getJobPosition();
			$parameters['active'] = $jobOffer->getActive();
			$parameters['title'] = $jobOffer->getTitle();
			$parameters['id_company'] = $jobOffer->getId_company();

			$this->connection = Connection::GetInstance();

			$this->connection->ExecuteNonQuery($query, $parameters);
		} catch (Exception $ex) {
			echo '<script>console.log("Hubo un problema con la base de datos' . $ex->getMessage() . '"); </script>';
			return null;
		}
	}

	public function getAll() {

		$jobOfferList = array();

		try {
			$query = "SELECT * FROM " . $this->tableName;
			$connection = Connection::GetInstance();
			$queryResult = $connection->Execute($query);

			
		} catch (Exception $ex) {
			echo '<script>console.log("Hubo un problema con la base de datos' . $ex->getMessage() . '"); </script>';
			return null;
		}

		return $jobOfferList;
	}
}