<?php

namespace Controllers;

use DAO\UserDAO;
use Models\User;

class LoginController {

	private $userDAO;

	public function __construct() {
		$this->userDAO = new UserDAO();
	}

	public function loginRequest($username, $password) {

		$user = $this->userDAO->getUser($username, $password);

		if ($user->getUserType()) {

			$_SESSION['user'] = $user;

			header('Location: ' . FRONT_ROOT);
		} else {
			unset($_SESSION['user']);

			//require_once(VIEWS_PATH.'error-message-to-client.php');

			echo '<div class="alert alert-danger" role="alert">
			Nombre de usuario y/o conrtraseña inconrrectos
		  </div>';
			$this->renderLoginView();
		}
	}

	public function renderLoginView() {

		require_once(VIEWS_PATH . 'login.php');
	}

	public function logout() {
		session_destroy();

		header('Location: '.FRONT_ROOT);
	}
}
