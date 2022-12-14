<?php


namespace Helloworld\ShipmentAttributes\Api;

use Helloworld\ShipmentAttributes\Api\Data\AttributesInterface;


interface ManagementInterface
{

    public function getByShipmentId(int $shipmentId): AttributesInterface;
}
