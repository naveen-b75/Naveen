<?php
namespace Helloworld\Mymodule\Ui;

use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider{
    protected $collectionFactory;
    public function __construct(string $name,$collectionFactory, string $primaryFieldName, string $requestFieldName, array $meta = [], array $data = [])
    {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection =$collectionFactory->create();
    }

    public function getData()
    {
       $result=[];
       foreach ($this->collection->getItems() as $item){
           $result[$item->getId()]['general']=$item->getData();
       }
       return $result;
    }


}