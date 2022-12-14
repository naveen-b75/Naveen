  var config={
    paths:{
        'myfile':'Helloworld_Mymodule/js/custom.js'
    },
      'shim':{
        'myfile':{
            deps:['jquery']
        }
      },
     config:{
         mixins: {
             'Magento_Checkout/js/action/place-order': {
                 'Helloworld_Mymodule/js/order/place-order-mixin': true
             },
         }
     }
  };
