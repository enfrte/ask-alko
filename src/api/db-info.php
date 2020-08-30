<?php

require '../../vendor/autoload.php'; // autoload the classes

use AskAlko\GetTableData;

//header("Access-Control-Allow-Origin: *"); // Dev fix CORS issue if you don't have a browser plugin   

$get_table_data = new GetTableData();
$db_info = $get_table_data->getDbInfo();
//$product_columns = $get_table_data->getProductColumnNames();

echo json_encode($db_info);