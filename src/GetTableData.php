<?php 

namespace AskAlko;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use AskAlko\db\DbConnect;
use PDOException;
use PDO;

/**
 * Get db_info table values and product table column names 
 * 
 * @return array
 */
class GetTableData 
{
	private $pdo;

	function __construct() {
		$conn = DbConnect::getInstance();
		$this->pdo = $conn->getConnection();
	}

	public function getDbInfo() {
		$stmt = $this->pdo->prepare('SELECT pricelist_date, db_note FROM db_info');
		$stmt->execute();
		$db_info = $stmt->fetch();

		$results = [];
		$results['pricelist_date'] = $db_info['pricelist_date'];
		$results['db_note'] = $db_info['db_note'];

		return $results; 
	}

	public function getProduct() {
		$stmt = $this->pdo->prepare('SELECT id FROM product');
		$stmt->execute();
		$product = $stmt->fetch();

		$results = [];
		$results['id'] = $product['id'];

		return $results; 
	}

}
