<?php
/**
 * Classes e objetos básicos da marcação HTML
 * @package	com.imasters.pro.gui.base
 */

require_once 'com/imasters/pro/gui/Component.php';

/**
 * Implementação de um nó de texto
 * @author	João Batista Neto
 */
final class Text extends Component {
	/**
	 * @var	string
	 */
	private $text;

	/**
	 * @param	string $text
	 * @throws	InvalidArgumentException Se $text não for uma string
	 */
	public function __construct( $text ) {
		parent::__construct();

		if ( is_scalar( $text ) ) {
			$this->text = $text;
		} else {
			throw new InvalidArgumentException( '$text precisa ser uma string' );
		}
	}

	/**
	 * @return	string
	 * @see		Component::draw()
	 */
	public function draw() {
		return $this->text;
	}
}