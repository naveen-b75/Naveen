<?php

namespace Custom\Udemy\Model\Config\Backend;

class File extends \Magento\Config\Model\Config\Backend\File{

    protected function _getAllowedExtensions()
    {
        return ['pdf','svg','jpeg'];
    }

}