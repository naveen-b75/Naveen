<?php
namespace MyProgram\Mymodule\Block;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\View\Element\Template;
use MyProgram\Mymodule\Model\ViewFactory;

Class Form extends Template{
    private  $viewFactory;

    public function __construct(Context $context,ViewFactory $viewFactory, array $data = [])
    {
        parent::__construct($context, $data);
        $this->viewFactory=$viewFactory;
    }

    public function getForm(){
        return $this->getUrl('mymodule/index/submit');
    }
    public function getAllData(){
        $id=$this->getRequest()->getParam('id');
        $model=$this->viewFactory->create();
        return $model->load($id);
    }
}