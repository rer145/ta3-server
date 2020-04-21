<?php

	class AnalysisLog extends SimpleORM
	{
		protected function filterOut()
		{
			$this->selections = AnalysisSelections::retrieveByAnalysis_id($this->id);
			$this->results = AnalysisResults::retrieveByAnalysis_id($this->id);
		}
	}

	class AnalysisSelections extends SimpleORM {}

	class AnalysisResults extends SimpleORM {}

	class DebugLog extends SimpleORM {}

?>