<?php
/**
 * Classes e objetos de formulário da marcação HTML
 * @package	com.imasters.pro.gui.form
 */

require_once 'com/imasters/pro/gui/HTMLComposite.php';

/**
 * Implementação do elemento form
 * @author	João Batista Neto
 */
class Form extends HTMLComposite {
	/**
	 * @param	string $action Ação do formulário.
	 * @param	string $method Método de envio do formulário.
	 */
	public function __construct( $action , $method = 'post' ) {
		parent::__construct();

		$this->setAction( $action );
		$this->setMethod( $method );
	}

	/**
	 * Recupera a ação do formulário.
	 * @return	string
	 */
	public function getAction() {
		return $this->getAttribute( 'action' );
	}

	/**
	 * Recupera o método de envio do formulário.
	 * @return	string
	 */
	public function getMethod() {
		return $this->getAttribute( 'method' );
	}

	/**
	 * @return	string
	 * @see		HTMLComposite::nodeName()
	 */
	protected function nodeName() {
		return 'form';
	}

	/**
	 * Define a ação do formulário.
	 * @param	string $action A ação do formulário.
	 * @return	Form Uma referência a esse componente.
	 * @see		Component::setAttribute()
	 */
	public function setAction( $action ) {
		return $this->setAttribute( 'action' , $action );
	}

	/**
	 * Define o método de envio do formulário.
	 * @param	string $method O método de envio do formulário.
	 * @return	Form Uma referência a esse componente.
	 * @see		Component::setAttribute()
	 */
	public function setMethod( $method ) {
		return $this->setAttribute( 'method' , $method );
	}
}