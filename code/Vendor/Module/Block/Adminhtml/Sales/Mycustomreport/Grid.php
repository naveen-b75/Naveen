<?php

namespace Vendor\Module\Block\Adminhtml\Sales\Mycustomreport;

class Grid extends \Magento\Reports\Block\Adminhtml\Grid\AbstractGrid
{
    /**
     * GROUP BY criteria
     *
     * @var string
     */
    protected $_columnGroupBy = 'entity_id';

    /**
     * {@inheritdoc}
     * @codeCoverageIgnore
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setCountTotals(true);

    }
    /**
     * {@inheritdoc}
     * @codeCoverageIgnore
     */
    public function getResourceCollectionName()
    {
        //return \Helloworld\Mymodule\Model\ResourceModel\Report\Product\Collection::class;

        return \Vendor\Module\Model\ResourceModel\Report\MyCustomReport\Collection::class;
    }

    /**
     * {@inheritdoc}
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'creation_date',
            [
                'header' => __('Interval'),
                'index' => 'creation_date',
                'sortable' => false,
                'renderer' => \Magento\Reports\Block\Adminhtml\Sales\Grid\Column\Renderer\Date::class,
                'totals_label' => __('Total'),
                'html_decorators' => ['nobr'],
                'header_css_class' => 'col-period',
                'column_css_class' => 'col-period'
            ]
        );

        $this->addColumn(
            'increment_id',
            [
                'header' => __('Order Number'),
                'index' => 'increment_id',
                'type' => 'string',
                'total'=>'sum',
                'sortable' => false,
                'header_css_class' => 'col-product',
                'column_css_class' => 'col-product'
            ]
        );

        $this->addColumn(
            'total_qty_ordered',
            [
                'header' => __('Product Qty'),
                'index' => 'total_qty_ordered',
                'type' => 'number',
                'total'=>'sum',
                'sortable' => false,
                'header_css_class' => 'col-product',
                'column_css_class' => 'col-product'
            ]
        );
        $this->addColumn(
            'grand_total',
            [
                'header' => __('Order Amount'),
                'index' => 'grand_total',
                'type' => 'number',
                'total' => 'sum',
                'sortable' => false,
                'header_css_class' => 'col-qty',
                'column_css_class' => 'col-qty'
            ]
        );

        return parent::_prepareColumns();
    }
}