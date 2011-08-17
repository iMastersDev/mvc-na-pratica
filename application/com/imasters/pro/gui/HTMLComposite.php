<?php
/**
 * Classes e objetos relacionados com a interface de usuário
 * @package	com.imasters.pro.gui
 */

require_once 'com/imasters/pro/gui/Composite.php';

/**
 * Base para implementação de componentes que representam um
 * elemento de marcação HTML.
 * @author	João Batista Neto
 */
abstract class HTMLComposite extends Composite {
	/**
	 * Adiciona um conteúdo texto ao componente.
	 * @param	string $text O texto que será adicionado.
	 * @throws	UnexpectedValueException Se $text não for  uma string
	 */
	public function addText( $text ) {
		if ( is_string( $text ) ) {
			$this->addChild( new Text( $text ) );
		} else {
			throw new UnexpectedValueException( '$text precisa ser uma string' );
		}

		return $this;
	}

	/**
	 *
	 * @see Component::draw()
	 */
	public function draw() {
		$name = $this->nodeName();

		return sprintf( '<%s%s>%s</%s>' , $name , $this->drawAttributes() , $this->drawChildren() , $name );
	}

	/**
	 * Recupera o nome da tag HTML do componente.
	 * @return	string
	 */
	protected abstract function nodeName();
}