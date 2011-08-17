<?php
/**
 * Classes e objetos relacionados com os controladores
 * da aplicação
 * @package	com.imasters.pro.mvc.controller
 */

require_once 'com/imasters/pro/core/Object.php';

/**
 * O gerenciador de Controllers permite que descubramos qual o
 * Controller que consegue manipular determinada requisição do
 * usuário.
 * @author	João Batista Neto
 */
class ControllerManager extends Object {
	/**
	 * Instância única do ControllerManager para evitar que, em
	 * outros pontos da aplicação, tenhamos instâncias redundantes.
	 * @var	ControllerManager
	 */
	private static $instance;

	/**
	 * Lista de Controllers anexados ao gerenciador.
	 * @var	array
	 */
	private $controllers;

	private function __construct() {
		$this->controllers = array();
	}

	/**
	 * Adiciona um Controller ao ControllerManager.
	 * @param	Controller $controller
	 * @return	boolean TRUE se o Controller tiver sido anexado ao
	 * 			gerenciador.
	 */
	public function addController( Controller $controller ) {
		$exists = false;

		// Verificando duplicatas
		foreach ( $this->controllers as $c ) {
			if ( $c == $controller ) {
				$exists = true;
				break;
			}
		}

		if ( !$exists ) {
			$this->controllers[] = $controller;

			return true;
		}

		return false;
	}

	/**
	 * Recupera a instância do ControllerManager.
	 * @return	ControllerManager
	 */
	public static function getInstance() {
		if ( self::$instance == null ) {
			self::$instance = new ControllerManager();
		}

		return self::$instance;
	}

	/**
	 * Identifica o Controller adequado para manipular a requisição do
	 * usuário e delega a responsabilidade de manipulação caso encontrado.
	 * @throws		RuntimeException Caso nenhum Controller saiba como
	 * 				manipular a requisição do usuário.
	 */
	public function handle() {
		$found = false;

		foreach ( $this->controllers as $controller ) {
			if ( $controller->canHandle() ) {
				$controller->handle();
				$found = true;

				break;
			}
		}

		if ( !$found ) {
			throw new RuntimeException( 'Nenhum controlador encontrado para manipular essa requisição.' );
		}
	}

	/**
	 * Remove um Controller do ControllerManager.
	 * @param	Controller $controller
	 * @return	boolean TRUE se o Controller tiver sido desanexado do
	 * 			gerenciador.
	 */
	public function removeController( Controller $controller ) {
		foreach ( $this->controllers as $offset => $c ) {
			if ( $c == $controller ) {
				unset( $this->controllers[ $offset ] );

				return true;
			}
		}

		return false;
	}
}