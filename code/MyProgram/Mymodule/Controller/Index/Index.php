<?php

namespace MyProgram\Mymodule\Controller\Index;

use \Magento\Framework\App\Action\HttpGetActionInterface;
use \Magento\Framework\View\Result\PageFactory;

class Index implements HttpGetActionInterface
{

    protected $resultPageFactory;

    public function __construct(PageFactory $resultPageFactory) {
        $this->resultPageFactory = $resultPageFactory;

    }

    /**
     * Prints the information
     * @return Page
     */
    public function execute()
    {

        return $this->resultPageFactory->create();
    }
}