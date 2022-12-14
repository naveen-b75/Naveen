<?php

namespace Helloworld\Mymodule\Model\ResourceModel\Report\Product;

use Helloworld\Mymodule\Model\Flag;
/**
 * Class Collection
 * @package Helloworld\Mymodule\Model\ResourceModel\Report\Product
 */
class Collection extends \Magento\Sales\Model\ResourceModel\Report\Collection\AbstractCollection
{
    protected $_periodFormat;
    /**
     * @var string
     */
    protected $_aggregationTable = 'sales_order';
    /**
     * @var array
     */
    protected $_selectedColumns = [];

    /**
     * Collection constructor.
     * @param \Magento\Framework\Data\Collection\EntityFactory $entityFactory
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy
     * @param \Magento\Framework\Event\ManagerInterface $eventManager
     * @param \Magento\Sales\Model\ResourceModel\Report $resource
     * @param \Magento\Framework\DB\Adapter\AdapterInterface|null $connection
     */
    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactory $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Sales\Model\ResourceModel\Report $resource,
        \Magento\Framework\DB\Adapter\AdapterInterface $connection = null,
        string $mainTable = 'sales_order'
    ) {
        $resource->init($this->_aggregationTable);
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $resource, $connection);
    }

    /**
     * @return \Magento\Sales\Model\ResourceModel\Report\Collection\AbstractCollection
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _beforeLoad()
    {
        $shipmentJoinCondition   = array(
            'sales_order.entity_id=order.order_id'
        );

        $this->getSelect()->from($this->getResource()->getMainTable())
            ->joinLeft(
                array('order' => $this->getTable('sales_order_item')),
                implode(' AND ', $shipmentJoinCondition),
                array(
                    'subtotal' => 'sales_order.subtotal',
                    'sku'=>'order.sku',
                    'qty_ordered'=>'order.qty_ordered'
                ));

        return parent::_beforeLoad();
    }
    /**
     * @return $this|\Magento\Sales\Model\ResourceModel\Report\Collection\AbstractCollection
     */
    protected function _applyDateRangeFilter()
    {
        if ($this->_from !== null) {
            $this->getSelect()->where($this->_aggregationTable.'.created_at >= ?', $this->_from);
        }
        if ($this->_to !== null) {
            $this->getSelect()->where($this->_aggregationTable.'.created_at <= ?', $this->_to);
        }
        return $this;
    }
    protected function _applyStoresFilter()
    {
        return null;
    }
}
