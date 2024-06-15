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
	const PRODUCT_COLUMNS = ['product_number','product_name','manufacturer','bottle_size','price','cost_per_liter','newness','price_list_order_code','product_type','subtype','special_group','beer_type','country_of_origin','product_region','vintage','etiquette_entries','product_note','grapes','characterization','packaging_type','enclosure','alcohol_percent','acid_grams_per_liter','sugar_grams_per_liter','kantavierrep_percent','color_ebc','bitter_ebu','energy_kcal_per_100ml','selection','european_article_umber'];
	private $searchableColumns = [
		'product_number',
		'product_name',
		'manufacturer',
		'bottle_size',
		'price',
		'cost_per_liter',
		'newness',
		'product_type',
		'subtype',
		'special_group',
		'beer_type',
		'country_of_origin',
		'product_region',
		'vintage',
		'product_note',
		'grapes',
		'characterization',
		'packaging_type',
		'enclosure',
		'alcohol_percent',
		'acid_grams_per_liter',
		'sugar_grams_per_liter',
		'kantavierrep_percent',
		'color_ebc',
		'bitter_ebu',
		'energy_kcal_per_100ml',
		'selection'
	];


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
		$column_names = [
			'product_name',
			'manufacturer',
			'bottle_size',
			'price',
			'cost_per_liter',
			'newness',
			'product_type',
			'subtype',
			'special_group',
			'beer_type',
			'country_of_origin',
			'product_region',
			'vintage',
			'product_note',
			'grapes',
			'characterization',
			'packaging_type',
			'enclosure',
			'alcohol_percent',
			'acid_grams_per_liter',
			'sugar_grams_per_liter',
			'kantavierrep_percent',
			'color_ebc',
			'bitter_ebu',
			'energy_kcal_per_100ml',
			'selection'
		];

		$results = [];

		foreach ($column_names as $column) {
			$stmt = $this->pdo->prepare("SELECT DISTINCT {$column} FROM product;");
			$stmt->execute();
			$product = $stmt->fetch();
			$results[$column] = $product;
		}

		return $results; 
	}

	/**
	 * Get product table column names 
	 * 
	 * @return array
	 */
	public function getProductColumnNames() {
		$stmt = $this->pdo->prepare('PRAGMA table_info(product)');
		$stmt->execute();
		$product_columns = $stmt->fetchAll(PDO::FETCH_COLUMN, 1);

		$results['product_columns'] = $product_columns;
		unset($results['product_columns'][0]);

		return $results; 
	}

	public function getColumnData(array $requestData = [])
	{
		try {
			$column = $requestData['column'];
			$limit = (int) $requestData['resultLimit'];

			if (empty($limit)) {
				$limit = 25;
			}

			// Can't use PDO parameter on column, so manually sanitize it
			if (!in_array($column, self::PRODUCT_COLUMNS)) return "Request not a table column";
		
			$results = [];

			$stmt = $this->pdo->prepare(
				"SELECT DISTINCT $column 
				FROM product 
				WHERE $column IS NOT NULL 
				AND $column != '' 
				ORDER BY $column 
				LIMIT $limit;");

		
			$stmt->execute();
			$db_column_select = $stmt->fetchAll();
			foreach ($db_column_select as $k => $row) {
				if (!empty($row[$column])) {
					$results[] = $row[$column];
				}
			}

			// asort($results);
			return $results; 
		} catch (PDOException $e) {
			throw new PDOException( $e->getMessage(), (int)$e->getCode() );
		}
	}

	public function getQueryData(array $requestData = []) {
		$sqlQuery = $requestData['sqlQuery'];
		$limit = (int) $requestData['resultLimit'];
		$results['queryResults'] = [];

		if (empty($limit)) {
			$limit = 0;
		}

		$stmt = $this->pdo->prepare($sqlQuery);
		$stmt->execute();
		$db_info = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$db_info = !empty($db_info) ? array_slice($db_info, 0, $limit) : [];

		foreach ($db_info as $row) {
			$results['queryResults'][] = $row;
		}

		$results['columns'] = !empty($results['queryResults']) ? array_keys($db_info[0]) : [];
		return $results;
	}

}
