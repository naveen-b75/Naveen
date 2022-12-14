<?php


namespace Helloworld\ShipmentAttributes\Model\ResourceModel\Collection;

use Helloworld\ShipmentAttributes\Model\ResourceModel\AttributesResource;
use Helloworld\ShipmentAttributes\Model\Attributes;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class AttributesCollection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Attributes::class, AttributesResource::class);
    }
}
