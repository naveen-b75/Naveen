<?php

namespace Helloworld\Mymodule\Controller\Adminhtml\Create;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Helloworld\Mymodule\Model\CurdFactory;
use Magento\Framework\Controller\Result\JsonFactory;
class InlineEdit extends Action{

    protected $curdFactory;
    protected $jsonFactory;

    public function __construct(Context $context,CurdFactory $curdFactory,JsonFactory $jsonFactory)
    {
        $this->curdFactory=$curdFactory;
        $this->jsonFactory=$jsonFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $result=$this->jsonFactory->create();
        $message=[];
        $error=false;
        $postItems=$this->getRequest()->getParam('items',[]);

        if($this->getRequest()->getParam('isAjax')){
            foreach (array_keys($postItems) as $modelId){
                $model=$this->curdFactory->create()->load($modelId);
                try{
                    $model->setData(array_merge($model->getData(),$postItems[$modelId]));
                    $model->save();
                }catch (\Exception $e){
                    $message[] = $this->messageManager->addErrorMessage($e->getMessage());
                    $error=true;
                }
            }
        }
        return $result->setData([
            'message' => $message,
            'error' => $error
        ]);
    }


}