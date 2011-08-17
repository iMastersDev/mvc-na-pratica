<?php
/**
 * Classes e objetos utilitários da aplicação
 * @package	com.imasters.pro.core
 */

require_once 'com/imasters/pro/core/Object.php';

/**
 * Implementação de um registro de dados.
 * @author	João Batista Neto
 */
class Registry extends Object {
	/**
	 * @var	Registry
	 */
	private static $instance;

	/**
	 * @var	array
	 */
	private $registry;

	private function __construct() {
		$this->registry = array();
	}

	/**
	 * Recupera um valor registrado anteriormente.
	 * @param	string $name Chave registrada.
	 * @return	mixed O valor registrado.
	 * @throws	InvalidArgumentException Se a chave não estiver registrada.
	 */
	public function get( $name ) {
		if ( isset( $this->registry[ $name ] ) ) {
			return $this->registry[ $name ];
		} else {
			throw new InvalidArgumentException( 'Não existe um registro para a chave ' . $name . '.' );
		}
	}

	/**
	 * Recupera a instância de Registry.
	 * @return	Registry
	 */
	public static function getInstance() {
		if ( self::$instance == null ) {
			self::$instance = new Registry();
		}

		return self::$instance;
	}

	/**
	 * Verifica se uma determinada chave está no registro.
	 * @param	string $name
	 * @return	boolean
	 */
	public function has( $name ) {
		return isset( $this->registry[ $name ] );
	}

	/**
	 * Define um par chave=valor que será registrado,
	 * @param	string $name A chave do registro.
	 * @param	mixed $value O valor que será registrado.
	 */
	public function set( $name , $value ) {
		$this->registry[ $name ] = $value;
	}
}