<?php

require '../vendor/autoload.php'; // autoload the classes

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use AskAlko\GetTableData;

echo "<h1>Welcome to the index</h1> ";

/** To do:
 * Do some javascripts to create a query based on selecting column names and other thing.
 */

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