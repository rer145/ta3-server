<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require "../../lib/SimpleORM.class.php";
include_once "../../env.php";
include_once "../../db/db.php";
include_once "../../db/models.php";
include_once "../../inc/api_helper.php";

	$body = file_get_contents('php://input');

	if (empty($body)) {
		die(sprintf('$body was not supplied'));
	}

	$body = json_decode($body, true);

	if (is_array($body) && count($body) == 2) {
		$debug = $body["debug"];
		$data = $body["data"];

		$log = new DebugLog;
		$log = append_debug_info($log, $debug);
		$log->event_date = $data['event_date'];
		$log->event_level = $data['event_level'];
		$log->event_category = $data['event_category'];
		$log->event_action = $data['event_action'];
		$log->event_label = $data['event_label'];
		$log->event_value = $data['event_value'];
		$log->save();

		$new_id = $log->id;
		echo $new_id;
	}

?>