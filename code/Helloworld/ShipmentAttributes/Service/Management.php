<?php


namespace Helloworld\ShipmentAttributes\Service;

use Helloworld\ShipmentAttributes\Api\Data\AttributesInterface;
use Helloworld\ShipmentAttributes\Api\ManagementInterface;
use Helloworld\ShipmentAttributes\Model\AttributesFactory;
use Helloworld\ShipmentAttributes\Model\ResourceModel\AttributesResource;

class Management implements ManagementInterface
{

    private $resource;


    private $factory;

    public function __construct(
        AttributesResource $resource,
        AttributesFactory $attributesFactory
    ) {
        $this->resource = $resource;
        $this->factory = $attributesFactory;
    }


    public function getByShipmentId(int $shipmentId): AttributesInterface
    {
        $object = $this->getNewInstance();
        $this->resource->load($object, $shipmentId, 'shipment_id');

        return $object;
    }

    public function getNewInstance(): AttributesInterface
    {
        return $this->factory->create();
    }
}
