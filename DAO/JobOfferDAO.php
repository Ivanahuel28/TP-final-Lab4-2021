<?php

namespace DAO;

use Models\JobOffer;
use FFI\Exception;

class JobOfferDAO implements IntfJobOfferDAO {

	private $tableName = "job_offers";

	public function addOffer(JobOffer $jobOffer) {

		try {
			$query = "INSERT INTO " . $this->tableName .
				" (id_job_position,id_company,id_career,title,description,remote,active)
			  VALUES (:id_job_position,:id_company,:id_career,:title,:description,:remote,:active);";

			$parameters['id_job_position'] = $jobOffer->getId_jobPosition();
			$parameters['id_company'] = $jobOffer->getId_company();
			$parameters['id_career'] = $jobOffer->getId_career();
			$parameters['title'] = $jobOffer->getTitle();
			$parameters['description'] = $jobOffer->getDescription();
			$parameters['remote'] = $jobOffer->getRemote();
			$parameters['active'] = $jobOffer->getActive();

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
