<?php

namespace DAO;

use DAO\IntfApplicationDAO;
use Models\Application;

class ApplicationDAO implements IntfApplicationDAO {

	private $tableName = "companies";
   
    private $connection;

    public function __construct()
    {
        
    }

    public function save(Application $application){

        
    }
}