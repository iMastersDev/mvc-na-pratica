<?php
/**
 * Classes e objetos relacionados com os controladores
 * da aplicação
 * @package	com.imasters.pro.mvc.controller.cart
 */

require_once 'com/imasters/pro/core/Object.php';
require_once 'com/imasters/pro/mvc/controller/Controller.php';
require_once 'com/imasters/pro/mvc/view/cart/CartView.php';

/**
 * Controlador do carrinho
 * @author	João Batista Neto
 */
class CartController extends Object implements Controller {
	/**
	 * @return	boolean
	 * @see		Controller::canHandle()
	 */
	public function canHandle() {
		return isset( $_GET[ 'c' ] ) && $_GET[ 'c' ] == 'cart';
	}

	/**
	 * @see		Controller::handle()
	 */
	public function handle() {
		$cart = Registry::getInstance()->get( 'modelFactory' )->createCart();

		if ( isset( $_GET[ 'a' ] ) ) {
			if ( isset( $_GET[ 'p' ] ) && is_numeric( $_GET[ 'p' ] ) ) {
				switch ( $_GET[ 'a' ] ) {
					case 'add' :
						$cart->addProduct( $_GET[ 'p' ] );
						break;
					case 'change':
						$cart->changeProduct( $_GET[ 'p' ] );
						break;
					default:
						throw new RuntimeException( 'Não entendemos sua requisição.' );
				}
			} else {
				throw new RuntimeException( 'Não entendemos sua requisição.' );
			}
		}

		$view = new CartView( $cart );
		$view->show();
	}
}