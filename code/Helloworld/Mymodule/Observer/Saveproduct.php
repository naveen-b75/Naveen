<?php
namespace Helloworld\Mymodule\Observer;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
class Saveproduct implements ObserverInterface{
    public function execute(Observer $observer)
    {
        require_once('/var/www/html/magento24/saveproduct.php');
        try {
        foreach ($data as $value){
                $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
                $product = $objectManager->create('\Magento\Catalog\Model\Product');
                $product->setSku($value['sku']);
                $product->setName($value['name']);
                $product->setAttributeSetId(4);
                $product->setStatus(1);
                $product->setWeight(10);
                $product->setVisibility(4);
                $product->setTypeId('simple');
                $product->setPrice($value['price']);
                $product->setStockData(
                    array(
                        'use_config_manage_stock'=>0,
                        'manage_stock'=>1,
                        'is_in_stock'=>1,
                        'qty'=>$value['qty']
                    )
                );
                $product->save();
            }
            echo "Given CSV File Products Saved successfully";
        }catch (\Exception $e){
            echo $e->getMessage();
        }
    }
}