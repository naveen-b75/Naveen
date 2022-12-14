<?php
namespace Helloworld\Mymodule\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;

class Index extends \Magento\Backend\App\Action{

    protected $pageFactory;
    public function __construct(Context $context,\Magento\Framework\View\Result\PageFactory $pageFactory)
    {
        $this->pageFactory=$pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {

        return $this->pageFactory->create();
    }
}