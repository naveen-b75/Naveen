<?php
namespace Helloworld\Mymodule\Block\Adminhtml\Sales;

class Product extends \Magento\Backend\Block\Widget\Grid\Container{

    protected $_template = 'Magento_Reports::report/grid/container.phtml';

    protected function _construct()
    {
        $this->_blockGroup = 'Helloworld_Mymodule';
        $this->_controller = 'adminhtml_sales_product';
        $this->_headerText = __('Order Report');
        parent::_construct();
        $this->buttonList->remove('add');
        $this->addButton(
            'filter_form_submit',
            ['label' => __('Show Report'), 'onclick' => 'filterFormSubmit()', 'class' => 'primary']
        );
    }

    /**
     * Get filter URL
     *
     * @return string
     */
    public function getFilterUrl()
    {
        $this->getRequest()->setParam('filter', null);
        return $this->getUrl('helloworld/report/product', ['_current' => true]);
    }
}