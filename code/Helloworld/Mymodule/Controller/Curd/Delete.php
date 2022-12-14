<?php
namespace Helloworld\Mymodule\Controller\Curd;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Helloworld\Mymodule\Model\CurdFactory;
use Magento\Framework\Controller\ResultFactory;

class Delete extends Action{

    protected $curdFactory;
    protected $resultFactory;
    public function __construct(Context $context,CurdFactory $curdFactory)
    {

        $this->curdFactory=$curdFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $params=(int)$this->getRequest()->getParam('id',false);
        try{
            $model=$this->curdFactory->create();
            $model->load($params);
            $model->delete();
            $this->messageManager->addSuccessMessage('Successfully Deleted');
        }catch (\Exception $e){
            $this->messageManager->addErrorMessage('Failed to Delete');
        }
        $resultFactory=$this->resultRedirectFactory->create();
        $resultFactory->setPath('helloworld/curd/read');
        return $resultFactory;
    }
}