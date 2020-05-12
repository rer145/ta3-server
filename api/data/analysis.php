<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

	require "../../lib/SimpleORM.class.php";
	include_once "../../env.php";
	include_once "../../db/db.php";
	include_once "../../db/models.php";
	include_once "../../inc/api_helper.php";

	$id = $_GET["id"];
	$data = AnalysisLog::retrieveByPK($id);
	echo json_encode($data);

?>