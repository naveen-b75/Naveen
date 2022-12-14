<?php

namespace Helloworld\Mymodule\Observer;

use Magento\Framework\Event\Observer;

class SaveToOrder implements \Magento\Framework\Event\ObserverInterface{

    public function execute(Observer $observer)
    {
        $event= $observer->getEvent();
        $quote=$event->getQuote();
        //print_r($quote);exit;
        $order=$event->getOrder();
        $order->setData('delivery_date',$quote->getData('delivery_date'));
    }
}