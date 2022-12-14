<?php
namespace Custom\Udemy\Model\ResourceModel\View;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection{
    protected $_idFieldName = 'article_id';

    protected function _construct()
    {
        $this->_init(\Custom\Udemy\Model\View::class,\Custom\Udemy\Model\ResourceModel\View::class);
    }
}