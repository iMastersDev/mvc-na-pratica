<?php
/**
 * Classes e objetos de base da aplicação
 * @package	com.imasters.pro.core
 */

/**
 * Interface para definição de um objeto que observa outro por
 * modificações de estado.
 * @author	João Batista Neto
 */
interface Observer {
	/**
	 * Recupera um hash para identificação desse objeto.
	 * @return	string
	 */
	public function hashCode();

	/**
	 * Recebe notificação para se atualizar caso o objeto observado
	 * tenha sofrido uma mudança de estado.
	 * @param	Subject $subject O objeto que está sendo observado.
	 */
	public function update( Subject $subject );
}