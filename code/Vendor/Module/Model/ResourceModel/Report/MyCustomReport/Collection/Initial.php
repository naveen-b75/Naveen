<?php

namespace Vendor\Module\Model\ResourceModel\Report\MyCustomReport\Collection;

/**
 * @api
 * @since 100.0.2
 */
class Initial extends \Magento\Reports\Model\ResourceModel\Report\Collection
{
    /**
     * Report sub-collection class name
     *
     * @var string
     */
    protected $_reportCollection = \Vendor\Module\Model\ResourceModel\Report\MyCustomReport\Collection::class;
}
