<?php
namespace Helloworld\Mymodule\Model\Plugin\Checkout;

class LayoutProcessor {

    public function afterProcess(\Magento\Checkout\Block\Checkout\LayoutProcessor $subject, array $jsLayout){
        $jsLayout['components']['checkout']['children']['steps']['children']
        ['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']
        ['custom_field']=
            ['component'=>'Magento_Ui/js/form/element/abstract',
                'config'=>['customScope'=>'shippingAddress.custom_attributes',
                    'template'=>'ui/form/field',
                    'elementTmpl'=>'ui/form/element/input',
                    'options'=>[],
                    'id'=>'add_custom_field'],
                'dataScope'=>'shippingAddress.custom_attributes.custom_field',
                'label'=>'Custom Field',
                'provider'=>'checkoutProvider',
                'visible'=>true,
                'validation'=>[],
                'sortOrder'=>250,
                'id'=>'add-custom-field'];
        return $jsLayout;
    }
}