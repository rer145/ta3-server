<?php

	class BaseEntity extends SimpleORM
	{
		protected function filterIn_uuid($data) {
			if (empty($data["id"])) {
				$data["id"] = "UUID()";
			}
			return $data;
		}
	}

	class AnalysisLog extends BaseEntity
	{
		protected function filterOut()
		{
			$this->selections = AnalysisSelections::retrieveByAnalysis_id($this->id);
			$this->results = AnalysisResults::retrieveByAnalysis_id($this->id);
		}
	}

	class AnalysisSelections extends BaseEntity {}

	class AnalysisResults extends BaseEntity {}

?>