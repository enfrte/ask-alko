<?php

namespace AskAlko\db;

use PDO;
use PDOException;

/*
* SQLite database class - only one connection alowed
*/
class DbConnect {
  private $connection;
  private static $_instance;
  private $dbfile = __DIR__.'/ask_alko.db'; // SQLite file path

  /*
  Get an instance of the Database
  @return Instance
  */	
  public static function getInstance(){
    if(!self::$_instance) {
          self::$_instance = new self();
        }
      return self::$_instance;
    }

  // Constructor
  private function __construct() {
    try {
      $this->connection = new PDO('sqlite:'.$this->dbfile);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
      die("Failed to connect to DB: ". $e->getMessage());
    }
  }

  // Magic method clone is empty to prevent duplication of connection
  private function __clone(){}
  
  // Get the connection	
  public function getConnection(){
    return $this->connection;
  }
}

?>

