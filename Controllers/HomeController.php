<?php

namespace Controllers;

use Utils\ErrorModal;

class HomeController {
	public function Index($message = "") {

		if($_SESSION){

			echo "session iniciada";

			var_dump($_SESSION);

			var_dump($message);

			$errorModal = new ErrorModal();

			$errorModal->echoModal($message);

			session_destroy();
		}else{
			header('Location: Login/renderLoginView');
		}
	}

	public function GoToStudentHome(){
		require_once(VIEWS_PATH.'student-home.php');
	}
}
