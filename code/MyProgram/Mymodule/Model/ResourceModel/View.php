<?php

namespace MyProgram\Mymodule\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class View extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('sample_table', 'ID');
    }
}