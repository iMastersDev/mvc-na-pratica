<?php
/**
 * Classes e objetos relacionados com a Model da aplicação
 * @package	com.imasters.pro.mvc.model
 */

require_once 'com/imasters/pro/core/Object.php';
require_once 'com/imasters/pro/mvc/model/Cart.php';

/**
 * Interface para definição de uma fábrica abstrata para
 * criação das Model da aplicação.
 * @author	João Batista Neto
 */
abstract class ModelFactory extends Object {
	/**
	 * Cria uma instância da Model do Carrinho.
	 * @return	Cart
	 */
	public function createCart() {
		return new Cart();
	}

	/**
	 * Cria uma instância da Model de Produtos.
	 * @return	Products
	 */
	public abstract function createProducts();
}