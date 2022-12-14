<?php

namespace Helloworld\Mymodule\Controller\Adminhtml\Report;

use Helloworld\Mymodule\Model\Flag;
/**
 * Class Product
 * @package Helloworld\Mymodule\Controller\Adminhtml\Report
 */
class Product extends \Magento\Reports\Controller\Adminhtml\Report\Sales
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        //$this->_showLastExecutionTime(Flag::REPORT_PRODUCTREPORT_FLAG_CODE, 'order');
        $this->_initAction()->_setActiveMenu(
            'Magento_Reports::report'
        );
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Product Report'));
        $gridBlock = $this->_view->getLayout()->getBlock('adminhtml_sales_product.grid');
        $filterFormBlock = $this->_view->getLayout()->getBlock('grid.filter.form');
        $this->_initReportAction([$gridBlock, $filterFormBlock]);
        $this->_view->renderLayout();
    }
}