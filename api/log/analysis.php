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

		$analysis = new AnalysisLog;
		$analysis = append_debug_info($analysis, $debug);
		$analysis->time_to_analyze = round($data['analysis']['time_to_analyze'], 4);
		$analysis->analysis_date = $data['analysis']['analysis_date'];
		//$analysis->analysis_date = date("Y-m-d H:i:s");
		$analysis->save();

		$new_id = $analysis->id;

		if (count($data['selections']) > 0) {
			foreach ($data['selections'] as $item) {
				$selection = new AnalysisSelections;
				$selection->analysis_id = $new_id;
				$selection->trait = $item['trait'];
				$selection->score = $item['score'];
				$selection->save();
			}
		}

		$result = new AnalysisResults;
		$result->analysis_id = $new_id;
		$result->sample_size = $data['results']['sample_size'];
		$result->estimated_age = round($data['results']['estimated_age'], 4);
		$result->lower_95_bound = round($data['results']['lower_95_bound'], 4);
		$result->upper_95_bound = round($data['results']['upper_95_bound'], 4);
		$result->std_error = round($data['results']['std_error'], 4);
		$result->corr = round($data['results']['corr'], 4);
		$result->save();

		echo $new_id;
	}

?>