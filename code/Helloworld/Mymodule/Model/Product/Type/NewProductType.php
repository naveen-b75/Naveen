<?php

namespace Helloworld\Mymodule\Model\Product\Type;

class NewProductType extends \Magento\Catalog\Model\Product\Type\AbstractType{


    const TYPE_CODE = 'new_product_type';

    /**
     * @param \Magento\Catalog\Model\Product $product
     * @return void
     */
    public function deleteTypeSpecificData(\Magento\Catalog\Model\Product $product)
    {
        // TODO: Implement deleteTypeSpecificData() method.
    }
}