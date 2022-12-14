<?php
namespace Helloworld\Mymodule\Plugin\Quote;

class ConvertQuoteItemToOrderItem{

    public function aroundConvert(\Magento\Quote\Model\Quote\Item\ToOrderItem $subject,
    \Closure $proceed,\Magento\Quote\Model\Quote\Item\AbstractItem $item,$additional=[]){

        $orderItem=$proceed($item,$additional);
        $orderItem->setCustomField1($item->getCustomField1());
        $orderItem->setCustomField2($item->getCustomField2());
        $orderItem->setCustomField3($item->getCustomField3());
        return $orderItem;
    }
}