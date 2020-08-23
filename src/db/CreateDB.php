<?php // Entry file for the cron job
namespace AskAlko\db;

use AskAlko\db\DownloadExcelFile;
use AskAlko\db\CreateTables;
use AskAlko\db\GenerateCSV;
use AskAlko\db\ImportSQL;

class CreateDB {
  public function __construct() {
    // Try/Catch?
    // Download file
    //$downloadExcelFile = new DownloadExcelFile();

    // Drop the old tables and create them again
    $createTables = new CreateTables();

    // Import CSV to DB
    $importSQL = new ImportSQL();

    echo ' - Done';
   }
}
$init = new CreateDB();
