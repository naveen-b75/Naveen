<?php
namespace Helloworld\Mymodule\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use MagePal\GmailSmtpApp\Helper\Data;
use Helloworld\Mymodule\Helper\Email;
use Magento\Catalog\Model\ProductFactory;

class ReviewEmail implements ObserverInterface{

    private $helperEmail;
    protected $_customerRepositoryInterface;
    protected $product;

    public function __construct(Email $helperEmail,
                                 ProductFactory $product
                                )
    {
        $this->helperEmail=$helperEmail;
        $this->product = $product;
    }

    public function getProduct($id)
    {
        return $this->product->create()->load($id);
    }

    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $CustomerName=$order->getCustomerEmail();
        $orderNo=$order->getIncrementId();
        $orderId = $order->getId();
        $orderItems = $order->getAllItems();
        foreach ($orderItems as $item) {
            $id[]= $item->getProductId();
            $product=$this->getProduct($id);
            $productName= $product->getName();
        }

        $description='Please Give Review for the Product';
        $subject='Review and Rating';
       $return= $this->helperEmail->sendEmail($CustomerName,$productName,$orderNo,$description,$subject);
       return $return;
    }



}