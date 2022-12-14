<?php
/**
 * Created by PhpStorm.
 * User: naveeni
 * Date: 12/9/22
 * Time: 1:08 PM
 */

namespace Custom\Udemy\Controller\Adminhtml\Item;


use Magento\Backend\App\Action\Context;
use Custom\Udemy\Model\ViewFactory;

class Save extends \Magento\Backend\App\Action
{
    private $viewFactory;


    public function __construct(Context $context, ViewFactory $viewFactory)
    {
        parent::__construct($context);
        $this->viewFactory=$viewFactory;
    }

    public function execute()
    {


            $this->viewFactory->create()
                ->setData($this->getRequest()->getPostValue()['general'])
                ->save();
            return $this->resultRedirectFactory->create()->setPath('udemy/index/index');

    }

}