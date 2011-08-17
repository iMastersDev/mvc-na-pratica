<?php
/**
 * Classes e objetos relacionados com a Model da aplicação
 * @package	com.imasters.pro.mvc.model
 */

require_once 'com/imasters/pro/core/Object.php';

/**
 * Implementação do carrinho de compras
 * @author	João Batista Neto
 */
class Cart extends Object {
	public function __construct() {
		if ( !isset( $_SESSION[ 'cart' ] ) ) {
			$_SESSION[ 'cart' ] = array();
		}
	}

	/**
	 * Adiciona um item ao carrinho.
	 * @param	integer $idProduct O ID do produto que será adicionado
	 */
	public function addProduct( $idProduct ) {
		//Somente adiciona ao carrinho se não existir ainda
		if ( !isset( $_SESSION[ 'cart' ][ $idProduct ] ) ) {
			$products = Registry::getInstance()->get( 'modelFactory' )->createProducts();
			$product = $products->getProductById( $idProduct );

			$_SESSION[ 'cart' ][ $idProduct ] = array(
				'product'	=> $product,
				'qtd'		=> 1
			);
		}
	}

	/**
	 * Modifica um item do carrinho.
	 * @param	integer $idProduct
	 * @throws	RuntimeException
	 */
	public function changeProduct( $idProduct ) {
		if ( isset( $_SESSION[ 'cart' ][ $idProduct ] ) ) {
			if ( isset( $_POST[ 'save' ] ) ) {
				if ( isset( $_POST[ 'qtd' ] ) && is_numeric( $_POST[ 'qtd' ] ) ) {
					$_SESSION[ 'cart' ][ $idProduct ][ 'qtd' ] = $_POST[ 'qtd' ];
				} else {
					throw new RuntimeException( 'Não entendi...' );
				}
			} else if ( isset( $_POST[ 'del' ] ) ) {
				unset( $_SESSION[ 'cart' ][ $idProduct ] );
			}
		} else {
			throw new RuntimeException( 'O produto que se deseja editar não foi encontrado.' );
		}
	}

	/**
	 * Recupera a lista de produtos que está no carrinho.
	 * @return	array
	 */
	public function getProducts() {
		return isset( $_SESSION[ 'cart' ] ) ? $_SESSION[ 'cart' ] : array();
	}

	/**
	 * Recupera o total do carrinho.
	 * @return	float
	 */
	public function getTotal() {
		$total = 0;

		foreach ( $this->getProducts() as $cartItem ) {
			$total += $cartItem[ 'qtd' ] * $cartItem[ 'product' ]->getProductPrice();
		}

		return $total;
	}
}