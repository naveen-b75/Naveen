<?php
namespace Helloworld\Mymodule\Controller\Events;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\View\Result\PageFactory;

class Index implements ActionInterface{

    protected $pageFactory;
    protected $eventManager;

    public function __construct(PageFactory $pageFactory, ManagerInterface $eventManager){
        $this->pageFactory=$pageFactory;
        $this->eventManager=$eventManager;
    }

    public function execute()
    {
        $result=$this->pageFactory->create();
        $result->getConfig()->getTitle()->set('Helloworld Events');
        $this->eventManager->dispatch('helloworld_event_example',['page'=>$result]);
        return $result;
    }
}