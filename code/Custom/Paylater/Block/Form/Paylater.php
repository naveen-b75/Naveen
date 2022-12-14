<?php

namespace Custom\Paylater\Block\Form;


class Paylater extends \Magento\OfflinePayments\Block\Form\AbstractInstruction
{
    /**
     * Custom payment template
     *
     * @var string
     */
    protected $_template = 'Custom_Paylater::form/paylater.phtml';
}