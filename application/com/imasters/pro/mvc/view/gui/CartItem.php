<?php
/**
 * Componentes de interface de usuário específicos da aplicação
 * @package	com.imasters.pro.view.gui
 */

require_once 'com/imasters/pro/gui/base/Image.php';
require_once 'com/imasters/pro/gui/base/Span.php';
require_once 'com/imasters/pro/gui/form/Form.php';
require_once 'com/imasters/pro/gui/form/Input.php';
require_once 'com/imasters/pro/gui/form/Label.php';
require_once 'com/imasters/pro/gui/list/ListItem.php';

/**
 * Implementação de um produto em uma lista
 * @author	João Batista Neto
 */
class CartItem extends ListItem {
	/**
	 * @param	Product $product
	 * @param	integer $qtd
	 */
	public function __construct( Product $product , $qtd ) {
		parent::__construct();

		$resourceBundle = Application::getInstance()->getBundle();
		$idProduct = $product->getIdProduct();
		$moneyformat = $resourceBundle->getString( 'MONEY_FORMAT' );
		$productName = $product->getProductName();
		$productDescription = $product->getProductDescription();
		$productPrice = $product->getProductPrice();

		$form = $this->addChild( new Form( '/?c=cart&a=change&p=' . $idProduct ) );

		//Imagem do produto
		$form->addChild(
			new Image( $product->getProductImage() , $productName )
		)->setTitle( $productName )->setAttribute( 'width' , 80 )->setAttribute( 'height' , 80 );

		//Nome e descrição do produto
		$form->addChild( new Span() )->addStyle( 'name' )->addChild( new Text( $productName ) );
		$form->addChild( new Span() )->addStyle( 'desc' )->addChild( new Text( $productDescription ) );

		//Input com a quantidade de itens
		$form->addChild( new Label(
			new Text( $resourceBundle->getString( 'QUANTITY' )
		) ) )->addChild( new Input( 'qtd' ) )->setValue( $qtd );

		//Preço unitário
		$form->addChild( new Span() )->addStyle( 'price' )->addChild(
			new Text( money_format( $moneyformat , $productPrice ) )
		);

		//Preço total
		$form->addChild( new Span() )->addStyle( 'total' )->addChild(
			new Text( money_format( $moneyformat , $qtd * $productPrice ) )
		);

		//Botões para edição e exclusão do item do carrinho
		$form->addChild( new Input( 'save' , Input::SUBMIT ) )->setValue( $resourceBundle->getString( 'SAVE' ) );
		$form->addChild( new Input( 'del' , Input::SUBMIT ) )->setValue( $resourceBundle->getString( 'DELETE' ) );
	}
}