<?php
/**
 * Classes e objetos que representam a View da aplicação
 * @package	com.imasters.pro.view.home
 */

require_once 'com/imasters/pro/gui/base/Heading.php';
require_once 'com/imasters/pro/gui/base/Span.php';
require_once 'com/imasters/pro/gui/base/Strong.php';
require_once 'com/imasters/pro/mvc/view/ApplicationView.php';
require_once 'com/imasters/pro/mvc/view/gui/CartList.php';

/**
 * View da home da aplicação
 * @author	João Batista Neto
 */
class CartView extends ApplicationView {
	/**
	 * @var	Cart
	 */
	private $cart;

	/**
	 * @param	Cart $cart
	 */
	public function __construct( Cart $cart ) {
		parent::__construct();

		$this->cart = $cart;
	}

	/**
	 * @see		ApplicationView::createUserInterface()
	 */
	protected function createUserInterface() {
		parent::createUserInterface();

		$this->addStyle( '/css/cart.css' );

		$resourceBundle = Application::getInstance()->getBundle();
		$products = $this->cart->getProducts();

		if ( count( $products ) == 0 ) {
			$this->contentPanel->addChild( new Heading( 2 ) )->addChild(
				new Text( $resourceBundle->getString( 'CART_NO_PRODUCT' ) )
			);
		} else {
			$this->contentPanel->addChild( new CartList() )->setProductList( $products );

			$totalParagraph = $this->contentPanel->addChild( new Paragraph() )->addStyle( 'cart-total' );

			//Total do carrinho
			$totalParagraph->addChild( new Strong() )->addChild(
				new Text( $resourceBundle->getString( 'CART_TOTAL' ) )
			);

			$totalParagraph->addChild( new Span() )->addChild(
				new Text(
					money_format( $resourceBundle->getString( 'MONEY_FORMAT' ) , $this->cart->getTotal() )
				)
			);

			//Botão de checkout
			$totalParagraph->addChild(
				new Anchor( '/?c=cart&a=checkout' )
			)->addStyle( 'checkout' )->addChild(
				new Text( $resourceBundle->getString( 'CART_CHECKOUT' ) )
			);
		}
	}
}