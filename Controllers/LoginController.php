<?php

namespace Controllers;

use DAO\UserDAO;

class LoginController{

	private $userDAO;

	public function __construct()
	{
		$this->userDAO = new UserDAO();
	}

	public function loginRequest($username,$password){
		
		$user = $this->userDAO->getUser($username,$password);

		if($user['userType']){
			$_SESSION['user'] = $user;
		}else{
			unset($_SESSION['user']);
		}

		header('Location: '. FRONT_ROOT.'?message=hola');

	}

	public function renderLoginView(){

		require_once (VIEWS_PATH.'login.php');
	}
}