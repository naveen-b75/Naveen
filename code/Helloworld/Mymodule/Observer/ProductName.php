<?php

namespace Helloworld\Mymodule\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ProductName implements ObserverInterface{

    public function execute(Observer $observer)
    {
       $product=$observer->getProduct();
       $productName=$product->getName();
       $modifyName=$productName.' - This Product can\'t be sold out side of this website ';
       $product->setName($modifyName);
    }
}