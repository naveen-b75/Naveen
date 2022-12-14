<?php


namespace MyProgram\Mymodule\Controller\Index;
use MyProgram\Mymodule\Model\ViewFactory as View;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Delete extends Action  {
    protected $viewFactory;
    protected $message;
    public function __construct(Context $context, view $viewFactory, \Magento\Framework\Message\ManagerInterface $message)
    {
        $this->viewFactory=$viewFactory;
        $this->message=$message;
        parent::__construct($context);
    }
    public  function  execute()
    {
        $params =(int) $this->getRequest()->getParam('param',false);
        try{
            $model=$this->viewFactory->create();
            $model->load($params);
            $model->delete();
            $this->message->addSuccessMessage("Deleted Successfully");
        }catch (\Exception $e){
            $this->message->addError($e->getMessage());
        }
        $redirect=$this->resultRedirectFactory->create();
        $redirect->setPath('*/*/index');
        return $redirect;
    }

}



