<?php

namespace Vendor\Module\Model\ResourceModel\Report;
use Magento\Sales\Model\ResourceModel\Report\Order;

/**
 * Class Product
 * @package Vendor\Module\Model\ResourceModel\Report
 */
class Product extends Order{


    protected function _construct()
    {
       $this->_init('sales_order_aggregated_created','id');
    }

    /**
     * @param null $from
     * @param null $to
     * @return $this|Order
     */
    public function aggregate($from = null, $to = null)
    {
        $this->_aggregateByField('created_at', $from, $to);
        $this->_setFlagData(\Helloworld\Mymodule\Model\Flag::REPORT_PRODUCTREPORT_FLAG_CODE);
        return $this;
    }

}
