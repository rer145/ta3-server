<?php

// error_reporting(E_ALL);
// ini_set('display_errors', '1');

// 	function append_debug_info($obj, $debug) {
// 		$obj->uuid = $debug['uuid'];
// 		$obj->session = $debug['session'];
// 		$obj->app_version = $debug['app_version'];
// 		$obj->r_version = $debug['r_version'];
// 		$obj->r_code_version = $debug['r_code_version'];
// 		$obj->db_version = $debug['db_version'];
// 		$obj->platform = $debug['platform'];
// 		$obj->platform_release = $debug['platform_release'];
// 		$obj->arch = $debug['arch'];
// 		$obj->node_version = $debug['node_version'];
// 		$obj->electron_version = $debug['electron_version'];
// 		$obj->chrome_version = $debug['chrome_version'];
// 		$obj->locale = $debug['locale'];
// 		$obj->locale_country_code = $debug['locale_country_code'];
// 		$obj->arguments = $debug['arguments'];
// 		$obj->entry_mode = $debug['entry_mode'];

// 		return $obj;
// 	}

// 	//valid routes check

// 	require "lib/SimpleORM.class.php";
// 	include_once "env.php";
// 	include_once "db/db.php";
// 	include_once "db/models.php";

// 	$method = empty($_GET['method']) ? "" : strtolower($_GET['method']);

// 	/**
// 	 * Logs an analysis entity
// 	 * 
// 	 * @method POST
// 	 * @access public
// 	 * @param mixed $body
// 	 * @return integer
// 	 */
// 	if ($method == "log_analysis") {
// 		$body = file_get_contents('php://input');

// 		if (empty($body)) {
// 			die(sprintf('$body was not supplied'));
// 		}

// 		$body = json_decode($body, true);

// 		if (is_array($body) && count($body) == 2) {
// 			$debug = $body["debug"];
// 			$data = $body["data"];

// 			$analysis = new AnalysisLog;
// 			$analysis = append_debug_info($analysis, $debug);
// 			$analysis->time_to_analyze = round($data['analysis']['time_to_analyze'], 4);
// 			$analysis->analysis_date = $data['analysis']['analysis_date'];
// 			//$analysis->analysis_date = date("Y-m-d H:i:s");
// 			$analysis->save();

// 			$new_id = $analysis->id;

// 			if (count($data['selections']) > 0) {
// 				foreach ($data['selections'] as $item) {
// 					$selection = new AnalysisSelections;
// 					$selection->analysis_id = $new_id;
// 					$selection->trait = $item['trait'];
// 					$selection->score = $item['score'];
// 					$selection->save();
// 				}
// 			}

// 			$result = new AnalysisResults;
// 			$result->analysis_id = $new_id;
// 			$result->sample_size = $data['results']['sample_size'];
// 			$result->estimated_age = round($data['results']['estimated_age'], 4);
// 			$result->lower_95_bound = round($data['results']['lower_95_bound'], 4);
// 			$result->upper_95_bound = round($data['results']['upper_95_bound'], 4);
// 			$result->std_error = round($data['results']['std_error'], 4);
// 			$result->corr = round($data['results']['corr'], 4);
// 			$result->save();

// 			echo $new_id;
// 		}
// 	}

// 	/**
// 	 * Get an analysis entity
// 	 * 
// 	 * @method GET
// 	 * @access public
// 	 * @param integer $id
// 	 * @return AnalysisLog
// 	 */
// 	if ($method == "get_analysis") {
// 		if (empty($_GET['id'])) {
// 			die(sprintf('$id was not supplied'));
// 		}

// 		$obj = AnalysisLog::retrieveByid($_GET['id']);
// 		echo json_encode($obj);
// 	}

// 	/**
// 	 * Get a list of analysis entities for a uuid
// 	 * 
// 	 * @method GET
// 	 * @access public
// 	 * @param integer $uuid
// 	 * @return Array(AnalysisLog)
// 	 */
// 	if ($method == "get_analysis_by_uuid") {
// 		if (empty($_GET['uuid'])) {
// 			die(sprintf('$uuid was not supplied'));
// 		}

// 		$obj = AnalysisLog::retrieveByuuid($_GET['uuid']);
// 		echo json_encode($obj);
// 	}

// 	/**
// 	 * Get a debug entity
// 	 * 
// 	 * @method GET
// 	 * @access public
// 	 * @param integer $id
// 	 * @return DebugLog
// 	 */
// 	if ($method == "get_debug") {
// 		if (empty($_GET['id'])) {
// 			die(sprintf('$id was not supplied'));
// 		}

// 		$obj = DebugLog::retrieveByid($_GET['id']);
// 		echo json_encode($obj);
// 	}

// 	/**
// 	 * Get a list of debug entities for a uuid
// 	 * 
// 	 * @method GET
// 	 * @access public
// 	 * @param integer $uuid
// 	 * @return Array(DebugLog)
// 	 */
// 	if ($method == "get_debug_by_uuid") {
// 		if (empty($_GET['uuid'])) {
// 			die(sprintf('$uuid was not supplied'));
// 		}

// 		$obj = DebugLog::retrieveByuuid($_GET['uuid']);
// 		echo json_encode($obj);
// 	}

// 	/**
// 	 * Logs a debug entity
// 	 * 
// 	 * @method POST
// 	 * @access public
// 	 * @param mixed $body
// 	 * @return integer
// 	 */
// 	if ($method == "log_debug") {
// 		$body = file_get_contents('php://input');

// 		if (empty($body)) {
// 			die(sprintf('$body was not supplied'));
// 		}

// 		$body = json_decode($body, true);

// 		if (is_array($body) && count($body) == 2) {
// 			$debug = $body["debug"];
// 			$data = $body["data"];

// 			$log = new DebugLog;
// 			$log = append_debug_info($log, $debug);
// 			$log->event_date = $data['event_date'];
// 			$log->event_level = $data['event_level'];
// 			$log->event_category = $data['event_category'];
// 			$log->event_action = $data['event_action'];
// 			$log->event_label = $data['event_label'];
// 			$log->event_value = $data['event_value'];
// 			$log->save();

// 			$new_id = $log->id;
// 			echo $new_id;
// 		}

// 	}

?>