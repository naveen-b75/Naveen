<?php
namespace Helloworld\Mymodule\Controller\Quote;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Model\QuoteIdMaskFactory;
use Magento\Quote\Api\CartRepositoryInterface;

/**
 * Class Save
 * @package Helloworld\Mymodule\Controller\Quote
 */

class Save extends Action{
    protected $quoteId;
    protected $quoteRepository;

    /**
     * Save constructor.
     * @param Context $context
     * @param QuoteIdMaskFactory $quoteId
     * @param CartRepositoryInterface $quoteRepository
     */

    public function __construct(Context $context, QuoteIdMaskFactory $quoteId,CartRepositoryInterface $quoteRepository)
    {
        $this->quoteId=$quoteId;
        $this->quoteRepository=$quoteRepository;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $post=$this->getRequest()->getPostValue();
        if($post){
            $cartId=$post['cartId'];
            $deliveryDate=$post['delivery_date'];
            $loggin=$post['is_customer'];

            if($loggin=='false'){
                $cartId=$this->quoteId->create()->load($cartId,'masked_id')->getQuoteId();
            }
            $quote=$this->quoteRepository->getActive($cartId);
            if(!$quote->getItemsCount()){
                throw new NoSuchEntityException(__('Cart %1 doesn\'t contain products',$cartId));
            }
            $quote->setData('delivery_date',$deliveryDate);
            $this->quoteRepository->save();
        }
    }
}