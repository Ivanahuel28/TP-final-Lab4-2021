<?php

namespace DAO;

use Models\Application;

interface IntfApplicationDAO{
	public function add(Application $application);
	public function getId(Application $application);
}