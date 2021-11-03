<?php

namespace DAO;

use Models\Student as Student;

interface IntfStudentDAO{
	public function getAll();
	public function getByEmail($email);
}