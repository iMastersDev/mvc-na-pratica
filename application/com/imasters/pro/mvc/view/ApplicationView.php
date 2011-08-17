<?php
/**
 * Classes e objetos que representam a View da aplicação
 * @package	com.imasters.pro.view
 */

require_once 'com/imasters/pro/gui/base/Panel.php';
require_once 'com/imasters/pro/gui/util/Menu.php';
require_once 'com/imasters/pro/mvc/view/View.php';

/**
 * Base para implementação das Views da aplicação
 * @author	João Batista Neto
 */
abstract class ApplicationView extends View {
	/**
	 * @var	Menu
	 */
	protected $applicationMenu;

	/**
	 * @var	Panel
	 */
	protected $applicationPanel;

	/**
	 * @var	Panel
	 */
	protected $contentPanel;

	/**
	 * @see		View::createUserInterface()
	 */
	protected function createUserInterface() {
		$resourceBundle = Application::getInstance()->getBundle();

		//Definição do título da página principal da aplicação
		$this->setTitle( $resourceBundle->getString( 'MAIN_TITLE' ) );

		//Carregamento da folha de estilo principal da aplicação
		$this->addStyle( '/css/application.css' );

		//Painel principal
		$this->applicationPanel = $this->addChild( new Panel() );
		$this->applicationPanel->setId( 'application' );

		$topPanel = $this->applicationPanel->addChild( new Panel() );
		$topPanel->setId( 'top' );

		//Título da aplicação
		$topPanel->addChild( new Heading() )->addChild( new Anchor( '/' ) )->addChild(
			new Text( $resourceBundle->getString( 'SHORT_TITLE' ) )
		);

		//Criação do menu da aplicação
		$this->applicationMenu = $topPanel->addChild( new Menu() );

		foreach ( $resourceBundle->getResource( 'MENU' ) as $resourceItem ) {
			$this->applicationMenu->addItem(
				$resourceItem->getValue(),
				$resourceItem->getIterator()->current()->getValue()
			);
		}

		//Painel de conteúdo
		$this->contentPanel = $this->applicationPanel->addChild( new Panel() );
		$this->contentPanel->setId( 'content' );
	}
}