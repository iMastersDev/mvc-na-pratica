<?php
/**
 * Classes e objetos que representam a interface visual
 * da aplicação
 * @package	com.imasters.pro.view
 */

require_once 'com/imasters/pro/gui/list/ListItem.php';

/**
 * Implementação de um menu da aplicação
 * @author	João Batista Neto
 */
class MenuItem extends ListItem {
	public function __construct() {
		parent::__construct();

		$this->addStyle( 'menu-item' );
	}
}