<?php
namespace Helloworld\Mymodule\Controller\Adminhtml\Create;

use Magento\Backend\App\Action\Context;
use Helloworld\Mymodule\Model\CurdFactory;

/**
 * Class Save
 * @package Helloworld\Mymodule\Controller\Adminhtml\Create
 */
class Save extends \Magento\Backend\App\Action{
    /**
     * @var CurdFactory
     */
    protected $curdFactory;

    /**
     * Save constructor.
     * @param Context $context
     * @param CurdFactory $curdFactory
     */

    public function __construct(Context $context,CurdFactory $curdFactory)
    {
        $this->curdFactory=$curdFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     * @throws \Exception
     */
    public function execute()
    {

        $this->curdFactory->create()
            ->setData($this->getRequest()->getPostValue()['general'])
            ->save();
        return $this->resultRedirectFactory->create()->setPath('helloworld/index/orders');
    }
}