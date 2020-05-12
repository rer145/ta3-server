<?php
	function append_debug_info($obj, $debug) {
		$obj->uuid = $debug['uuid'];
		$obj->session = $debug['session'];
		$obj->app_version = $debug['app_version'];
		$obj->r_version = $debug['r_version'];
		$obj->r_code_version = $debug['r_code_version'];
		$obj->db_version = $debug['db_version'];
		$obj->ta3bum_version = $debug['ta3bum_version'];
		$obj->ta3oum_version = $debug['ta3oum_version'];
		$obj->platform = $debug['platform'];
		$obj->platform_release = $debug['platform_release'];
		$obj->arch = $debug['arch'];
		$obj->node_version = $debug['node_version'];
		$obj->electron_version = $debug['electron_version'];
		$obj->chrome_version = $debug['chrome_version'];
		$obj->locale = $debug['locale'];
		$obj->locale_country_code = $debug['locale_country_code'];
		$obj->arguments = $debug['arguments'];
		$obj->entry_mode = $debug['entry_mode'];

		return $obj;
	}
?>