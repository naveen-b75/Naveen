<?php

namespace Custom\Udemy\Controller\Adminhtml\Sold;

ini_set('max_input_vars', 10000);

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Sold extends \Magento\Framework\App\Action\Action {

    protected $_resultPageFactory;

    public function __construct(Context $context, PageFactory $_resultPageFactory)
    {
        $this->_resultPageFactory=$_resultPageFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $pageFactory=$this->_resultPageFactory->create();
        $result=$this->_request->getParams();exit;
        return $pageFactory;
    }
}