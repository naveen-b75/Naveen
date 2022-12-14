<?php
namespace Helloworld\Mymodule\Controller\Curd;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Result\PageFactory;
use Helloworld\Mymodule\Model\CurdFactory;
class Update extends \Magento\Framework\App\Action\Action{
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
        try{
            $data=$this->getRequest()->getPost();
            if($data){
                $model=$this->curdFactory->create()->load($data['id']);
                $model->setName($data['name'])->setDescription($data['description'])->save();
                $this->messageManager->addSuccessMessage('Product Updated successfully');
            }
        }catch (\Exception $e){
            $this->messageManager->addErrorMessage('Failed to update');
        }
        $resultRedirect=$this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->url->getUrl('helloworld/curd/read'));
        return $resultRedirect;
    }
}