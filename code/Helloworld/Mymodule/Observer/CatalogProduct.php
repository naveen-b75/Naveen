<?php
namespace Helloworld\Mymodule\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Api\CategoryLinkManagementInterface;

class CatalogProduct implements ObserverInterface{
    protected $catalogManageInterface;
    protected $productFactory;
     public function __construct(ProductFactory $productFactory, CategoryLinkManagementInterface $catalogManageInterface)
     {
         $this->catalogManageInterface=$catalogManageInterface;
         $this->productFactory=$productFactory;
     }
     public function execute(Observer $observer)
     {
         $productId=$observer->getEvent()->getProduct();
         $product=$this->productFactory->create()->load($productId->getId());
         $catagoryId=[42];
         $catagoryIds=array_unique(
             array_merge(
                 $product->getCategoryIds(),
                 $catagoryId
             )
         );
         $this->catalogManageInterface->assignProductToCategories(
             $product->getSku(),
             $catagoryIds
         );
     }
}