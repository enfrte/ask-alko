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

  const MODE_READ_WRITE = 'rw';
  const MODE_READ_ONLY = 'ro';
  
  public function __construct($mode = self::MODE_READ_ONLY) {
    try {
      $dsn = "sqlite:{$this->dbfile}";
      $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      ];
      if ($mode === self::MODE_READ_ONLY) {
        $options[PDO::SQLITE_ATTR_READONLY] = true;
      }
      $this->connection = new PDO($dsn, null, null, $options);
    }
    catch(PDOException $e){
      die("Failed to connect to DB: ". $e->getMessage());
    }
  }

  /*
  Get an instance of the Database
  @return Instance
  */	
  public static function getInstance($mode = 'rw') {
    if(!self::$_instance) {
          self::$_instance = new self($mode);
        }
      return self::$_instance;
    }

  // Magic method clone is empty to prevent duplication of connection
  private function __clone(){}
  
  // Get the connection	
  public function getConnection(){
    return $this->connection;
  }
}

?>


