<?php
/**
 * Classes e objetos utilitários da aplicação
 * @package	com.imasters.pro.core
 */

require_once 'com/imasters/pro/core/Object.php';

/**
 * Implementação de um recurso.
 * @author	João Batista Neto
 */
class Resource extends Object implements IteratorAggregate {
	/**
	 * @var	string
	 */
	protected $id;

	/**
	 * @var	string
	 */
	protected $value;

	/**
	 * @var	array
	 */
	protected $resources = array();

	/**
	 * Recupera o ID do recurso.
	 * @return	string
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Recupera um Iterator de sub-recursos
	 * @return	Iterator
	 * @see		IteratorAggregate::getIterator()
	 */
	public function getIterator() {
		return new ArrayIterator( $this->resources );
	}

	/**
	 * Recupera o valor do recurso.
	 * @return	string
	 */
	public function getValue() {
		return $this->value;
	}
}