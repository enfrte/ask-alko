<?php

namespace AskAlko\db;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use AskAlko\db\DbConnect;
use SimpleXLSX;
use PDOException;
use PDO;

class ImportSQL {
  private $csv_file = 'alko-db.csv';
  private $importDataQuery;
  /*
  Info about the excel file 
  Row 1 = Alkon hinnasto 06.08.2020
  Row 2 = Note.! With the price list order code, you get the product groups back to the price list order.
  Row 3 = [Empty]			
  Row 4 = The column titles
  */

  public function __construct() {
    $db = DbConnect::getInstance();
    $conn = $db->getConnection();

    try {
      //$conn->query($this->importDataQuery);
      $excel_file = __DIR__."\alkon-hinnasto-tekstitiedostona.xlsx";

      if ( $xlsx = SimpleXLSX::parse($excel_file) ) {
        //print_r( $xlsx->rows() ); // example data

        // Add to info table
        $pricelistDate = $xlsx->getCell(0, 'A1'); // row 1 
        $note = $xlsx->getCell(0, 'A2'); // row 2 
        $infoTableQuery = "INSERT INTO db_info (pricelist_date, db_note) VALUES (:pricelistDate, :note);";
        // Add data into db_info table
        $pdo = $conn->prepare($infoTableQuery);
        $pdo->bindParam(':pricelistDate',$pricelistDate,PDO::PARAM_STR);
        $pdo->bindParam(':note',$note,PDO::PARAM_STR);
        $pdo->execute();

        $productColumns = [':product_number',':product_name',':manufacturer',':bottle_size',':price',':cost_per_liter',':newness',':price_list_order_code',':product_type',':subtype',':special_group',':beer_type',':country_of_origin',':product_region',':vintage',':etiquette_entries',':product_note',':grapes',':characterization',':packaging_type',':enclosure',':alcohol_percent',':acid_grams_per_liter',':sugar_grams_per_liter',':kantavierrep_percent',':color_ebc',':bitter_ebu',':energy_kcal_per_100ml',':selection',':european_article_umber'];
        $productColumnsImploded = implode(',', $productColumns);
        $productColumnsImplodedColumns = str_replace(":", "", $productColumnsImploded);
        $productTableQuery = "INSERT INTO product ($productColumnsImplodedColumns) VALUES ($productColumnsImploded)";
        
        $pdo = $conn->prepare($productTableQuery);

        foreach ($xlsx->rows() as $key => $row) {
          // ignore the first 4 rows
          if ($key > 3) {
            $exeArray = [];
            foreach($row as $k => $v) {
              $k = $productColumns[$k];
              $exeArray[$k] = $v; // like [':foo' => 'bar',]
            }
            $pdo->execute($exeArray);
          }
        }
        echo 'Data imported. ';
      } 
    }
    catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
    }
    $conn = null;
  }
}

