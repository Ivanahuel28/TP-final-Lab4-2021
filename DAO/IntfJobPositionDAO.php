<?php

namespace DAO;

interface IntfJobPositionDAO {

	public function getAll();
	public function getAllByCareerId($id_career);
	public function getById($id);
}
