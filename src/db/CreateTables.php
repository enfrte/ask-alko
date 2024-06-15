<?php

namespace AskAlko\db;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use AskAlko\db\DbConnect;
use PDOException;

// Create the app tables
class CreateTables {
  private $tables = ['db_info', 'product'];

  private $scheemaDbInfo = <<<eof
  CREATE TABLE db_info (
    pricelist_date TEXT NOT NULL,
    db_note TEXT
  );
  eof;
  
  private $scheemaProduct = <<<eof
  CREATE TABLE product (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    product_number INTEGER NOT NULL,
    product_name TEXT,
    manufacturer TEXT,
    bottle_size TEXT,
    price REAL,
    cost_per_liter REAL,
    newness TEXT,
    price_list_order_code TEXT,
    product_type TEXT,
    subtype TEXT,
    special_group TEXT,
    beer_type TEXT,
    country_of_origin TEXT,
    product_region TEXT,
    vintage SMALLINT UNSIGNED,
    etiquette_entries TEXT,
    product_note TEXT,
    grapes TEXT,
    characterization TEXT,
    packaging_type TEXT,
    enclosure TEXT,
    alcohol_percent REAL,
    acid_grams_per_liter REAL,
    sugar_grams_per_liter INTEGER,
    kantavierrep_percent REAL,
    color_ebc REAL,
    bitter_ebu REAL,
    energy_kcal_per_100ml REAL,
    selection TEXT,
    european_article_umber TEXT NOT NULL
  );
  eof;

  public function __construct() {
    $db = DbConnect::getInstance(DbConnect::MODE_READ_WRITE);
    $conn = $db->getConnection();

    try {
      // $conn->query("PRAGMA journal_mode = OFF;"); // Disable the write-ahead log
      foreach ($this->tables as $table) {
        $conn->query('DROP TABLE IF EXISTS '.$table.';');
      }

      $conn->query($this->scheemaDbInfo);
      $conn->query($this->scheemaProduct);
      // $conn->query("PRAGMA query_only = 1;"); // Make the database read-only
      echo 'Tables created. ';
      $conn = null;
    } 
    catch (PDOException $e) {
      echo '<pre>Error: '.$e->getMessage();
    }
  }
  
}
