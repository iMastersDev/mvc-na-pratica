<?php
/**
 * Componentes de interface de usuário específicos da aplicação
 * @package	com.imasters.pro.view.gui
 */

require_once 'com/imasters/pro/gui/list/UnorderedList.php';
require_once 'com/imasters/pro/mvc/view/gui/ProductItem.php';

/**
 * Implementação de uma lista de produtos
 * @author	João Batista Neto
 */
class ProductList extends UnorderedList {
	public function __construct() {
		parent::__construct();

		$this->addStyle( 'product-list' );
	}

	/**
	 * Define a lista de produtos
	 * @param	array $productList
	 * @return	ProductList Uma referência ao próprio objeto.
	 */
	public function setProductList( array $productList ) {
		foreach ( $productList as $product ) {
			if ( $product instanceof Product ) {
				$this->addChild( new ProductItem( $product ) );
			}
		}

		return $this;
	}
}