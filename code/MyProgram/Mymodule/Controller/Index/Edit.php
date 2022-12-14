<?php

namespace MyProgram\Mymodule\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Result\PageFactory;
use MyProgram\Mymodule\Model\ViewFactory;


Class Edit Extends Action{
    protected $resultPageFactory;
    protected $viewFactory;
    protected $url;

    public function __construct(Context $context, UrlInterface $url, ViewFactory $viewFactory,PageFactory $resultPageFactory)
    {
        parent::__construct($context);

        $this->resultPageFactory=$resultPageFactory;
        $this->url=$url;
        $this->viewFactory=$viewFactory;
    }
    /**
     * Prints the information
     * @return Page
     */
    public function execute()
    {
        if($this->correctData()){
            return $this->resultPageFactory->create();
        }else{
            $this->messageManager->addErrorMessage(__("no data"));
            $resultRedirect=$this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl($this->url->getUrl("*/*/index"));
            return $resultRedirect;
        }
    }
    public function correctData(){
        if($id=$this->getRequest()->getParam('id')){
            $model=$this->viewFactory->create();
            $model->load($id);
            if($model->getId()){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }
}