<?php
/**
 * Classes e objetos do curso de MVC em PHP publicado
 * no iMasters Pro
 * @package	com.imasters.pro
 */

require_once 'com/imasters/pro/core/Object.php';
require_once 'com/imasters/pro/mvc/controller/ControllerManager.php';
require_once 'com/imasters/pro/mvc/controller/cart/CartController.php';
require_once 'com/imasters/pro/mvc/controller/home/HomeController.php';
require_once 'com/imasters/pro/mvc/model/mysql/MySQLFactory.php';
require_once 'com/imasters/pro/mvc/view/error/ErrorView.php';
require_once 'com/imasters/pro/util/ResourcesBundle.php';
require_once 'com/imasters/pro/util/Registry.php';

/**
 * Classe principal da aplicação
 * @author	João Batista Neto
 */
class Application extends Object {
	/**
	 * @var	Application
	 */
	private static $instance;

	/**
	 * @var	ControllerManager
	 */
	private $controllerManager;

	/**
	 * @var	ResourcesBundle
	 */
	private $resourceBundle;

	private function __construct() {
		$this->resourceBundle = ResourcesBundle::getInstance();
		$this->resourceBundle->load( 'com/imasters/pro/res/default' , 'pt' );

		$this->controllerManager = ControllerManager::getInstance();
		$this->controllerManager->addController( new HomeController() );
		$this->controllerManager->addController( new CartController() );
	}

	/**
	 * Recupera o pacote de recursos da aplicação.
	 * @return	ResourcesBundle
	 */
	public function getBundle() {
		return $this->resourceBundle;
	}

	/**
	 * Delega a manipulação das requisições feitas à
	 * aplicação ao controlador responsável.
	 */
	public function handle() {
		try {
			Registry::getInstance()->set( 'modelFactory' , new MySQLFactory() );

			session_start();

			$this->controllerManager->handle();
		} catch ( Exception $e ) {
			$view = new ErrorView();
			$view->setMessage( $e->getMessage() );
			$view->show();
		}
	}

	/**
	 * Recupera a instância da aplicação.
	 * @return	Application
	 */
	public static function getInstance() {
		if ( self::$instance == null ) {
			self::$instance = new Application();
		}

		return self::$instance;
	}

	/**
	 * Inicializa a aplicação.
	 * @see		Application::handle()
	 */
	public static function start() {
		self::getInstance()->handle();
	}
}