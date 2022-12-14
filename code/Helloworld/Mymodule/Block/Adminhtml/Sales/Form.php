<?php

namespace Helloworld\Mymodule\Block\Adminhtml\Sales;
/**
 * Class Form
 * @package Helloworld\Mymodule\Block\Adminhtml\Sales
 */
class Form extends \Magento\Reports\Block\Adminhtml\Filter\Form
{
    /**
     * @return $this|\Magento\Reports\Block\Adminhtml\Filter\Form
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        parent::_prepareForm();
        /** @var \Magento\Framework\Data\Form\Element\Fieldset $fieldset */
        $fieldset = $this->getForm()->getElement('base_fieldset');
            $fieldset->addField(
                'show_report',
                'checkbox',
                [
                    'label' => __('Show Report'),
                    'title' => __('Show Report'),
                    'class' => 'admin__actions-switch-checkbox',
                    'after_element_js' => '
            <label class="admin__actions-switch-label" for="sales_report_show_report">
                <span class="admin__actions-switch-text" data-text-on="'.__('Yes').'" data-text-off="'.__('No').'"></span>
            </label>
             </label>
            <script type="text/javascript">
                require(["jquery"], function($){
                    $("#sales_report_show_report").change(function() {
                         $(".field-from").toggle();
                         $(".field-to").toggle();
                         $(".field-show_empty_rows").toggle();
                         $(".admin__data-grid-toolbar").toggle();
                          $(".admin__data-grid-wrap-static").toggle();
                    });
                });
            </script>
        ',
                ],
              'period_type'
            );
        return $this;
    }
}
