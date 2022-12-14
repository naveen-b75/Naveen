<?php
namespace Helloworld\Mymodule\Controller\Curd;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Helloworld\Mymodule\Model\CurdFactory;
use Helloworld\Mymodule\Model\Curd;
use Helloworld\Mymodule\Model\ResourceModel\Curd as ResourceCurd;
use Magento\Framework\Controller\ResultFactory;

class Save extends Action{
    protected $curdFactory;
    protected $curd;
    protected $resourceCurd;

    public function __construct(ResourceCurd $resourceCurd, Context $context,CurdFactory $curdFactory,Curd $curd)
    {
        $this->curd=$curd;
        $this->resourceCurd=$resourceCurd;
        $this->curdFactory=$curdFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $params=$this->getRequest()->getParams();
        $curd=$this->curd->setData($params);
        try{
            $this->resourceCurd->save($curd);
            $this->messageManager->addSuccessMessage('Created Successfully');
        }catch (\Exception $e){
            $this->messageManager->addErrorMessage('Failed to Create');
        }
        $resultRedirect=$this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_url->getUrl('helloworld/curd/read'));
        return $resultRedirect;
    }
}