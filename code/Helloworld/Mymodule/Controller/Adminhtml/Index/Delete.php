<?php
namespace Helloworld\Mymodule\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Helloworld\Mymodule\Model\ResourceModel\Collection\CollectionFactory;
use Helloworld\Mymodule\Model\CurdFactory;

/**
 * Class delete
 * @package Helloworld\Mymodule\Controller\Index
 */
class delete extends Action{
    public $collectionFactory;
    public $filter;
    public $curdFactory;

    /**
     * delete constructor.
     * @param Context $context
     * @param CurdFactory $curdFactory
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */

    public function __construct(Context $context,CurdFactory $curdFactory,Filter $filter,CollectionFactory $collectionFactory)
    {
        $this->filter=$filter;
        $this->collectionFactory=$collectionFactory;
        $this->curdFactory=$curdFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        try{
            $collection=$this->filter->getCollection($this->collectionFactory->create());
            $count=0;
            foreach ($collection as $item){
                $item=$this->curdFactory->create()->load($item->getId());
                $item->delete();
                $count++;
            }
            $this->messageManager->addSuccess(__("A total of %1 item(s) have been deleted.",$count));
        }catch (\Exception $e){
            $this->messageManager->addError(__($e->getMessage()));
        }
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('helloworld/index/orders');
    }
}