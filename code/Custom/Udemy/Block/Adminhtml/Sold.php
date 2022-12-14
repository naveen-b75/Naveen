<?php

namespace Custom\Udemy\Block\Adminhtml;
class Sold extends \Magento\Framework\View\Element\Template{

    protected $request;

   public function __construct(
      \Magento\Framework\View\Element\Template\Context $context,\Magento\Framework\App\RequestInterface $request, array $data = []
   ){
      parent::__construct($context,$data);
   }
    public function getSoldCount(){
        $result=$this->_request->getParams();
        print_r($result);
        return $result;
    }

    public function getUrl($route = '', $params = [])
    {
        return parent::getUrl($route, $params);
    }
    public function getSaveUrl()
    {
        return $this->getUrl('udemy/sold/sold', ['_current' => true]);
    }
}