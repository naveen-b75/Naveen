<?php
namespace Helloworld\Mymodule\Setup;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Customer\Setup\CustomerSetupFactory;

/**
 * Class UpgradeData
 * @package Helloworld\Mymodule\Setup
 */
class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    protected $customerSetupFactory;

    protected $moduleDataSetup;

    /**
     * UpgradeData constructor.
     * @param EavSetupFactory $eavSetupFactory
     * @param CustomerSetupFactory $customerSetupFactory
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(EavSetupFactory $eavSetupFactory,CustomerSetupFactory $customerSetupFactory,ModuleDataSetupInterface $moduleDataSetup)
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->moduleDataSetup=$moduleDataSetup;
        $this->customerSetupFactory=$customerSetupFactory->create(['setup'=>$moduleDataSetup]);
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '2.0.7') < 0) {
            $this->customerSetupFactory->removeAttribute(
                \Magento\Customer\Api\CustomerMetadataInterface::ENTITY_TYPE_CUSTOMER,'customer_phone_number'
            );
            $this->customerSetupFactory->removeAttribute(\Magento\Customer\Api\CustomerMetadataInterface::ATTRIBUTE_SET_ID_CUSTOMER,'customer_phone_number');
        }

        $setup->endSetup();
    }


    private function upgradeSchema205(ModuleDataSetupInterface $setup)
    {
        //$eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        $this->customerSetupFactory->removeAttribute(
            \Magento\Customer\Api\CustomerMetadataInterface::ENTITY_TYPE_CUSTOMER,'customer_phone_number'
        );
        /*$eavSetup->removeAttribute(
            \Magento\Customer\Api\CustomerMetadataInterface::ENTITY_TYPE_CUSTOMER,
            'customer_phone_number'
        );*/
    }
}