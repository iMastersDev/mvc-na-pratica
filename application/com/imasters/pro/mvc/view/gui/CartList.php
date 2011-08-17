<?php
/**
 * Componentes de interface de usuário específicos da aplicação
 * @package	com.imasters.pro.view.gui
 */

require_once 'com/imasters/pro/gui/list/UnorderedList.php';
require_once 'com/imasters/pro/mvc/view/gui/CartItem.php';

/**
 * Implementação de uma lista de produtos
 * @author	João Batista Neto
 */
class CartList extends UnorderedList {
	public function __construct() {
		parent::__construct();

		$this->addStyle( 'cart-list' );
	}

	/**
	 * Define a lista de produtos
	 * @param	array $productList
	 * @return	CartList Uma referência ao próprio objeto.
	 */
	public function setProductList( array $productList ) {
		$item = 0;

		foreach ( $productList as $idProduct => $cartItem ) {
			if ( $cartItem[ 'product' ] instanceof Product ) {
				$productItem = $this->addChild( new CartItem( $cartItem[ 'product' ] , $cartItem[ 'qtd' ] ) );

				if ( $item++ & 1 ) {
					$productItem->addStyle( 'alt' );
				}
			}
		}

		return $this;
	}
}