<?php

	class AnalysisLog extends SimpleORM
	{
		protected function filterOut()
		{
			$this->selections = AnalysisSelections::retrieveByanalysis_id($this->id);
			$this->results = AnalysisResults::retrieveByanalysis_id($this->id);
		}
	}

	class AnalysisSelections extends SimpleORM {}

	class AnalysisResults extends SimpleORM {}

	class DebugLog extends SimpleORM {}

?>