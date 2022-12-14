<?php
/**
 * Created by PhpStorm.
 * User: naveeni
 * Date: 13/9/22
 * Time: 12:49 PM
 */

namespace Custom\Udemy\Model;


use Magento\Framework\Model\AbstractModel;

class Item extends AbstractModel
{
    protected $_eventPrefix='udemy_sample_item';

    protected function _construct()
    {
        $this->_init(\Custom\Udemy\Model\ResourceModel\View::class);
    }

}