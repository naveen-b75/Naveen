<?php

namespace Helloworld\Mymodule\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper{

    /**
     * Helpers are usually used as elements that are global and always available.
     * They can even be created as single instance of a object.
     * MyHelper function can be used anywhere in the magento using dependency injection
     */

    public function MyHelper(){
        echo "Helper Called successfully";
    }
}