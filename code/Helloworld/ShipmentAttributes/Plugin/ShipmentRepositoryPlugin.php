<?php

declare(strict_types=1);

namespace Helloworld\ShipmentAttributes\Plugin;

use Helloworld\ShipmentAttributes\Api\ManagementInterface;
use Magento\Sales\Api\Data\ShipmentInterface;
use Magento\Sales\Api\Data\ShipmentSearchResultInterface;
use Magento\Sales\Api\ShipmentRepositoryInterface;

class ShipmentRepositoryPlugin
{

    private $management;


    public function __construct(
        ManagementInterface $management
    ) {
        $this->management = $management;
    }


    public function afterGetList(
        ShipmentRepositoryInterface $subject,
        ShipmentSearchResultInterface $shipmentSearchResult
    ): ShipmentSearchResultInterface {
        foreach ($shipmentSearchResult->getItems() as $shipment) {
            $this->afterGet($subject, $shipment);
        }
        return $shipmentSearchResult;
    }


    public function afterGet(
        ShipmentRepositoryInterface $subject,
        ShipmentInterface $shipment
    ): ShipmentInterface {
        $shipmentAttribute = $this->management->getByShipmentId((int) $shipment->getEntityId());
        $extensionAttributes = $shipment->getExtensionAttributes();
        $extensionAttributes->setCost($shipmentAttribute->getCost());
        $extensionAttributes->setDeliveryDate($shipmentAttribute->getDeliveryDate());
        $extensionAttributes->setCarrier($shipmentAttribute->getCarrier());
        $shipment->setExtensionAttributes($extensionAttributes);
        return $shipment;
    }
}
