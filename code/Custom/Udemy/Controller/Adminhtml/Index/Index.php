<?php
namespace Custom\Udemy\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

use \Magento\Framework\App\Action\HttpGetActionInterface;


class Index extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Raw $result */
        $result= $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $result->setActiveMenu('Custom_Udemy::udemy');
        return $result;

    }
}

