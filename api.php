<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

	//valid routes check

	include_once "db.php";

	$method = empty($_GET['method']) ? "" : strtolower($_GET['method']);

	/**
	 * Logs an analysis entity
	 * 
	 * @access public
	 * @param mixed $body
	 * @return integer
	 */
	if ($method == "log") {
		$body = file_get_contents('php://input');

		if (empty($body)) {
			die(sprintf('$body was not supplied'));
		}

		$body = json_decode($body, true);

		if (is_array($body) && count($body) == 3) {
			$analysis = new AnalysisLog;
			$analysis->app_version = $body['analysis']['app_version'];
			$analysis->r_version = $body['analysis']['r_version'];
			$analysis->r_code_version = $body['analysis']['r_code_version'];
			$analysis->db_version = $body['analysis']['db_version'];
			$analysis->platform = $body['analysis']['platform'];
			$analysis->arch = $body['analysis']['arch'];
			$analysis->time_to_analyze = round($body['analysis']['time_to_analyze'], 4);
			$analysis->analysis_date = $body['analysis']['analysis_date'];
			//$analysis->analysis_date = date("Y-m-d H:i:s");
			$analysis->save();

			$new_id = $analysis->id;

			if (count($body['selections']) > 0) {
				foreach ($body['selections'] as $item) {
					$selection = new AnalysisSelections;
					$selection->analysis_id = $new_id;
					$selection->trait = $item['trait'];
					$selection->score = $item['score'];
					$selection->save();
				}
			}

			$result = new AnalysisResults;
			$result->analysis_id = $new_id;
			$result->sample_size = $body['results']['sample_size'];
			$result->estimated_age = round($body['results']['estimated_age'], 4);
			$result->lower_95_bound = round($body['results']['lower_95_bound'], 4);
			$result->upper_95_bound = round($body['results']['upper_95_bound'], 4);
			$result->std_error = round($body['results']['std_error'], 4);
			$result->corr = round($body['results']['corr'], 4);
			$result->save();

			echo $new_id;
		}
	}

	/**
	 * Get an analysis entity
	 * 
	 * @access public
	 * @param integer $id
	 * @return AnalysisLog
	 */
	if ($method == "get") {
		if (empty($_GET['id'])) {
			die(sprintf('$id was not supplied'));
		}

		$obj = AnalysisLog::retrieveByid($_GET['id']);
		echo json_encode($obj);
		
	}

?>