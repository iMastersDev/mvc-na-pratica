<?php
/**
 * Classes e objetos relacionados com a Model da aplicação
 * @package	com.imasters.pro.mvc.model
 */

require_once 'com/imasters/pro/core/Object.php';

/**
 * Representação de um produto
 * @author	João Batista Neto
 */
final class Product extends Object {
	/**
	 * @var	integer
	 */
	private $idProduct;

	/**
	 * @var	string
	 */
	private $productDescription;

	/**
	 * @var	string
	 */
	private $productImage;

	/**
	 * @var	float
	 */
	private $productPrice;

	/**
	 * @var	string
	 */
	private $productName;

	/**
	 * Recupera o ID do produto
	 * @return	integer
	 */
	public function getIdProduct() {
		return (int) $this->idProduct;
	}

	/**
	 * Recupera a descrição do produto
	 * @return	string
	 */
	public function getProductDescription() {
		return $this->productDescription;
	}

	/**
	 * Recupera a imagem do produto
	 * @return	string
	 */
	public function getProductImage() {
		return $this->productImage;
	}

	/**
	 * Recupera o preço do produto
	 * @return	float
	 */
	public function getProductPrice() {
		return $this->productPrice;
	}

	/**
	 * Recupera o nome do produto
	 * @return	string
	 */
	public function getProductName() {
		return $this->productName;
	}

	/**
	 * Define o ID do produto
	 * @param	integer $idProduct
	 */
	public function setIdProduct( $idProduct ) {
		$this->idProduct = $idProduct;
	}

	/**
	 * Define a descrição do produto
	 * @param	string $productDescription
	 */
	public function setProductDescription( $productDescription ) {
		$this->productDescription = $productDescription;
	}

	/**
	 * Define a imagem do produto
	 * @param	string $productImage
	 */
	public function setProductImage( $productImage ) {
		$this->productImage = $productImage;
	}

	/**
	 * Define o preço do produto
	 * @param	float $productPrice
	 */
	public function setProductPrice( $productPrice ) {
		$this->productPrice = $productPrice;
	}

	/**
	 * Define o nome do produto
	 * @param	string $productName
	 */
	public function setProductName( $productName ) {
		$this->productName = $productName;
	}
}