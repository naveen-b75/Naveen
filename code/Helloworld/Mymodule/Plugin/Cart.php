<?php
namespace Helloworld\Mymodule\Plugin;

/** The first input argument is $subject - the original class object */
class Cart
{
    /**
     * Before methods are the first methods to run in an observed method.
     * Before plugin is used to change the input data of the original function
     */

    public function beforeAddProduct(\Magento\Checkout\Model\Cart $subject,
                                     $productInfo,
                                     $requestInfo=null){
        $requestInfo['qty']=10;
        return array($productInfo,$requestInfo);
    }

    /**
     * After methods start running right after the observed method is finished.
     * After plugin is used to modify the original function result or allows to run the code
     * after the original function (getName) execution
     */

    public function afterGetName(\Magento\Catalog\Model\Product $subject,$result){
        return $result.' - (Delivered by Chanel)';
    }

    /**
     * Around methods allows the code to run before and after the observed method.
     * Around plugin changes the original function result based on the input data
     * or disables the execution of the original function. It is not recommended to use.
     *
     * $proceed - the callable variable that allows executing
     * original function and other plugins in a queue.
     *
     * If the $proceed() function is not executed, then the standard code,
     * as well as the lower priority plugins, will not be enabled
     */

   /* public function aroundAddProduct(\Magento\Checkout\Model\Cart $subject,
   \Closure $proceed,$productInfo,$requestInfo=null){
        $requestInfo['qty']=5;
        $result=$proceed($productInfo,$requestInfo);
        return $result;
    }*/
}