<?php

namespace AskAlko\db;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use AskAlko\db\DbConnect;
use PDOException;

// Create the app tables
class CreateTables {
  private $scheemaDbInfo = <<<eof
  DROP TABLE IF EXISTS db_info;
  CREATE TABLE db_info (
    pricelist_date VARCHAR(65000) NOT NULL,
    db_note VARCHAR(65000)
  );
  eof;
  
  private $scheemaProduct = <<<eof
  DROP TABLE IF EXISTS product;
  CREATE TABLE product (
    id INT NOT NULL AUTO_INCREMENT,
    product_number INT NOT NULL,
    product_name VARCHAR(65000),
    manufacturer VARCHAR(65000),
    bottle_size VARCHAR(65000),
    price DECIMAL(10, 2),
    cost_per_liter DECIMAL(10, 2),
    newness VARCHAR(65000),
    price_list_order_code VARCHAR(65000),
    product_type VARCHAR(65000),
    subtype VARCHAR(65000),
    special_group VARCHAR(65000),
    beer_type VARCHAR(65000),
    country_of_origin VARCHAR(65000),
    product_region VARCHAR(65000),
    vintage SMALLINT UNSIGNED,
    etiquette_entries VARCHAR(65000),
    product_note VARCHAR(65000),
    grapes VARCHAR(65000),
    characterization VARCHAR(65000),
    packaging_type VARCHAR(65000),
    enclosure VARCHAR(65000),
    alcohol_percent DECIMAL(3, 1),
    acid_grams_per_liter DECIMAL(10, 1),
    sugar_grams_per_liter DECIMAL(10, 0),
    kantavierrep_percent DECIMAL(10, 1),
    color_ebc DECIMAL(10, 1),
    bitter_ebu DECIMAL(10, 1),
    energy_kcal_per_100ml DECIMAL(10, 1),
    selection VARCHAR(65000),
    european_article_umber VARCHAR(65000) NOT NULL,
    PRIMARY KEY (id)
  );
  eof;

  public function __construct() {
    $db = DbConnect::getInstance();
    $conn = $db->getConnection();

    try {
      $conn->query($this->scheemaDbInfo);
      $conn->query($this->scheemaProduct);
      echo 'Tables created. ';
      $conn = null;
    } 
    catch (PDOException $e) {
      echo '<pre>Error: '.$e->getMessage();
    }
  }
  
}
