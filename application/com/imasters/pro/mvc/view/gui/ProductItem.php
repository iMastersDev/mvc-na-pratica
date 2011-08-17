<?php
/**
 * Componentes de interface de usuário específicos da aplicação
 * @package	com.imasters.pro.view.gui
 */

require_once 'com/imasters/pro/gui/base/Image.php';
require_once 'com/imasters/pro/gui/list/DefinitionDescription.php';
require_once 'com/imasters/pro/gui/list/DefinitionList.php';
require_once 'com/imasters/pro/gui/list/DefinitionTerm.php';
require_once 'com/imasters/pro/gui/list/ListItem.php';

/**
 * Implementação de um produto em uma lista
 * @author	João Batista Neto
 */
class ProductItem extends ListItem {
	/**
	 * @param	Product $product
	 */
	public function __construct( Product $product ) {
		parent::__construct();

		$resourceBundle = Application::getInstance()->getBundle();
		$productName = $product->getProductName();
		$moneyFormat = $resourceBundle->getString( 'MONEY_FORMAT' );
		$buy = $resourceBundle->getString( 'BUY' );

		$definitionList = $this->addChild( new DefinitionList() );
		$definitionList->addChild( new DefinitionTerm() )->addChild(
			new Text( $productName )
		);

		$definitionList->addChild( new DefinitionDescription() )->addStyle( 'description' )->addChild(
			new Text( $product->getProductDescription() )
		);

		$definitionList->addChild( new DefinitionDescription() )->addStyle( 'image' )->addChild(
			new Image( $product->getProductImage() , $productName )
		)->setAttribute( 'width' , 190 )->setAttribute( 'height' , 190 )->setTitle( $productName );

		$definitionList->addChild( new DefinitionDescription() )->addStyle( 'price' )->addChild(
			new Text( money_format( $moneyFormat , $product->getProductPrice() ) )
		);

		$this->addChild(
			new Anchor( '/?c=cart&a=add&p=' . $product->getIdProduct() )
		)->setTitle( $buy )->addStyle( 'buy-button' )->addChild(
			new Text( $buy )
		);
	}
}