<?php

require '../vendor/autoload.php'; // autoload the classes

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use AskAlko\GetTableData;

echo "<h1>Welcome to the index.</h1> ";

$get_table_data = new GetTableData();
$db_results = $get_table_data->getDbInfo();

echo $db_results['pricelist_date'];
echo $db_results['db_note'];