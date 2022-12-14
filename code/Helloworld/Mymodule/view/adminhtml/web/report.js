define([
   'underscore',
    'uiRegistry',
    'Magento_Ui/js/form/element/single-checkbox',
    'Magento_Ui/js/modal/modal',
    'ko'
],function (_, uiRegistry,select,modal,ko) {
    'use strict';
    return select.extend({
        initialize :function () {
            this._super();
            this.fieldDepend(this.value());
            return this;
        },
        onUpdate:function (value) {
            console.log(value);
            var field_min_val = uiRegistry.get('index = from');
            var field_max_val = uiRegistry.get('index=to');

            if(value == 0){
                field_max_val.hide();
                field_min_val.hide();
            }else{
                field_min_val.show();
                field_max_val.show();
            }
            return this._super();
        }
    })
    }
);