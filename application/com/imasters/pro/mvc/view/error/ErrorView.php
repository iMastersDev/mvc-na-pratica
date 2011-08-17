<?php
/**
 * Classes e objetos que representam a View da aplicação
 * @package	com.imasters.pro.view.error
 */

require_once 'com/imasters/pro/gui/base/Paragraph.php';
require_once 'com/imasters/pro/gui/base/Heading.php';
require_once 'com/imasters/pro/mvc/view/ApplicationView.php';

/**
 * View que avisa o usuário sobre um erro na aplicação
 * @author	João Batista Neto
 */
class ErrorView extends ApplicationView {
	/**
	 * @var	string
	 */
	private $errorMessage;

	/**
	 * @see		ApplicationView::createUserInterface()
	 */
	protected function createUserInterface() {
		parent::createUserInterface();

		//Recupera o título da página de erro
		$title = Application::getInstance()->getBundle()->getString( 'ERROR_TITLE' );

		//Define o título da página
		$this->setTitle( $title );

		//Adiciona as informações sobre o erro
		$this->contentPanel->addChild( new Heading( 2 ) )->addChild( new Text( $title ) );
		$this->contentPanel->addChild( new Paragraph() )->addChild( new Text( $this->errorMessage ) );
	}

	/**
	 * Define a mensagem de erro.
	 * @param	string $errorMessage
	 */
	public function setMessage( $errorMessage ) {
		$this->errorMessage = $errorMessage;
	}
}