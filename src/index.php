<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://unpkg.com/htmx.org@1.9.12" integrity="sha384-ujb1lZYygJmzgSwoxRggbCHcjc0rB2XoQrxeTUQyRjrOnlCoYta87iKBWq3EsdM2" crossorigin="anonymous"></script>
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

	foreach ($product_columns['product_columns'] as $value) {
		echo '<a hx-get="api/db-select-column.php?column='.$value.'" hx-target="#selected-column">'.$value.'</a>'.'<br>';
	}

	echo $db_info['pricelist_date'];
	echo '<br>';
	echo $db_info['db_note'];
	?>

	<div id="selected-column">Select a table column</div>
</body>
</html>