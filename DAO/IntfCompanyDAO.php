<?php

namespace DAO;

use Models\Company as Company;

interface IntfCompanyDAO{
	public function getAll();
	public function add(Company $company);
}