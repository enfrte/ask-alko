<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://unpkg.com/htmx.org@1.9.12" integrity="sha384-ujb1lZYygJmzgSwoxRggbCHcjc0rB2XoQrxeTUQyRjrOnlCoYta87iKBWq3EsdM2" crossorigin="anonymous"></script>
	<style>
		.pointer {
			cursor: pointer;
		}
	</style>
	<title>Ask Alko</title>
</head>
<body>
	<?php
	require '../vendor/autoload.php'; // autoload the classes

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	use AskAlko\GetTableData;

	$get_table_data = new GetTableData();
	$db_info = $get_table_data->getDbInfo();
	$product_columns = $get_table_data->getProductColumnNames();
	?>

	<div class="container">
		<h2 class="pt-3">Ask Alko</h2>
		<h4><?php echo $db_info['pricelist_date']; ?></h4>
		<p><?php echo $db_info['db_note']; ?></p>

		<div class="row">
			<div class="col-md-12">
				<h5>Column names</h5>

				<p class="mb-1">Click on a column name to select sample data</p>

				<?php foreach ($product_columns['product_columns'] as $value) { ?>
					<span class="badge bg-secondary rounded-pill pointer"
						hx-post="api/db-select-column.php"
						hx-target="#selected-column"
						hx-include="#resultLimit"
						hx-vals='{ "column": "<?php echo $value; ?>" }'>
						<?php echo $value; ?>
					</span>
				<?php } ?>
			</div>
			<div class="col-md-12">
				<p class="pt-3"><strong>There can be over 10000 results, so apply a sane limit!</strong></p>
			
				<div class="input-group mb-3">
					<span class="input-group-text" id="basic-addon1">Result limit</span>
					<input type="number" value="25" class="form-control" id="resultLimit" name="resultLimit" aria-label="Username" aria-describedby="basic-addon1">
				</div>
				
				<div class="mb-3">
					<h5>SQL Query</h5>
					<p>Query Alko's product table. Select a column name above to get sample data to work with.</p>
					<textarea class="form-control" id="sqlQuery" name="sqlQuery" rows="3">SELECT * FROM product</textarea>
				</div>
				<button type="button" class="btn btn-primary mb-3"
					hx-post="api/db-query.php"
					hx-target="#selected-column"
					hx-include="#resultLimit, #sqlQuery">
					Submit Query
				</button>

				<div id="selected-column">
					<div class="alert alert-info" role="alert">
						Select a table column or write an SQL query
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
