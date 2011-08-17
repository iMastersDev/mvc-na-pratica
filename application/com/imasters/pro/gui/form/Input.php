<?php
/**
 * Classes e objetos de formulário da marcação HTML
 * @package	com.imasters.pro.gui.form
 */

require_once 'com/imasters/pro/gui/HTMLComposite.php';

/**
 * Implementação do elemento input
 * @author	João Batista Neto
 */
class Input extends HTMLComposite {
	const TEXT = 'text';
	const HIDDEN = 'hidden';
	const SUBMIT = 'submit';
	const RESET = 'reset';

	/**
	 * @param	string $name Nome do input
	 * @param	string $type Tipo do input
	 */
	public function __construct( $name , $type = Input::TEXT ) {
		parent::__construct();

		$this->setName( $name );
		$this->setType( $type );
	}

	/**
	 * Recupera o nome do input.
	 * @return	string
	 */
	public function getName() {
		return $this->getAttribute( $name );
	}

	/**
	 * Recupera o tipo do input.
	 * @return	string
	 */
	public function getType() {
		return $this->getAttribute( 'type' );
	}

	/**
	 * Recupera o valor do input.
	 * @return	string
	 */
	public function getValue() {
		return $this->getAttribute( 'value' );
	}

	/**
	 * @return	string
	 * @see		HTMLComposite::nodeName()
	 */
	protected function nodeName() {
		return 'input';
	}

	/**
	 * Define o nome do input.
	 * @param	string $name O nome do input
	 * @return	Input Uma referência ao próprio componente
	 * @see		Component::setAttribute()
	 */
	public function setName( $name ) {
		return $this->setAttribute( 'name' , $name );
	}

	/**
	 * Define o tipo do input.
	 * @param	string $type
	 * @return	Input Uma referência ao próprio componente.
	 * @see		Component::setAttribute()
	 */
	public function setType( $type ) {
		return $this->setAttribute( 'type' , $type );
	}

	/**
	 * Define o valor do input.
	 * @param	string $value
	 * @return	Input Uma referência ao próprio componente.
	 * @see		Component::setAttribute()
	 */
	public function setValue( $value ) {
		return $this->setAttribute( 'value' , $value );
	}
}