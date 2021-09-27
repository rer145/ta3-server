<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

	require "../lib/SimpleORM.class.php";
	include_once "../env.php";
	include_once "../db/db.php";
	include_once "../db/models.php";
	//include_once "../inc/api_helper.php";

	$temp = AnalysisLog::sql("SELECT COUNT(*) as cnt FROM analysislog", SimpleOrm::FETCH_ONE);
	$records = $temp->cnt;

	$size = !empty($_GET["size"]) ? $_GET["size"] : 50;
	$start = !empty($_GET["start"]) ? $_GET["start"] : 1;
	$end = !empty($_GET["end"]) ? $_GET["end"] : $size;

	$page = $end / $size;
	$pages = ($records / $size) + 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Transitional Analysis 3 Age Estimation</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>

	<div class="container-fluid">
		<div class="row">
			<div class="col">
				<div class="table-responsive">
					<table width="100%" class="table table-bordered table-sm table-hover">
					<thead class="thead-dark">
						<tr>
							<th>Analysis Date</th>
							<th>App</th>
							<th>R</th>
							<th>Code</th>
							<th>DB</th>
							<th>TA3BUM</th>
							<th>TA3OUM</th>
							<th>Platform</th>
							<th>Mode</th>
							<th>TTA</th>
							<th>Results</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						<?php
							//$items = AnalysisLog::all();
							$items = AnalysisLog::sql("SELECT * FROM :table WHERE id >= " . $start . " AND id <= " . $end);
							if (count($items) > 0)
							{
								foreach ($items as $item)
								{
									echo '<tr>';
									echo '<td>' . $item->analysis_date . '</td>';
									echo '<td>' . $item->app_version . '</td>';
									echo '<td>' . $item->r_version . '</td>';
									echo '<td>' . $item->r_code_version . '</td>';
									echo '<td>' . $item->db_version . '</td>';
									echo '<td>' . $item->ta3bum_version . '</td>';
									echo '<td>' . $item->ta3oum_version . '</td>';
									echo '<td>' . $item->platform . '</td>';
									echo '<td>' . $item->entry_mode . '</td>';
									echo '<td>' . round($item->time_to_analyze / 60, 2) . 's</td>';
									echo '<td>' . round($item->results[0]->estimated_age, 1) . ' (' . round($item->results[0]->lower_95_bound, 1) . ' - ' . round($item->results[0]->upper_95_bound, 1) . ')</td>';
									echo '<td><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#details-modal" data-analysis-id="' . $item->id . '">Details</button></td>';
									echo '</tr>';
								}
							}
						?>
					</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<nav>
					<ul class="pagination">
						<li class="page-item <?php if ($page == 1) echo ' disabled' ?>"><a class="page-link" href="index.php?page=<?php echo $page-1 ?>&start=<?php echo $start-$size-1 ?>&end=<?php echo $start-1 ?>">Previous</a></li>
						<?php
							for ($i = 1; $i <= $pages; $i++) {
								echo '<li class="page-item';
								if ($page == $i) echo ' active';
								echo '"><a class="page-link" href="index.php?page=' . $i . '&start=' . ((($i-1)*$size)+1) . '&end=' . ($i*$size) . '">' . $i . '</a></li>';
							}
						?>
						
						<li class="page-item <?php if ($page == $pages) echo ' disabled' ?>"><a class="page-link" href="index.php?page=<?php echo $page+1 ?>&start=<?php echo $end+1 ?>&end=<?php echo $end+$size ?>">Next</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>

	<div id="details-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="details-modal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Analysis Details</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div id="selections">
						<ul></ul>
					</div>
					<div id="results">
						<ul></ul>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#details-modal').on('show.bs.modal', function(e) {
				var btn = $(e.relatedTarget);
				var id = btn.data('analysis-id');
				var modal = $(this);

				$.ajax({
					url: '/api/data/analysis.php?id=' + id,
					type: 'get',
					success: function(response) {
						let json = JSON.parse(response);
						console.log(json);
						var s = modal.find("#selections ul");
						s.empty();
						for (let i = 0; i < json.selections.length; i++) {
							let li = $("<li></li>");
							li.html(json.selections[i].trait + " = " + json.selections[i].score);
							s.append(li);
						}

						var r = modal.find("#results ul");
						r.empty();
						r.append($("<li></li>").html("Sample Size = " + json.results[0].sample_size));
						r.append($("<li></li>").html("Estimated Age = " + json.results[0].estimated_age));
						r.append($("<li></li>").html("Lower 95% = " + json.results[0].lower_95_bound));
						r.append($("<li></li>").html("Upper 95% = " + json.results[0].upper_95_bound));
						r.append($("<li></li>").html("Std Error = " + json.results[0].std_error));
						r.append($("<li></li>").html("Correlation = " + json.results[0].corr));
					}
				});
			});
		});
	</script>

	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-73604903-11"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'UA-73604903-11');
	</script>

</body>
</html>