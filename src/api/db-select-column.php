<?php

require '../../vendor/autoload.php'; // autoload the classes

use AskAlko\GetTableData;

$requestData = $_GET['column'];

$get_table_data = new GetTableData();
$data = $get_table_data->getColumnData($requestData);
//$product_columns = $get_table_data->getProductColumnNames();
// echo json_encode($db_data);

// use template engine to output table
$loader = new \Twig\Loader\FilesystemLoader('../templates');

$twig = new \Twig\Environment($loader);
$twig->addExtension(new \Twig\Extension\DebugExtension());

$template = $twig->load('select-column-table.php');
echo $template->render(['data' => $data]);
