<?php

require '../../vendor/autoload.php'; // autoload the classes

use AskAlko\GetTableData;

//header("Access-Control-Allow-Origin: *"); // Dev fix CORS issue if you don't have a browser plugin   

$get_table_data = new GetTableData();
//$db_info = $get_table_data->getDbInfo();
$product_columns = $get_table_data->getProductColumnNames();
$id_index = array_search('id', $product_columns['product_columns'], TRUE);
// unset removes the index and JS will pick it up as an object, so use array_slice to remove the 
array_splice($product_columns['product_columns'], $id_index, 1);

echo json_encode($product_columns);