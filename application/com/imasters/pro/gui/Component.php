<?php
/**
 * Classes e objetos relacionados com a interface de usuário
 * @package	com.imasters.pro.gui
 */

require_once 'com/imasters/pro/core/Object.php';

/**
 * Interface para definição de todos os elementos da interface
 * de usuário.
 * @author	João Batista Neto
 */
abstract class Component extends Object {
	/**
	 * @var	array
	 */
	private $attributes;

	/**
	 * @var	Composite
	 */
	protected $parent;

	public function __construct() {
		$this->attributes = array();
	}

	/**
	 * @return	string
	 * @see		Object::__toString()
	 */
	public function __toString() {
		return $this->draw();
	}

	/**
	 * Adiciona um estilo ao componente.
	 * @param	string $styleName Nome do estilo que será adicionado
	 * @return	Component Uma referência ao próprio Component
	 */
	public function addStyle( $styleName ) {
		$currentStyle = explode( ' ' , $this->getAttribute( 'class' ) );
		$currentStyle[] = $styleName;

		$this->setAttribute( 'class' ,
			implode( ' ' , array_unique( array_filter( $currentStyle ) ) )
		);

		return $this;
	}

	/**
	 * Desenha o componente.
	 * @return	string Representação do componente como uma string.
	 */
	public abstract function draw();

	protected function drawAttributes() {
		$attributes = null;

		foreach ( $this->attributes as $name => $value ) {
			$attributes .= sprintf( ' %s="%s"' , $name , $value );
		}

		return $attributes;
	}

	/**
	 * Gera um id automaticamente para o componente.
	 * @return	Component Uma referência ao próprio componente.
	 * @see		Component::setId()
	 */
	protected function generateId() {
		return $this->setId( uniqid( 'id_' ) );
	}

	/**
	 * Recupera o valor de um atributo do componente ou NULL se
	 * nenhum valor tiver sido atribuído.
	 * @param	string $name O nome do atributo.
	 * @return	string O valor do atributo
	 */
	public function getAttribute( $name ) {
		return isset( $this->attributes[ $name ] ) ? $this->attributes[ $name ] : null;
	}

	/**
	 * Recupera o valor do atributo ID do componente ou NULL se
	 * o componente não tiver um ID definido.
	 * @return	string
	 */
	public function getId() {
		return $this->getAttribute( 'id' );
	}

	/**
	 * Recupera o pai desse componente.
	 * @return	Composite O pai desse componente.
	 * @see		Component::hasParent()
	 * @see		Component::setParent()
	 * @throws	BadMethodCallException Se esse componente não possuir
	 * 			um pai.
	 */
	public function getParent() {
		if ( $this->hasParent() ) {
			return $this->parent;
		} else {
			throw new BadMethodCallException( 'Esse componente não possui um pai.' );
		}
	}

	/**
	 * Recupera o título do componente ou NULL se o componente não
	 * tiver um título definido.
	 * @return	string
	 */
	public function getTitle() {
		return $this->getAttribute( 'title' );
	}

	/**
	 * Verifica se esse componente possui um pai.
	 * @see		Component::getParent()
	 * @see		Component::setParent()
	 * @return	boolean TRUE Se esse componente possuir um pai.
	 */
	public function hasParent() {
		return $this->parent !== null;
	}

	/**
	 * Define um atributo do componente.
	 * @param	string $name
	 * @param	string $value
	 * @return	Component Uma referência ao próprio Component
	 */
	public function setAttribute( $name , $value ) {
		$this->attributes[ $name ] = addcslashes( $value , '"' );

		return $this;
	}

	/**
	 * Define o ID do componente.
	 * @param	string $id O novo ID do componente
	 * @return	Component Uma referência ao próprio Component
	 * @see		Component::setAttribute()
	 */
	public function setId( $id ) {
		return $this->setAttribute( 'id' , $id );
	}

	/**
	 * Remove esse componente da lista de filhos de seu pai.
	 * @return	Component Uma referência ao próprio Component
	 * @throws	BadMethodCallException Se esse componente não possuir
	 * 			um pai.
	 */
	public function setOrphan() {
		if ( $this->parent !== null ) {
			if ( $this->parent->contains( $this ) ) {
				$this->parent->removeChild( $this );
			}

			$this->parent = null;

			return $this;
		} else {
			throw new BadMethodCallException( 'Esse componente não possui um pai.' );
		}
	}

	/**
	 * Define o pai desse componente.
	 * @param	Composite $parent O componente que é pai desse componente.
	 * @return	Component Uma referência ao próprio Component
	 * @see		Component::hasParent()
	 * @throws	LogicException Se esse componente já possuir um pai.
	 */
	public function setParent( Composite $parent ) {
		if ( $this->parent === null ) {
			$this->parent = $parent;

			return $this;
		} else {
			throw new LogicException( 'Esse componente já possui um pai' );
		}
	}

	/**
	 * Define um título para o componente.
	 * @param	string $title
	 * @return	Component Uma referência ao próprio Component
	 * @see		Component::setAttribute()
	 */
	public function setTitle( $title ) {
		return $this->setAttribute( 'title' , $title );
	}
}