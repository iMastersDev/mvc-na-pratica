<?php
/**
 * Classes e objetos básicos da marcação HTML
 * @package	com.imasters.pro.gui.base
 */

require_once 'com/imasters/pro/gui/HTMLComposite.php';

/**
 * Implementação da tag P
 * @author	João Batista Neto
 */
class Paragraph extends HTMLComposite {
	/**
	 * @see		HTMLComposite::nodeName()
	 */
	protected function nodeName() {
		return 'p';
	}
}