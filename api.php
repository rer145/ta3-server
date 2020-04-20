<?php

	include_once "db.php";

	$method = empty($_GET['method']) ? "" : strtolwer($_GET['method']);

	if ($method == "log") {
		//parse json and store in db
	}

?>