<?php

namespace Helloworld\Mymodule\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Curd extends AbstractDb{

    protected function _construct()
    {
        $this->_init('helloworld','id');
    }
}