<?php

namespace Utils;

class ErrorModal {

	private $message;

	public function __construct() {
	}

	public function echoModal($message = ""){

		echo '<script> if(confirm('.$message.'));';
    	echo "window.location = 'index.php'; </script>";
	}
}
