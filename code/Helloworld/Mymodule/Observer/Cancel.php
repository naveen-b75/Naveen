<?php

namespace Helloworld\Mymodule\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Helloworld\Mymodule\Helper\Email;
use Magento\Catalog\Model\ProductFactory;

/**
 * Class Cancel
 * @package Helloworld\Mymodule\Observer
 */
class Cancel implements ObserverInterface{

    /**
     * @var Email
     */
    private $helperEmail;
    protected $_customerRepositoryInterface;
    /**
     * @var ProductFactory
     */
    protected $product;

    /**
     * Cancel constructor.
     * @param Email $helperEmail
     * @param ProductFactory $productFactory
     */
    public function __construct(Email $helperEmail,ProductFactory $productFactory)
    {
        $this->helperEmail=$helperEmail;
        $this->product=$productFactory;
    }

    /**
     * @param $id
     * @return \Magento\Catalog\Model\Product
     */
    public function getProduct($id){
        return $this->product->create()->load($id);
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $order=$observer->getEvent()->getOrder();
        $customerName=$order->getCustomerEmail();
        $orderNo=$order->getIncrementId();
        $orderItems=$order->getAllItems();
        foreach ($orderItems as $item){
            $id[]=$item->getProductId();
            $product=$this->getProduct($id);
            $productName=$product->getName();
        }
        $description='Your order has been canceled succesfully of product\'s ';
        $subject='Order Cancel';
        return $this->helperEmail->sendEmail($customerName,$productName,$orderNo,$description,$subject);
    }


}