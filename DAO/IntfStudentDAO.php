<?php

namespace DAO;

use Models\Student as Student;

interface IntfStudentDAO{
	public function getAll();
	public function getByEmail($email);/* 
	public function getAllActives();
	public function add(Company $company);
	public function getByCuit($cuit);
	public function update(Company $company);
	public function delete($cuit); */
}