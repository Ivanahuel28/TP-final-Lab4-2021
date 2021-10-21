<?php

namespace DAO;

use Models\Company as Company;

interface IntfCompanyDAO{
	public function getAll();
	public function getAllActives();
	public function add(Company $company);
	public function getByCuit($cuit);
	public function update(Company $company);
	public function delete($cuit);
}