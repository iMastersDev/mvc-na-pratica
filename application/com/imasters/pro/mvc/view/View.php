<?php
/**
 * Classes e objetos que representam a View da aplicação
 * @package	com.imasters.pro.view
 */

require_once 'com/imasters/pro/gui/Composite.php';

/**
 * Interface para implementação de uma View
 * @author	João Batista Neto
 */
abstract class View extends Composite {
	/**
	 * @var	array
	 */
	protected $script;

	/**
	 * @var	array
	 */
	protected $style;

	/**
	 * @var	string
	 */
	protected $title;

	public function __construct() {
		parent::__construct();

		$this->script = array();
		$this->style = array();
		$this->title = 'Sem título';
	}

	/**
	 * Adiciona um arquivo de script para ser carregado.
	 * @param	string $scriptFile
	 * @return	View Uma referência a própria View
	 */
	public function addScript( $scriptFile ) {
		$this->script[] = $scriptFile;

		return $this;
	}

	/**
	 * Adiciona uma folha de estilo para ser carregada.
	 * @param	string $styleName
	 * @return	View Uma referência a própria View
	 * @see		Component::addStyle()
	 */
	public function addStyle( $styleName ) {
		$this->style[] = $styleName;

		return $this;
	}

	/**
	 * Criação da interface de usuário.
	 */
	protected abstract function createUserInterface();

	/**
	 * @see		Component::draw()
	 */
	public function draw() {
		echo '<!DOCTYPE html>' , PHP_EOL;
		echo '<html>';
		echo '<head>';
		echo '<title>' , $this->getTitle() , '</title>';

		foreach ( $this->style as $style ) {
			echo '<link rel="stylesheet" type="text/css" href="' , $style , '" />';
		}

		foreach ( $this->script as $script ) {
			echo '<script type="text/javascript" src="' , $script , '"></script>';
		}

		echo '</head>';
		echo '<body>';

		echo $this->drawChildren();

		echo '</body>';
		echo '</html>';
	}

	/**
	 * Recupera o título da View.
	 * @return	string
	 * @see		Component::getParent()
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Uma View não pode ser adicionada como filho de outro componente
	 * e por isso esse método sempre disparará uma exceção.
	 * @param	Component $parent
	 * @see		Component::setParent()
	 */
	final public function setParent( Component $parent ) {
		throw new BadMethodCallException( 'A View é o elemento de mais alto nível da composição e não pode ser adicionado como filho de outro componente' );
	}

	/**
	 * Define o título da View.
	 * @param	string $title O título da View
	 * @return	View Uma referência à própria View.
	 * @see		Component::setTitle()
	 */
	public function setTitle( $title ) {
		$this->title = $title;

		return $this;
	}

	/**
	 * Exibe a View
	 * @see		Component::draw()
	 */
	public function show() {
		$this->createUserInterface();

		echo $this->draw();
	}
}