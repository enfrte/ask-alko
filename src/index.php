<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
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

	echo '<pre>';
	foreach ($product_columns['product_columns'] as $value) {
		echo $value."\n";
	}
	echo '</pre>';


	echo $db_info['pricelist_date'];
	echo '<br>';
	echo $db_info['db_note'];
?>

</body>
</html>