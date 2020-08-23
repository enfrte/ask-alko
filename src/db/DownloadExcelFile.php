<?php
namespace AskAlko\db;

use Exception;

class DownloadExcelFile {
  public function __construct() {
    $alkoExcelDB = "https://www.alko.fi/INTERSHOP/static/WFS/Alko-OnlineShop-Site/-/Alko-OnlineShop/fi_FI/Alkon%20Hinnasto%20Tekstitiedostona/alkon-hinnasto-tekstitiedostona.xlsx";

    $file_name = basename($alkoExcelDB);

    if (file_put_contents($file_name, file_get_contents($alkoExcelDB))) {
      echo "File downloaded";
    }
    else {
      echo "Failed to download file";
    }
/*
    try {
        file_put_contents($file_name, file_get_contents($alkoExcelDB));
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
*/
  }
}
