<?php
/**
 * Classes e objetos de formulário da marcação HTML
 * @package	com.imasters.pro.gui.form
 */

require_once 'com/imasters/pro/gui/HTMLComposite.php';

/**
 * Implementação do elemento li
 * @author	João Batista Neto
 */
class ListItem extends HTMLComposite {
	/**
	 * @return	string
	 * @see		HTMLComposite::nodeName()
	 */
	protected function nodeName() {
		return 'li';
	}
}