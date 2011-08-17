<?php
/**
 * Classes e objetos relacionados com a interface de usuário
 * @package	com.imasters.pro.gui
 */

require_once 'com/imasters/pro/gui/Component.php';

/**
 * Interface para definição de um elemento de interface de usuário
 * que pode conter elementos como filho.
 * @author	João Batista Neto
 */
abstract class Composite extends Component implements Countable, IteratorAggregate {
	/**
	 * @var	array
	 */
	private $children;

	public function __construct() {
		parent::__construct();

		$this->children = array();
		$this->total = 0;
	}

	/**
	 * Adiciona um componente como filho desse componente.
	 * @param	Component $child O filho que será adicionado.
	 * @return	Component O filho recém adicionado.
	 * @throws	LogicException Se o componente já for filho de outro pai.
	 */
	public function addChild( Component $child ) {
		$this->children[ $child->hashCode() ] = $child;

		return $child->setParent( $this );;
	}

	/**
	 * Verifica se esse componente possui um determinado componente
	 * como filho.
	 * @param	Component $child O filho que será verificado.
	 * @return	boolean TRUE se o componente verificado for filho
	 * 			desse componente.
	 */
	public function contains( Component $child ) {
		return isset( $this->children[ $child->hashCode() ] );
	}

	/**
	 * @return	integer O total de filhos desse componente.
	 * @see		Countable::count()
	 */
	public function count() {
		return count( $this->children );
	}

	/**
	 * Desenha todos os filhos do componente.
	 * @return	string
	 */
	protected function drawChildren() {
		$children = null;

		foreach ( $this->children as $child ) {
			$children .= $child->draw();
		}

		return $children;
	}

	/**
	 * @return	Iterator Iterator de filhos do componente
	 * @see		IteratorAggregate::getIterator()
	 */
	public function getIterator() {
		return new ArrayIterator( $this->children );
	}

	/**
	 * Remove um filho desse componente.
	 * @param	Component $child O filho que será removido.
	 * @return	Composite Uma referência a esse componente.
	 * @throws	InvalidArgumentException Se o componente informado não
	 * 			for filho desse componente.
	 */
	public function removeChild( Component $child ) {
		$hash = $child->hashCode();

		if ( isset( $this->children[ $hash ] ) ) {
			unset( $this->children[ $hash ] );

			$child->setOrphan();

			return $this;
		} else {
			throw new InvalidArgumentException( 'O componente informado não é filho desse componente' );
		}
	}
}