<?php
/**
 * Created by PhpStorm.
 * User: naveeni
 * Date: 12/9/22
 * Time: 1:05 PM
 */

namespace Custom\Udemy\Controller\Adminhtml\Item;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class NewAction extends Action
{
    public function execute()
    {
        $result=$this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $result->setActiveMenu('Custom_Udemy::udemy');
        return $result;
    }
}
