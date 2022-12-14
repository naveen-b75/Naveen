<?php
namespace Custom\Udemy\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class View extends AbstractDb{


    protected function _construct()
    {
        $this->_init('udemy_practice','article_id');
    }
}