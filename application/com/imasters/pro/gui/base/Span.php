<?php
/**
 * Classes e objetos básicos da marcação HTML
 * @package	com.imasters.pro.gui.base
 */

require_once 'com/imasters/pro/gui/HTMLComposite.php';

/**
 * Implementação do elemento span
 * @author	João Batista Neto
 */
class Span extends HTMLComposite {
	/**
	 * @return	string
	 * @see		HTMLComposite::nodeName()
	 */
	protected function nodeName() {
		return 'span';
	}
}