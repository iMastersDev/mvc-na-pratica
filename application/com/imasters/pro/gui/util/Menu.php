<?php
/**
 * Classes e objetos que representam a interface visual
 * da aplicação
 * @package	com.imasters.pro.view
 */

require_once 'com/imasters/pro/gui/base/Anchor.php';
require_once 'com/imasters/pro/gui/base/Text.php';
require_once 'com/imasters/pro/gui/list/UnorderedList.php';
require_once 'com/imasters/pro/gui/util/MenuItem.php';

/**
 * Implementação de um menu da aplicação
 * @author	João Batista Neto
 */
class Menu extends UnorderedList {
	public function __construct() {
		parent::__construct();

		$this->setId( 'menu' );
	}

	/**
	 * Adiciona um item ao menu.
	 * @param	string $name Texto que será exibido ao usuário
	 * @param	string $link Link do item do menu
	 * @return	MenuItem O item do menu recém adicionado
	 */
	public function addItem( $name , $link ) {
		$menuItem = new MenuItem();
		$anchor = $menuItem->addChild( new Anchor( $link ) );
		$anchor->addChild( new Text( $name ) );

		$this->addChild( $menuItem );

		return $menuItem;
	}
}