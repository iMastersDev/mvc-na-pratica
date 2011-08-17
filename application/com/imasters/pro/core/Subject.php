<?php
/**
 * Classes e objetos de base da aplicação
 * @package	com.imasters.pro.core
 */

require_once 'com/imasters/pro/core/Observer.php';

/**
 * Interface para definição de um objeto observável
 * @author	João Batista Neto
 */
interface Subject {
	/**
	 * Adiciona um objeto à lista de observadores.
	 * @param	Observer $observer
	 */
	public function attach( Observer $observer );

	/**
	 * Remove um objeto da lista de observadores.
	 * @param	Observer $observer
	 */
	public function detach( Observer $observer );

	/**
	 * Notifica todos os observadores em caso de mudança
	 * de estado.
	 */
	public function notify();
}