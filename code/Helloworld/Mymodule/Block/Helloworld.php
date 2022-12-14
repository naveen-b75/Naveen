<?php
namespace Helloworld\Mymodule\Block;
use Helloworld\Mymodule\Helper\Data;
use Magento\Framework\View\Element\Template;

class Helloworld extends \Magento\Framework\View\Element\Template{
    /**
     * Calling helper class in block controller
     */

    protected $helper;

    public function __construct(Template\Context $context,Data $helper, array $data = [])
    {
        $this->helper=$helper;
        parent::__construct($context, $data);
    }

    public function helloworld(){
        return "Hello World";
    }

    public function getHelper(){
        return $this->helper->MyHelper();
    }
}