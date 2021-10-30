<?php

namespace Controllers;

class Logout {

	public function __construct() {
		//session_destroy();
	}

	public function logout() {
		session_destroy();
	}
}
