<?php
/**
 * Classes e objetos relacionados com a Model da aplicação
 * @package	com.imasters.pro.mvc.model.mysql
 */

require_once 'com/imasters/pro/mvc/model/ModelFactory.php';
require_once 'com/imasters/pro/mvc/model/mysql/MySQLProducts.php';

/**
 * Fábrica de objetos Model que utilizam acesso a dados em
 * bancos MySQL
 * @author	João Batista Neto
 */
class MySQLFactory extends ModelFactory {
	public function __construct() {
		$registry = Registry::getInstance();

		if ( !$registry->has( 'pdo' ) ) {
			$resourceBundle = Application::getInstance()->getBundle();

			$registry->set( 'pdo',
				new PDO(
					$resourceBundle->getString( 'MYSQL_DSN' ),
					$resourceBundle->getString( 'MYSQL_USER' ),
					$resourceBundle->getString( 'MYSQL_PSWD' )
				)
			);
		}
	}

	/**
	 * @return	Products
	 * @see		ModelFactory::createProducts()
	 */
	public function createProducts() {
		return new MySQLProducts();
	}
}