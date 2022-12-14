<?php

namespace Custom\Udemy\Block\Adminhtml\Product\Edit\Button;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\UiComponent\Context;

class Result extends \Magento\Catalog\Block\Adminhtml\Product\Edit\Button\Generic
{
    protected $productRepository;
    protected $request;

    public function __construct(\Magento\Framework\App\RequestInterface $request,Context $context, Registry $registry,ProductRepositoryInterface $productRepository)
    {
        $this->productRepository=$productRepository;
        $this->request=$request;
        parent::__construct($context, $registry);
    }

    public function getButtonData()
    {


    }
}