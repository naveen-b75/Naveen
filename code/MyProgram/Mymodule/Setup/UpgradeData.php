<?php/**
namespace MyProgram\Mymodule\Setup;
use Magento\Framework\Setup\UpgradeData;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class InstallData 
 *
 * @package Thecoachsmb\Mymodule\Setup
 */
class UpgradeData implements InstallDataInterface
{
    /**
     * Creates sample articles
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $conn = $setup->getConnection(); 
        $tableName = $setup->getTable('sample_table');
            $data = [
                [
                    'product' => 'Oppo 225X 4G 264gb-rom 24gb-ram',
                    'description' => 'Imported form Indonasia, limited edition for august event.',
                ],
                [
                    'product' => 'Samsung s40 4G 264gb-rom 24gb-ram',
                    'description' => 'Made on south korea flipable mobile avilable for limited edition only.',
                ],
            ];
           $conn->insertMultiple($tableName, $data); 
           $setup->endSetup(); 
       } 
   }