<?php
namespace Helloworld\Mymodule\Setup;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class InstallData
 * @package Helloworld\Mymodule\Setup
 */
class InstallData implements InstallDataInterface{
    /**
     * @var EavSetupFactory
     */

    private $eavSetupFactory;

    /**
     * InstallData constructor.
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory=$eavSetupFactory;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {

        $eavSetup=$this->eavSetupFactory->create(['setup'=>$setup]);

        $fieldList=[
            'price',
            'special_price',
            'special_from_date',
            'special_to_date',
            'minimal_price',
            'cost',
            'tier_price',
            'weight',
        ];

        foreach ($fieldList as$field){
            $applyTo=explode(',',$eavSetup->getAttribute(\Magento\Catalog\Model\Product::ENTITY,$field,'apply_to'));
            if(!in_array('new_produce_type',$applyTo)){
                $applyTo[]='new_product_type';
                $eavSetup->updateAttribute(\Magento\Catalog\Model\Product::ENTITY,$field,'apply_to',implode(',',$applyTo));
            }
        }
    }
}