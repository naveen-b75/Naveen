<?php
namespace Helloworld\Mymodule\Block;

use Magento\Framework\View\Element\Html\Link as HeaderLink;

class Link extends HeaderLink{

    public function _toHtml(){
        if(false != $this->getTemplate()){
            return parent::_toHtml();
        }
        return '<a '.$this->getLinkAttributes() .' > '.$this->escapeHtml($this->getLabel()).'</a></li>';
    }
}