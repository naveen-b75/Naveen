<?php
namespace Helloworld\Mymodule\Controller\Adminhtml\Create;

use Magento\Framework\App\Action\Action;
use Helloworld\Mymodule\Model\CurdFactory;
use Helloworld\Mymodule\Model\ResourceModel\Curd;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Delete extends Action{

    protected $curdFactory;
    protected $curd;

    public function __construct(Context $context, CurdFactory $curdFactory,Curd $curd)
    {
        $this->curdFactory=$curdFactory;
        $this->curd=$curd;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultFactory=$this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $postId=$this->getRequest()->getParam('id');
        if(!$postId){
            $this->messageManager->addErrorMessage('Selected Name does\'t exit ');
            return $resultFactory->setPath('*/index/orders');
        }
        $model=$this->curdFactory->create();
        try {
            $this->curd->load($model, $postId);
            $this->curd->delete($model);
            $this->messageManager->addSuccessMessage('Data is Deleted');
        }catch (\Exception $e){
            $this->messageManager->addErrorMessage($e->getMessage());
        }
        return $resultFactory->setPath('*/index/orders');

    }

}