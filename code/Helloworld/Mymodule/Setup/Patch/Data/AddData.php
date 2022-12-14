<?php
namespace Helloworld\Mymodule\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddData implements DataPatchInterface {

    protected $curdFactory;
    public function __construct(\Helloworld\Mymodule\Model\CurdFactory $curdFactory)
    {
        $this->curdFactory=$curdFactory;
    }

    public function apply()
    {
       $sampleDate=[
           [
               'name' => 'Samsung Mobile',
               'description' => 'Made in South Korea by samsung company'
           ],[
               'name' => 'Nokia 6500 Mobile',
               'description' => 'Made in Japan by Nokia private limited'
           ]
       ];
       foreach ($sampleDate as $data){
           $this->curdFactory->create()->setData($data)->save();
       }
    }
    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }
}