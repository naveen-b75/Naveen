<?php

namespace Helloworld\Mymodule\Model;

use Magento\Framework\Model\AbstractModel;

class Curd extends AbstractModel{
    protected function _construct()
    {
        $this->_init(\Helloworld\Mymodule\Model\ResourceModel\Curd::class);
    }
}