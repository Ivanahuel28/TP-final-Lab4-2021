<?php

namespace DAO;

use Models\Application;

interface IntfApplicationDAO{
	public function save(Application $application);
}