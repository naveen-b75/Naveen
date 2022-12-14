var config = {
    "map": {
        "*": {
            'Magento_Checkout/js/model/shipping-save-processor/default': 'Helloworld_Checkout/js/model/shipping-save-processor/default'
        }
    },
    config: {
        mixins: {
            'Magento_Checkout/js/view/shipping': {
                'Helloworld_Checkout/js/mixin/shipping-mixin': true
            },
            'Amazon_Payment/js/view/shipping': {
                'Helloworld_Checkout/js/mixin/shipping-mixin': true
            }
        }
    }
};
