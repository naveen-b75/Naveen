<?php
/**
 * Created by PhpStorm.
 * User: naveeni
 * Date: 13/9/22
 * Time: 12:39 PM
 */

namespace Custom\Udemy\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
class Logger implements  ObserverInterface
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger=$logger;
    }
    public function execute(Observer $observer)
    {
        $this->logger->debug(
            $observer->getEvent()->getObject()->getTitle()
        );
    }

}