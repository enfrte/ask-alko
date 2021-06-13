<?php // Launch this as a cron job

require __dir__.'/vendor/autoload.php'; // autoload the classes

$webRootPath = __dir__.''; // Optional path to web application root 
//shell_exec('php '.$webRootPath.'\src\db\CreateDB.php');
require $webRootPath.'\src\db\CreateDB.php';

// You should see the message "File downloaded. Tables created. Data imported. - Done"