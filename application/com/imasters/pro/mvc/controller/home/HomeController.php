<?php
/**
 * Classes e objetos relacionados com os controladores
 * da aplicação
 * @package	com.imasters.pro.mvc.controller.home
 */

require_once 'com/imasters/pro/core/Object.php';
require_once 'com/imasters/pro/mvc/controller/Controller.php';
require_once 'com/imasters/pro/mvc/view/home/HomeView.php';

/**
 * Controlador da Home
 * @author	João Batista Neto
 */
class HomeController extends Object implements Controller {
	/**
	 * @return	boolean
	 * @see		Controller::canHandle()
	 */
	public function canHandle() {
		return !isset( $_GET[ 'c' ] ) || $_GET[ 'c' ] == 'home';
	}

	/**
	 * @see		Controller::handle()
	 */
	public function handle() {
		$view = new HomeView( Registry::getInstance()->get( 'modelFactory' )->createProducts() );
		$view->show();
	}
}