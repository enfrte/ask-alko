<?php 

namespace AskAlko;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use AskAlko\db\DbConnect;
use PDOException;
use PDO;

class GetTableData 
{
	private $pdo;

	function __construct() {
		$conn = DbConnect::getInstance();
		$this->pdo = $conn->getConnection();
	}

	/**
	 * Get db_info table values 
	 * 
	 * @return array
	 */
	public function getDbInfo() {
		$stmt = $this->pdo->prepare('SELECT pricelist_date, db_note FROM db_info');
		$stmt->execute();
		$db_info = $stmt->fetch();

		$results = [];
		$results['pricelist_date'] = $db_info['pricelist_date'];
		$results['db_note'] = $db_info['db_note'];

		return $results; 
	}

	/**
	 *  
	 * 
	 * @return array
	 */
	public function currentValues() {
		$stmt = $this->pdo->prepare('SELECT DISTINCT manufacturer FROM product');
		$stmt->execute();
		$product = $stmt->fetch();

		/*

bottle_size - min / max
price - min / max
cost_per_liter - min / max
newness
product_type
subtype
special_group
beer_type
country_of_origin
product_region
vintage - min / max
product_note
grapes
characterization - get unique word list
packaging_type
enclosure
alcohol_percent - min / max
acid_grams_per_liter - min / max
sugar_grams_per_liter - min / max
kantavierrep_percent - min / max
color_ebc - min / max
bitter_ebu - min / max
energy_kcal_per_100ml - min / max
selection
		 */

		$results['manufacturer'] = $product;

		return $results; 
	}

	/**
	 * Get product table column names 
	 * 
	 * @return array
	 */
	public function getProductColumnNames() {
		$stmt = $this->pdo->prepare("DESCRIBE product");
		$stmt->execute();
		$product_columns = $stmt->fetchAll(PDO::FETCH_COLUMN);

		$results['product_columns'] = $product_columns;

		return $results; 
	}

}
