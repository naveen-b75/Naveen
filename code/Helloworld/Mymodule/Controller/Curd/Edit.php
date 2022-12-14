<?php
namespace Helloworld\Mymodule\Controller\Curd;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Result\PageFactory;
use Helloworld\Mymodule\Model\CurdFactory;

class Edit extends \Magento\Framework\App\Action\Action{
    protected $pageFactory;
    protected $curdFactory;
    protected $url;
    public function __construct(UrlInterface $url,Context $context,PageFactory $pageFactory, CurdFactory $curdFactory)
    {
        $this->curdFactory=$curdFactory;
        $this->url=$url;
        $this->pageFactory=$pageFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        if($this->isCorrectData()){
            return $this->pageFactory->create();
        }else{
            $this->messageManager->addErrorMessage('No products found');
            $resultRedirect=$this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl($this->url->getUrl('helloworld/curd/read'));
        }
    }
    public function isCorrectData(){
        if($id=$this->getRequest()->getParam('id')){
            $model=$this->curdFactory->create();
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