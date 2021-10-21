<?php

namespace Controllers;

class HomeController {

	public function Index($message = "") {
		require_once(VIEWS_PATH . "login.php");
	}

	public function Login($user) {

		if ($user === "admin") {
			require_once(VIEWS_PATH . "admin-home.php");
		} else {

			$_SESSION['user'] = 'user';
			require_once(VIEWS_PATH . "student-home.php");
		}
	}
}
