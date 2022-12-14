<?php


namespace Helloworld\ShipmentAttributes\Model;

use Magento\Framework\Model\AbstractModel;
use Helloworld\ShipmentAttributes\Model\ResourceModel\AttributesResource;
use Helloworld\ShipmentAttributes\Api\Data\AttributesInterface;

class Attributes extends AbstractModel implements AttributesInterface
{
    public const CARRIER = 'carrier';
    public const COST = 'cost';
    public const DELIVERY_DATE = 'delivery_date';
    public const SHIPMENT_ID = 'shipment_id';

    protected function _construct()
    {
        $this->_init(AttributesResource::class);
    }


    public function getShipmentId(): int
    {
        return (int) $this->getData(self::SHIPMENT_ID);
    }

    public function getCarrier(): string
    {
        return (string) $this->getData(self::CARRIER);
    }

    public function getCost(): float
    {
        return (float) $this->getData(self::COST);
    }

    public function getDeliveryDate(): string
    {
        return (string) $this->getData(self::DELIVERY_DATE);
    }
}
