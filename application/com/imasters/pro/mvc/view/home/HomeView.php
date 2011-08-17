<?php
/**
 * Classes e objetos que representam a View da aplicação
 * @package	com.imasters.pro.view.home
 */

require_once 'com/imasters/pro/gui/base/Heading.php';
require_once 'com/imasters/pro/mvc/view/ApplicationView.php';
require_once 'com/imasters/pro/mvc/view/gui/ProductList.php';

/**
 * View da home da aplicação
 * @author	João Batista Neto
 */
class HomeView extends ApplicationView {
	/**
	 * @var	Products
	 */
	private $products;

	/**
	 * @param	Products $products
	 */
	public function __construct( Products $products ) {
		parent::__construct();

		$this->products = $products;
	}

	/**
	 * @see		ApplicationView::createUserInterface()
	 */
	protected function createUserInterface() {
		parent::createUserInterface();

		$this->addStyle( '/css/home.css' );

		$resourceBundle = Application::getInstance()->getBundle();
		$products = $this->products->getProducts();

		if ( count( $products ) == 0 ) {
			$this->contentPanel->addChild( new Heading( 2 ) )->addChild(
				new Text( $resourceBundle->getString( 'NO_PRODUCT' ) )
			);
		} else {
			$this->contentPanel->addChild( new ProductList() )->setProductList( $products );
		}
	}
}