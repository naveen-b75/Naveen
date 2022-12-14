<?php
namespace Custom\Udemy\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Custom\Udemy\Model\ResourceModel\View\CollectionFactory;
use Custom\Udemy\Model\ViewFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;

class MassChangeStatus extends Action{

    protected $filter;
    protected $collectionFactory;
    protected $modalFactory;

    public function __construct(Context $context,
                                Filter $filter,
                                CollectionFactory $collectionFactory,
                                ViewFactory $modalFactory)
    {
        $this->collectionFactory=$collectionFactory;
        $this->modalFactory=$modalFactory;
        $this->filter=$filter;
        parent::__construct($context);
    }

    public function execute()
    {
       try{
           $collection=$this->filter->getCollection($this->collectionFactory->create());
           $update=0;
           foreach ($collection as $item){
               $modal=$this->modalFactory->create()->load($item['article_id']);
               $modal->setData('status',$this->getRequest()->getParam('status'));
               $modal->save();
               $update++;
           }
           if($update){
               $this->messageManager->addSuccess(__('A total of %1 record(s) are updated.', $update));
           }
       }catch (\Exception $e){
           $this->messageManager->addError(__($e->getMessage()));
       }
       $result= $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
       $result->setUrl($this->_redirect->getRedirectUrl());
       return $result;
    }
    protected function _isAllowed()
    {
        return true;
    }
}