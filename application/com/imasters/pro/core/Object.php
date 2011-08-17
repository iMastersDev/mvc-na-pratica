<?php
/**
 * Classes e objetos de base da aplicação
 * @package	com.imasters.pro.core
 */

require_once 'com/imasters/pro/core/Observer.php';
require_once 'com/imasters/pro/core/Subject.php';

/**
 * Objeto primitivo da aplicação
 * @author	João Batista Neto
 */
class Object implements Observer, Subject {
	/**
	 * @var	array
	 */
	private $observers = array();

	/**
	 * Recupera uma representação como string do objeto.
	 * @return	string
	 */
	public function __toString() {
		return sprintf( '%s@%s' , $this->getClass()->getName() , $this->hashCode() );
	}

	/**
	 * @param	Observer $observer
	 * @see		Subject::attach()
	 */
	public function attach( Observer $observer ) {
		$hash = $observer->hashCode();

		if ( !isset( $this->observers[ $hash ] ) ) {
			$this->observers[ $hash ] = $observer;
		}
	}

	/**
	 * @param	Observer $observer
	 * @see		Subject::detach()
	 */
	public function detach( Observer $observer ) {
		$hash = $observer->hashCode();

		if ( isset( $this->observers[ $hash ] ) ) {
			unset( $this->observers[ $hash ] );
		}
	}

	/**
	 * Recupera uma instância de ReflectionClass para esse objeto.
	 * @return	ReflectionClass
	 */
	public function getClass() {
		return new ReflectionClass( get_class( $this ) );
	}

	/**
	 * @return	string
	 * @see		Observer::hashCode()
	 */
	public function hashCode() {
		return spl_object_hash( $this );
	}

	/**
	 * @see		Subject::notify()
	 */
	public function notify() {
		foreach ( $this->observers as $observer ) {
			$observer->update( $this );
		}
	}

	/**
	 * @param	Subject $subject
	 * @see		Observer::update()
	 */
	public function update( Subject $subject ) {
	}
}