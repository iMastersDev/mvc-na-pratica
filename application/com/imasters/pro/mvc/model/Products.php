<?php
/**
 * Classes e objetos relacionados com a Model da aplicação
 * @package	com.imasters.pro.mvc.model
 */

/**
 * Interface para definição de uma Model com acesso a dados
 * de produtos
 * @author	João Batista Neto
 */
interface Products {
	/**
	 * Recupera um produto utilizando seu ID.
	 * @param	integer $idProduct
	 * @return	Product
	 */
	public function getProductById( $idProduct );

	/**
	 * Recupera um array com os produtos cadastrados.
	 * @return	array
	 */
	public function getProducts();
}