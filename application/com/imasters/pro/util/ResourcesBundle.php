<?php
/**
 * Classes e objetos utilitários da aplicação
 * @package	com.imasters.pro.core
 */

require_once 'com/imasters/pro/util/Resource.php';

/**
 * Implementação de pacote de recursos para recuperação de
 * dados estáticos e literais da aplicação.
 * @author	João Batista Neto
 */
class ResourcesBundle extends Resource {
	/**
	 * @var	ResourceBundle
	 */
	private static $instance;

	/**
	 * @var	DOMXPath
	 */
	private $resourceXPath;

	private function __construct() {
	}

	/**
	 * @param	DOMElement $element
	 * @return	Resource
	 */
	private function element2Resource( DOMElement $element ) {
		$resource = new Resource();
		$resource->id = $element->getAttribute( 'id' );
		$resource->value = $element->getAttribute( 'value' );

		foreach ( $element->childNodes as $domElement ) {
			$resource->resources[] = $this->element2Resource( $domElement );
		}

		return $resource;
	}

	/**
	 * Recupera um boolean.
	 * @param	string $id ID do recurso
	 * @return	boolean
	 * @see		ResourcesBundle::getResource()
	 * @throws	InvalidArgumentException Se nenhum recurso for encontrado.
	 * @throws	RuntimeException Se o arquivo de recursos não tiver sido carregado.
	 */
	public function getBoolean( $id ) {
		switch( $this->getString( $id ) ) {
			case '1':
			case 'true':
				return true;
			default :
				return false;
		}
	}

	/**
	 * Recupera um float.
	 * @param	string $id ID do recurso
	 * @return	float
	 * @see		ResourcesBundle::getResource()
	 * @throws	InvalidArgumentException Se nenhum recurso for encontrado.
	 * @throws	RuntimeException Se o arquivo de recursos não tiver sido carregado.
	 */
	public function getFloat( $id ) {
		return (float) $this->getString( $id );
	}

	/**
	 * Recupera a instância do ResourceBundle.
	 * @return	ResourcesBundle
	 */
	public static function getInstance() {
		if ( self::$instance == null ) {
			self::$instance = new ResourcesBundle();
		}

		return self::$instance;
	}

	/**
	 * Recupera um inteiro.
	 * @param	string $id ID do recurso
	 * @return	integer
	 * @see		ResourcesBundle::getResource()
	 * @throws	InvalidArgumentException Se nenhum recurso for encontrado.
	 * @throws	RuntimeException Se o arquivo de recursos não tiver sido carregado.
	 */
	public function getInt( $id ) {
		return (int) $this->getString( $id );
	}

	/**
	 * Recupera um recurso.
	 * @param	string $id ID do recurso
	 * @return	Resource
	 * @throws	InvalidArgumentException Se nenhum recurso for encontrado.
	 * @throws	RuntimeException Se o arquivo de recursos não tiver sido carregado.
	 */
	public function getResource( $id ) {
		return $this->getResourcePath( sprintf( './/pro:resource[@id="%s"]' , addcslashes( $id , '"' ) ) );
	}

	/**
	 * @param	string $path
	 * @throws	LogicException Se houver mais do que 1 recurso.
	 * @throws	InvalidArgumentException Se nenhum recurso for encontrado.
	 * @throws	RuntimeException Se o arquivo de recursos não tiver sido carregado.
	 */
	private function getResourcePath( $path ) {
		if ( $this->resourceXPath != null ) {
			$domNodeList = $this->resourceXPath->query( $path );

			if ( $domNodeList->length == 1 ) {
				return $this->element2Resource( $domNodeList->item( 0 ) );
			} else if ( $domNodeList->length > 1 ) {
				throw new LogicException( 'O caminho especificado aponta para mais de um recurso.' );
			} else {
				throw new InvalidArgumentException( 'Nenhum recurso localizado para o ID especificado.' );
			}
		} else {
			throw new RuntimeException( 'O arquivo de recursos não foi carregado.' );
		}
	}

	/**
	 * Recupera uma string.
	 * @param	string $id ID do recurso
	 * @return	string
	 * @see		ResourcesBundle::getResource()
	 * @throws	InvalidArgumentException Se nenhum recurso for encontrado.
	 * @throws	RuntimeException Se o arquivo de recursos não tiver sido carregado.
	 */
	public function getString( $id ) {
		return $this->getResource( $id )->getValue();
	}

	/**
	 * Carrega um pacote de recursos.
	 * @param	string $filename Nome do arquivo de recursos sem a extensão.
	 * @param	string $language Idioma do pacote.
	 * @throws	UnexpectedValueException Caso o conteúdo do arquivo não
	 * 			seja válido.
	 * @throws	RuntimeException Caso o arquivo não tenha sido localizado.
	 */
	public function load( $filename , $language = null ) {
		$schemaFile = stream_resolve_include_path( 'com/imasters/pro/util/resourceBundle.xsd' );

		$localized = stream_resolve_include_path( $filename . '_' . $language . '.xml' );

		if ( is_file( $localized ) ) {
			$filename = $localized;
		} else {
			$filename = stream_resolve_include_path( $filename . '.xml' );
		}

		if ( is_file( $filename ) ) {
			if ( is_file( $schemaFile ) ) {
				$dom = new DOMDocument();
				$dom->preserveWhiteSpace = false;
				$dom->load( $filename );

				if ( $dom->schemaValidate( $schemaFile ) ) {
					$this->resourceXPath = new DOMXPath( $dom );
					$this->resourceXPath->registerNamespace( 'pro' , 'urn:iMasters/pro' );
				} else {
					throw new UnexpectedValueException( 'O arquivo de recursos é inválido.' );
				}
			} else {
				throw new RuntimeException( 'XML Schema resourceBundle.xsd não foi encontrado.' );
			}
		} else {
			throw new RuntimeException( 'O arquivo de recursos não foi encontrado.' );
		}
	}
}