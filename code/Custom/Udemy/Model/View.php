<?php

namespace Custom\Udemy\Model;

use Magento\Framework\Model\AbstractModel;

class View extends AbstractModel{

    protected function _construct()
    {
        $this->_init(\Custom\Udemy\Model\ResourceModel\View::class);
    }
}