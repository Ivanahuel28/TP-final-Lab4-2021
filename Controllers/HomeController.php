<?php

namespace Controllers;

use Models\User;

class HomeController {

	public function Index($message = "") {

		if($_SESSION['user']){

			if($_SESSION['user']->getUserType() === "admin"){
				$this->renderAdminHome();
			}else{
				$this->renderStudentHome();
			}
			
		}else{
			header('Location: Session/renderLoginView');
		}
	}

	public function renderStudentHome(){
		require_once(VIEWS_PATH.'student-home.php');
	}

	public function renderAdminHome(){
		require_once(VIEWS_PATH.'admin-home.php');
	}
}
