<?php
/**
 * Classes e objetos relacionados com a Model da aplicação
 * @package	com.imasters.pro.mvc.model.mysql
 */

require_once 'com/imasters/pro/core/Object.php';
require_once 'com/imasters/pro/mvc/model/entity/Product.php';
require_once 'com/imasters/pro/mvc/model/Products.php';

/**
 * Model e acesso a dados de produtos
 * @author	João Batista Neto
 */
class MySQLProducts extends Object implements Products {
	/**
	 * @param	integer $idProduct
	 * @return	Product
	 * @see		Products::getProductById()
	 */
	public function getProductById( $idProduct ) {
		$pdo = Registry::getInstance()->get( 'pdo' );
		$stm = $pdo->prepare( 'SELECT * FROM `Product` AS `p` WHERE `p`.`idProduct`=:idProduct;' );
		$stm->bindParam( ':idProduct' , $idProduct , PDO::PARAM_INT );
		$stm->setFetchMode( PDO::FETCH_CLASS , 'Product' );
		$stm->execute();

		$product = $stm->fetch();

		$stm->closeCursor();

		if ( $product instanceof Product ) {
			return $product;
		} else {
			throw new RuntimeException( 'Nenhum produto encontrado com o ID fornecido.' );
		}
	}

	/**
	 * @return	array
	 * @see		Products::getProducts()
	 */
	public function getProducts() {
		$pdo = Registry::getInstance()->get( 'pdo' );
		$stm = $pdo->prepare( 'SELECT * FROM `Product` AS `p` ORDER BY `p`.`productName`;' );
		$stm->setFetchMode( PDO::FETCH_CLASS , 'Product' );
		$stm->execute();

		return $stm->fetchAll();
	}
}