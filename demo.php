<?php
    use Magento\Framework\App\Bootstrap;
    require dirname(__DIR__) . '/app/bootstrap.php';

    $bootstrap = Bootstrap::create(BP, $_SERVER);
    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
    $connection = $resource->getConnection();
    $cmsPageTable = $resource->getTableName('customer_entity');
    $cmsPageStoreTable = $resource->getTableName('customer_address_entity');
    $sql = "SELECT  customerDetails.entity_id, customerDetails.email, 
    customerDetails.increment_id,customerDetails.created_at,customerDetails.updated_at,
    customerDetails.firstname, customerDetails.lastname, customerDetails.gender,
    customerDetails.password_hash,customerAddress.street,customerAddress.city,
    customerAddress.company,customerAddress.region,customerAddress.postcode,customerAddress.telephone  
    FROM ".$cmsPageTable." as customerDetails LEFT OUTER JOIN ".$cmsPageStoreTable." as
    customerAddress ON customerAddress.parent_id = customerDetails.entity_id";


    $result = $connection->fetchAll($sql);
    print_r($result);
