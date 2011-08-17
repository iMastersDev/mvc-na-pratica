<?php
/**
 * Classes e objetos de formulário da marcação HTML
 * @package	com.imasters.pro.gui.form
 */

require_once 'com/imasters/pro/gui/HTMLComposite.php';

/**
 * Implementação do elemento label
 * @author	João Batista Neto
 */
class Label extends HTMLComposite {
	/**
	 * @param	Component $label
	 */
	public function __construct( Component $label = null ) {
		parent::__construct();

		if ( !is_null( $label ) ) {
			$this->addChild( $label );
		}
	}

	/**
	 * Recupera o ID do alvo desse Label.
	 * @return	string
	 */
	public function getFor() {
		return $this->getAttribute( 'for' );
	}

	/**
	 * @return	string
	 * @see		HTMLComposite::nodeName()
	 */
	protected function nodeName() {
		return 'label';
	}

	/**
	 * Define o alvo do label.
	 * @param	Input $input
	 * @return	Label Uma referência ao próprio component.
	 * @see		Component::setAttribute()
	 */
	public function setFor( Input $input ) {
		$id = $input->getId();

		if ( $id == null ) {
			$id = $input->generateId()->getId();
		}

		return $this->setAttribute( 'for' , $id );
	}
}