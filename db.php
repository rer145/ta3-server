<?php
	include_once "env.php";
	include_once "SimpleORM.class.php";

	$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME, $DB_PORT);
	if ($conn->connect_error) {
		die(sprintf('Unable to connect to the database. %s', $conn->connect_error));
	}

	SimpleORM::useConnection($conn, $DB_NAME);
	include_once "models.php";
?>