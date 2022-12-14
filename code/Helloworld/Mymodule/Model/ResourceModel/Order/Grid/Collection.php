<?php

namespace Helloworld\Mymodule\Model\ResourceModel\Order\Grid;

use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Psr\Log\LoggerInterface as Logger;
use Magento\Sales\Model\ResourceModel\Order\Shipment\Grid\Collection as OriginalCollection;


/**
 * Order grid extended collection
 */
class Collection extends OriginalCollection
{
    protected $helper;

   public function __construct(EntityFactory $entityFactory, Logger $logger, FetchStrategy $fetchStrategy,
                               EventManager $eventManager,
                               string $mainTable = 'sales_shipment_grid',
                               string $resourceModel = \Magento\Sales\Model\ResourceModel\Order\Shipment::class)
   {
       parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $mainTable, $resourceModel);
   }

    public function _renderFiltersBefore()
    {
        $thirdTable=$this->getTable('sales_order');
        $joinTable=$this->getTable('sales_shipment_track');
        $this->getSelect()->joinLeft($joinTable, 'main_table.entity_id=sales_shipment_track.parent_id',['track_number'])
        ->joinLeft($thirdTable,'main_table.order_increment_id=sales_order.increment_id',['sales_order.status AS order_status',
            'sales_order.customer_email AS customer_email','sales_order.grand_total AS order_total']);
        parent::_renderFiltersBefore();
    }

}