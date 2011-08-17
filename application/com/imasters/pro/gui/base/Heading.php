<?php
/**
 * Classes e objetos básicos da marcação HTML
 * @package	com.imasters.pro.gui.base
 */

require_once 'com/imasters/pro/gui/HTMLComposite.php';

/**
 * Implementação da marcação H1 - H6
 * @author	João Batista Neto
 */
class Heading extends HTMLComposite {
	/**
	 * @var	integer
	 */
	private $level = 1;

	/**
	 * @param	integer $level
	 * @throws	UnexpectedValueException Se $level não for um inteiro
	 * 			no intervalo de 1 até 6.
	 */
	public function __construct( $level = 1 ) {
		parent::__construct();

		if ( is_int( $level ) && $level >= 1 && $level <= 6 ) {
			$this->level = $level;
		} else {
			throw new UnexpectedValueException( '$level precisa ser um inteiro entre 1 e 6 inclusive.' );
		}
	}

	/**
	 * @return	string
	 * @see		HTMLComposite::nodeName()
	 */
	protected function nodeName() {
		return 'h' . $this->level;
	}
}