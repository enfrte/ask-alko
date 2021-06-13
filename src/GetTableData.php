<?php 
/**
 * Gets the general info and column names of the database
 */
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
	private $productColumns = ['product_number','product_name','manufacturer','bottle_size','price','cost_per_liter','newness','price_list_order_code','product_type','subtype','special_group','beer_type','country_of_origin','product_region','vintage','etiquette_entries','product_note','grapes','characterization','packaging_type','enclosure','alcohol_percent','acid_grams_per_liter','sugar_grams_per_liter','kantavierrep_percent','color_ebc','bitter_ebu','energy_kcal_per_100ml','selection','european_article_umber'];

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

	public function getColumnData($column = null)
	{
		// Can't use PDO parameter on column, so manually sanitize it
		if (!in_array($column, $this->productColumns)) return "Request not a tablecolumn";
	
		$results = [];

		$stmt = $this->pdo->prepare("SELECT DISTINCT $column FROM product LIMIT 10");

		try {
			$stmt->execute();
			$db_column_select = $stmt->fetchAll();
			foreach ($db_column_select as $k => $row) {
				$results['columnData'][] = $row[$column];
			}
			return $results; 
		} catch (PDOException $Exception) {
			throw new MyDatabaseException( $Exception->getMessage(), (int)$Exception->getCode() );
		}

	}

}
