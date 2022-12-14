<?php
namespace Helloworld\Mymodule\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class CustomPrice implements ObserverInterface{

    private $scopeConfig;
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig=$scopeConfig;
    }

    public function execute(Observer $observer)
    {
        $item=$observer->getEvent()->getData('quote_item');
        $product=$observer->getEvent()->getData('product');
        $item=$item->getParentItem() ? $item->getParentItem() : $item;
        $price =$this->customPrice();
        $item->setCustomPrice($price);
        $item->setOriginalCustomPrice($price);
        /**
         * setIsSuperMode == true will turn on the super mode to the product
         * it stop the system generating the price then set our custom price
         */
        $item->getProduct()->setIsSuperMode(true);
    }

    public function customPrice(){
        $value=$this->scopeConfig->getValue(
            'udemy/general/cart_price',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        return $value;
    }
}