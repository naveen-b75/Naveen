<?php
namespace Helloworld\Mymodule\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Helloworld\Mymodule\Block\EventBlock ;

class Helloworld implements ObserverInterface{

    /** @var \Magento\Framework\View\Result\Page $page */
    public function execute(Observer $observer)
    {
        $page=$observer->getData('page');
            $page->getLayout()->addBlock(EventBlock::class,'helloworld_event','content');
    }
}