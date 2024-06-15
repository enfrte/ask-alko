<?php

require '../../vendor/autoload.php'; // autoload the classes

use AskAlko\GetTableData;

$get_table_data = new GetTableData();
$data = $get_table_data->getQueryData($_POST);

$loader = new \Twig\Loader\FilesystemLoader('../templates');

$twig = new \Twig\Environment($loader);
$twig->addExtension(new \Twig\Extension\DebugExtension());

$template = $twig->load('select-query-table.php');
echo $template->render([
	'sqlQuery' => $data['queryResults'],
	'columns' => $data['columns']
]);
