<?php
/**
 * Classes e objetos básicos da marcação HTML
 * @package	com.imasters.pro.gui.base
 */

require_once 'com/imasters/pro/gui/Component.php';

/**
 * Implementação de uma imagem
 * @author	João Batista Neto
 */
class Image extends Component {
	/**
	 * @param	string $src
	 * @param	string $alt
	 */
	public function __construct( $src , $alt = null ) {
		parent::__construct();

		$this->setAttribute( 'src' , $src );

		if ( $alt != null ) {
			$this->setAttribute( 'alt' , $alt );
		}
	}

	/**
	 * @return	string
	 * @see		Component::draw()
	 */
	public function draw() {
		return sprintf( '<img%s />' , $this->drawAttributes() );
	}
}