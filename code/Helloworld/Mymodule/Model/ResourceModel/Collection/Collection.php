<?php
namespace Helloworld\Mymodule\Model\ResourceModel\Collection;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Helloworld\Mymodule\Model\ResourceModel\Collection
 */
class Collection extends AbstractCollection {
    protected function _construct()
    {
        $this->_init(\Helloworld\Mymodule\Model\Curd::class,\Helloworld\Mymodule\Model\ResourceModel\Curd::class);
    }

}