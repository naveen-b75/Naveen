<?php
namespace Helloworld\Mymodule\Setup\Patch\Data;

use Braintree\Exception;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Setup\CustomerSetup;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Customer\Model\ResourceModel\Attribute;
use Magento\Customer\Api\CustomerMetadataInterface;
use Psr\Log\LoggerInterface;


class AddCustomerAttribute implements DataPatchInterface{

    protected $moduleDataSetup;

    private $customerSetupFactory;

    protected $attribute;

    private $logger;

    public function __construct(ModuleDataSetupInterface $moduleDataSetup,LoggerInterface $logger,Attribute $attribute,CustomerSetupFactory $customerSetupFactory)
    {
        $this->moduleDataSetup=$moduleDataSetup;
        $this->logger=$logger;
        $this->customerSetupFactory=$customerSetupFactory->create(['setup' => $moduleDataSetup]);
        $this->attribute=$attribute;
    }
    public static function getDependencies()
    {
        return [];
    }
    public function getAliases()
    {
        return[];
    }
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        try{
            $this->customerSetupFactory->addAttribute(
                CustomerMetadataInterface::ENTITY_TYPE_CUSTOMER,
                'customer_phone_number',[
                    'label'=>'Phone Number',
                    'required'=>0,
                    'position'=>50,
                    'system'=>0,
                    'user_defined'=>1,
                    'is_used_in_grid'=>1,
                    'is_visible_in_grid'=>1,
                    'is_filterable_in_grid'=>1,
                    'is_searchable-in_grid'=>1
                ]
            );

            $this->customerSetupFactory->addAttributeToSet(CustomerMetadataInterface::ENTITY_TYPE_CUSTOMER,CustomerMetadataInterface::ATTRIBUTE_SET_ID_CUSTOMER,null,'customer_phone_number');
            $attribute=$this->customerSetupFactory->getEavConfig()->getAttribute(CustomerMetadataInterface::ENTITY_TYPE_CUSTOMER,'customer_phone_number');
            $attribute->setData('used_in_forms',['adminhtml_customer']);
            $this->attribute->save($attribute);
        }catch (\Exception $e){
            $this->logger->error($e->getMessage());
        }
        $this->moduleDataSetup->getConnection()->endSetup();
    }

}