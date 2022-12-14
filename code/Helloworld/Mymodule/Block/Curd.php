<?php
namespace Helloworld\Mymodule\Block;

use Magento\Framework\View\Element\Template;
use Helloworld\Mymodule\Model\ResourceModel\Collection\CollectionFactory;
use Helloworld\Mymodule\Model\CurdFactory;

class Curd extends Template{
    protected $curdFactory;
    protected $collectionFactory;
    public function __construct(Template\Context $context,CurdFactory $curdFactory, CollectionFactory $collectionFactory,array $data = [])
    {
        $this->collectionFactory=$collectionFactory;
        $this->curdFactory=$curdFactory;
        parent::__construct($context, $data);
    }
    /**
     * @return CollectionFactory
     */
    public function getCollection()
    {
        return $this->collectionFactory->create();
    }
    public function getUpdate(){
        return $this->getUrl('helloworld/curd/edit');
    }
    public function getRequestedData(){
        $id=$this->getRequest()->getParam('id');
        $model=$this->curdFactory->create();
        return $model->load($id);
    }
    public function saveData(){
        return $this->getUrl('helloworld/curd/update');
    }

    public function saveNewData(){
        return $this->getUrl('helloworld/curd/save');
    }
    public function getDeleteUrl($id) {
        return $this->getUrl('helloworld/curd/delete',['id'=>$id]);
    }
}