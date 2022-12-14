<?php
namespace MyProgram\Mymodule\Block;

use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Magento\Framework\Registry;
use \Magento\CatalogInventory\Api\StockRegistryInterface;

class Stockleft extends Template
{
	private $registry;
	protected $stockInterface;

	public function __construct(Context $context, 
		Registry $registry,
		StockRegistryInterface $stockInterface,
		array $data=[]){
		parent::__construct($context,$data);
		$this->registry=$registry;
		$this->stockInterface=$stockInterface;
	}

	public function getRemainingQuantity(){
		$product=$this->getCurrentProduct();
		$stock=$this->stockInterface->getStockItem($product->getId());
		return $stock->getQty();
	}
	protected function getCurrentProduct(){
		return $this->registry->registry('product');
	}
}
