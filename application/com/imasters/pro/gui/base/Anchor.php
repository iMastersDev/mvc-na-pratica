<?php
/**
 * Classes e objetos básicos da marcação HTML
 * @package	com.imasters.pro.gui.base
 */

require_once 'com/imasters/pro/gui/HTMLComposite.php';

/**
 * Implementação da tag A
 * @author	João Batista Neto
 */
class Anchor extends HTMLComposite {
	/**
	 * @param	string $href
	 */
	public function __construct( $href = null ) {
		parent::__construct();

		if ( !is_null( $href ) ) {
			$this->setHref( $href );
		}
	}

	/**
	 * Recupera o valor do atributo href.
	 * @return	string
	 * @see		Component::getAttribute()
	 */
	public function getHref() {
		return $this->getAttribute( 'href' );
	}

	/**
	 * Recupera o valor do atributo name.
	 * @return	string
	 * @see		Component::getAttribute()
	 */
	public function getName() {
		return $this->getAttribute( 'name' );
	}

	/**
	 * @see		HTMLComposite::nodeName()
	 */
	protected function nodeName() {
		return 'a';
	}

	/**
	 * Define o valor do atributo href do link.
	 * @param	string $href
	 * @return	Anchor Uma referência ao próprio componente.
	 * @see		Component::setAttribute()
	 */
	public function setHref( $href ) {
		return $this->setAttribute( 'href' , $href );
	}

	/**
	 * Define o valor do atributo name do link
	 * @param	string $name
	 * @return	Anchor Uma referência ao próprio componente
	 * @see		Component::setAttribute()
	 */
	public function setName( $name ) {
		return $this->setAttribute( 'name' , $name );
	}
}