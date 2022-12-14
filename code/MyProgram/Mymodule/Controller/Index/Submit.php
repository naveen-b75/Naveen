<?php
namespace MyProgram\Mymodule\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Result\PageFactory;
use MyProgram\Mymodule\Model\ViewFactory;

class Submit extends Action{
    protected $resultPageFactory;
    protected $viewFactory;
    protected $url;

    public function __construct(Context $context, pageFactory $resultPageFactory, ViewFactory $viewFactory, UrlInterface $url)
    {
        $this->resultPageFactory=$resultPageFactory;
        $this->url=$url;
        $this->viewFactory=$viewFactory;
        parent::__construct($context);
    }
    public function execute(){
        try{
            $data=(array)$this->getRequest()->getPost();
            if($data){
                $model=$this->viewFactory->create()->load($data['id']);
                $model->setProduct($data['product'])->setDescription($data['description'])->save();
                $this->messageManager->addSuccessMessage(__("Edited Successfully"));
            }
        }catch (\Exception $e){
            $this->messageManager->addErrorMessage(__("Failed to save"));
        }
        $resultRedirect=$this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->url->getUrl('mymodule/index/index'));
        return $resultRedirect;
    }
}