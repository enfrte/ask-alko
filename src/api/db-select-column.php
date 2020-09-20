<?php

require '../../vendor/autoload.php'; // autoload the classes

use AskAlko\GetTableData;

$requestData = $_GET['column'];

$get_table_data = new GetTableData();
$db_data = $get_table_data->getColumnData($requestData);
//$product_columns = $get_table_data->getProductColumnNames();

echo json_encode($db_data);