<?php
/**
 * Classes e objetos relacionados com os controladores
 * da aplicação
 * @package	com.imasters.pro.mvc.controller
 */

require_once 'com/imasters/pro/core/Subject.php';
require_once 'com/imasters/pro/core/Observer.php';

/**
 * Interface para definição de um Controller que interpretará
 * as requisições do usuário.
 * @author	João Batista Neto
 */
interface Controller extends Observer, Subject {
	/**
	 * Verifica se esse Controller sabe como manipular a requisição
	 * do usuário.
	 * @return	boolean
	 */
	public function canHandle();

	/**
	 * Manipula a requisição do usuário.
	 */
	public function handle();
}