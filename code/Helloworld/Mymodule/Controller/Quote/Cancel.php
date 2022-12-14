<?php

namespace Helloworld\Mymodule\Controller\Quote;

use Magento\Sales\Controller\AbstractController\OrderLoaderInterface;
use Magento\Sales\Controller\OrderInterface;
use Magento\Sales\Model\OrderFactory;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Cancel
 * @package Helloworld\Mymodule\Controller\Quote
 */
class Cancel extends \Magento\Framework\App\Action\Action implements OrderInterface{

    /**
     * @var PageFactory
     */
    protected $resultFactory;

    protected $_order;
    /**
     * @var OrderLoaderInterface
     */
    protected $orderLoader;
    /**
     * @var OrderFactory
     */
    protected $orderFactory;

    /**
     * Cancel constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param PageFactory $resultFactory
     * @param OrderFactory $orderFactory
     * @param OrderLoaderInterface $orderLoader
     */
    public function __construct(\Magento\Framework\App\Action\Context $context,PageFactory $resultFactory, OrderFactory $orderFactory, OrderLoaderInterface $orderLoader)
    {
        $this->orderFactory=$orderFactory;
        $this->resultFactory=$resultFactory;
        $this->orderLoader=$orderLoader;

        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     * @throws \Exception
     */
    public function execute()
    {
        $orderId=$this->getRequest()->getParam('order_id');

        $resultRedirect =$this->resultRedirectFactory->create();

        $this->_order=$this->orderFactory->create()->load($orderId);

        if($this->_order->canCancel()){
            $this->_order->cancel();
            $this->_order->save();
            $this->messageManager->addSuccess(__('Order has been canceled successfully'));
        }else{
            $this->messageManager->addError(__('Failed to cancel order, try after sometime'));
        }
        return $resultRedirect->setPath('sales/order/view',['order_id' => $orderId]);
    }
}