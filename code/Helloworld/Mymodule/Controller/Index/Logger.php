<?php

namespace Helloworld\Mymodule\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Psr\Log\LoggerInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\View\Result\PageFactory;


class Logger extends Action{

    protected $pageFactory;
    protected $jsonFactory;
    protected $loggerInterface;

    public function __construct(Context $context,PageFactory $pageFactory,JsonFactory $jsonFactory,LoggerInterface $loggerInterface)
    {
        $this->pageFactory=$pageFactory;
        $this->jsonFactory=$jsonFactory;
        $this->loggerInterface=$loggerInterface;
        parent::__construct($context);
    }

    public function execute()
    {
        $this->loggerInterface->debug('Log Debug');
        $this->loggerInterface->info('Log Info');
        $this->loggerInterface->notice('Log Notice');
        $this->loggerInterface->warning('Log Warning');
        $this->loggerInterface->error('Log Error');
        $this->loggerInterface->critical('Log Critical');
        $this->loggerInterface->alert('Log Alert');
        $this->loggerInterface->emergency('Log Emergency');
            $result = $this->jsonFactory->create();
            $data = ['message' => 'Log created successfully'];
        return $result->setData($data);
    }
}