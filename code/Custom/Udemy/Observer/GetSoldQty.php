<?php

namespace Custom\Udemy\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
//use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
//use Magento\Sales\Model\ResourceModel\Report\Order\CollectionFactory;
//use Magento\Reports\Model\ResourceModel\Product\CollectionFactory;
use Magento\Reports\Model\ResourceModel\Product\Sold\CollectionFactory;
use Magento\Catalog\Model\ProductFactory;
class GetSoldQty implements ObserverInterface{

    protected $request;
    protected $collection;
    protected $productFactory;

    public function __construct(\Magento\Framework\App\RequestInterface $request, CollectionFactory $collection, ProductFactory $productFactory)
    {
        $this->request=$request;
        $this->collection=$collection;
        $this->productFactory=$productFactory;
    }

    public function execute(Observer $observer)
    {
        $productId=$observer->getEvent()->getProduct()->getId();
        $params=$this->request->getParams();
       if($productId === null){
           return false;
       }else {
           $from = $params['product']['from'];
           $fromDate = date('Y-m-d 00:00:00', strtotime($from));;
           $to = $params['product']['to'];
           $toDate = date('Y-m-d 23:59:59', strtotime($to));
           $customDataField = $this->collection->create()->addOrderedQty($fromDate, $toDate, true)->addAttributeToFilter('product_id', $productId)->getFirstItem();
           //var_dump((int)$customDataField->getData('ordered_qty'));exit;
           return $customDataField->getData('ordered_qty');
       }
    }
}