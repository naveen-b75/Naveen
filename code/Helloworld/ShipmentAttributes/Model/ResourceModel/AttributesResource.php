<?php


namespace Helloworld\ShipmentAttributes\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class AttributesResource extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('helloworld_shipment_attributes', 'entity_id');
    }
}
