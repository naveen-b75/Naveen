<?php

namespace Helloworld\Mymodule\Block;

use Magento\Framework\View\Element\Template;

class EventBlock extends Template{

    public function toHtml(){
        return "Event is Triggered";
    }
}