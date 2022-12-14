<?php
namespace MyProgram\Mymodule\Model\ResourceModel\View;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
   
    protected function _construct()
    {
        $this->_init(\MyProgram\Mymodule\Model\View::class, \MyProgram\Mymodule\Model\ResourceModel\View::class);
    }
}