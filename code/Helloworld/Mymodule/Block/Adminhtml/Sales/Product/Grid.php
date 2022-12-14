<?php

namespace Helloworld\Mymodule\Block\Adminhtml\Sales\Product;

use Magento\Backend\Block\Widget\Grid\Column\Renderer\Currency;
use Helloworld\Mymodule\Model\ResourceModel\Report\Product\CollectionFactory;


    /**
 * Class Grid
 * @package Helloworld\Mymodule\Block\Adminhtml\Sales\Product
 */
class Grid extends \Magento\Reports\Block\Adminhtml\Grid\AbstractGrid

{
    protected $factory;
    /**
     * @var string
     */
    protected $_columnGroupBy = 'created_at';

    /**
     * @var \Magento\Framework\Pricing\Helper\Data
     */
    protected $priceHelper;
    /**
     * Grid constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Magento\Framework\Pricing\Helper\Data $priceHelper
     * @param \Magento\Reports\Model\ResourceModel\Report\Collection\Factory $resourceFactory
     * @param \Magento\Reports\Model\Grouped\CollectionFactory $collectionFactory
     * @param CollectionFactory $factory
     * @param \Magento\Reports\Helper\Data $reportsData
     * @param array $data
     */
    public function __construct(\Magento\Backend\Block\Template\Context $context,
                                \Magento\Backend\Helper\Data $backendHelper,
                                \Magento\Framework\Pricing\Helper\Data $priceHelper,
                                \Magento\Reports\Model\ResourceModel\Report\Collection\Factory $resourceFactory,
                                \Magento\Reports\Model\Grouped\CollectionFactory $collectionFactory,
                                CollectionFactory $factory,
                                \Magento\Reports\Helper\Data $reportsData, array $data = [])
    {
        $this->factory=$factory;
        $this->priceHelper=$priceHelper;
        parent::__construct($context, $backendHelper, $resourceFactory, $collectionFactory, $reportsData, $data);
    }
    /**
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setCountTotals(true);
    }
    /**
     * @return string
     */
    public function getResourceCollectionName()
    {
        return \Helloworld\Mymodule\Model\ResourceModel\Report\Product\Collection::class;
    }
    /**
     * @return \Magento\Reports\Block\Adminhtml\Grid\AbstractGrid
     * @throws \Exception
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'created_at',
            [
                'header' => __('Order Date'),
                'index' => 'created_at',
                'type' => 'date',
                'sortable' => false,
                'totals_label'     => __('Total'),
                'html_decorators'  => ['nobr'],
                'header_css_class' => 'col-sales-items',
                'column_css_class' => 'col-sales-items'
            ]
        );
        $this->addColumn(
            'increment_id',
            [
                'header' => __('Order#'),
                'index' => 'increment_id',
                'type' => 'number',
                'totals_label'      => '' ,
                'sortable' => false,
                'header_css_class' => 'col-orders',
                'column_css_class' => 'col-orders'
            ]
        );
        $this->addColumn(
            'sku',[
                'header'=>__('Product Sku'),
                'index'=>'sku',
                'type'=>'text',
                'totals_label' => '' ,
                'sortable'=>false,
                'header_css_class'=>'col-sku',
                'column_css_class'=>'col-sku',
            ]
        );
        $this->addColumn(
            'total_qty_ordered',
            [
                'header' => __('Qty. Ordered'),
                'index' => 'qty_ordered',
                'type' => 'number',
                'totals_label'    => $this->getQty() ,
                'sortable' => false,
                'header_css_class' => 'col-sales-ordered',
                'column_css_class' => 'col-sales-ordered'
            ]
        );
        $this->addColumn(
            'subtotal',
            [
                'header' => __('Subtotal'),
                'index' => 'subtotal',
                'type' => 'currency',
                'totals_label'=>$this->getSubTotal(),
                'renderer' => Currency::class,
                'sortable' => false,
                'header_css_class' => 'col-sales-subtotal',
                'column_css_class' => 'col-sales-subtotal'
            ]
        );
        $this->addColumn(
            'grand_total',
            [
                'header' => __('Total'),
                'index' => 'grand_total',
                'type' => 'currency',
                'totals_label'      => $this->getTotal() ,
                'sortable' => false,
                'renderer' => Currency::class,
                'header_css_class' => 'col-sales-total',
                'column_css_class' => 'col-sales-total'
            ]
        );
        $this->addExportType('*/*/exportSalesCsv', __('CSV'));
        $this->addExportType('*/*/exportSalesExcel', __('Excel XML'));
        return parent::_prepareColumns();
    }
    /**
     * @return int
     */
    public function getTotal(){

       $item = $this->_prepareCollection();

       $totalAmount = 0;
      foreach ($item->getSubTotals() as $item){

          $totalAmount += (int)$item['base_grand_total'];
      }
        return $this->priceHelper->currency($totalAmount,true,false);
    }
    /**
     * @return int
     */
    public function getSubTotal()
    {
        $item = $this->_prepareCollection();
        $totalAmount = 0;
        foreach ($item->getSubTotals() as $item){
            $totalAmount += (int)$item['base_subtotal'];
        }
        return $this->priceHelper->currency($totalAmount,true,false);
    }
    /**
     * @return int
     */
    public function getQty(){
        $item = $this->_prepareCollection();
        $totalAmount = 0;
        foreach ($item->getSubTotals() as $item){
            $totalAmount += (int)$item['qty_ordered'];
        }
        return $totalAmount;
    }
}