<?php
namespace Custom\Udemy\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Customer\Api\CustomerMetadataInterface;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Customer\Model\ResourceModel\Attribute;

class UpgradeData implements UpgradeDataInterface{

    protected $eavSetupFactory;
    protected $customerFactory;
    protected $moduleSetup;
    protected $attribute;

    public function __construct(EavSetupFactory $eavSetupFactory,Attribute $attribute,CustomerSetupFactory $customerFactory,ModuleDataSetupInterface $moduleSetup)
    {
        $this->moduleSetup=$moduleSetup;
        $this->customerFactory=$customerFactory->create(['setup' => $moduleSetup]);
        $this->eavSetupFactory=$eavSetupFactory;
        $this->attribute=$attribute;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $this->moduleSetup->getConnection()->startSetup();
        try{
            $this->customerFactory->updateAttribute(
                CustomerMetadataInterface::ENTITY_TYPE_CUSTOMER,
                'customer_phone_number',[
                    'label'=>'Phone',
                    'required'=>1,
                    'position'=>50,
                    'system'=>0,
                    'user_defined'=>1,
                    'is_used_in_grid'=>1,
                    'is_visible_in_grid'=>1,
                    'is_filterable_in_grid'=>1,
                    'is_searchable-in_grid'=>1
                ]
            );

            $this->customerFactory->addAttributeToSet(CustomerMetadataInterface::ENTITY_TYPE_CUSTOMER,CustomerMetadataInterface::ATTRIBUTE_SET_ID_CUSTOMER,null,'customer_phone_number');
            $attribute=$this->customerFactory->getEavConfig()->getAttribute(CustomerMetadataInterface::ENTITY_TYPE_CUSTOMER,'customer_phone_number');
            $attribute->setData('used_in_forms',['adminhtml_customer']);
            $this->attribute->save($attribute);
        }catch (\Exception $e){
            echo $e->getMessage();
        }
        $setup->endSetup();
    }

}