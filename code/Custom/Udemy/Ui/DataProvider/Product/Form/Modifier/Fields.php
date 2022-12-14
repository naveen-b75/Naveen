<?php

namespace Custom\Udemy\Ui\DataProvider\Product\Form\Modifier;

use Laminas\Stdlib\MessageInterface;
use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Ui\Component\Form\Element\DataType\Date;
use Magento\Ui\Component\Form\Element\DataType\Text;
use Magento\Ui\Component\Form\Element\Input;
use Magento\Ui\Component\Form\Field;
use Magento\Ui\Component\Container;
use Magento\Framework\Message\ManagerInterface;
use Magento\Catalog\Model\ProductFactory;
use Magento\Reports\Model\ResourceModel\Product\Sold\CollectionFactory;
use Magento\Framework\UrlInterface;


class Fields extends AbstractModifier{

    private  $locator;

    protected $productFactoy;

    protected $request;

    protected $collectionFactory;

    protected $urlBuilder;

    protected $messageManager;


    public function __construct(UrlInterface $urlBuilder, ManagerInterface $messageManager,LocatorInterface $locator,CollectionFactory $collectionFactory, \Magento\Framework\App\RequestInterface $request, ProductFactory $productFactory)
    {
        $this->locator=$locator;
        $this->productFactoy=$productFactory;
        $this->request=$request;
        $this->collectionFactory=$collectionFactory;
        $this->urlBuilder=$urlBuilder;
        $this->messageManager=$messageManager;

    }

    public function modifyData(array $data)
    {
        return $data;
    }
    public function modifyMeta(array $meta)
    {
        $meta = array_replace_recursive(
            $meta,
            [
                'sold' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'label' => __('Total Products Sold'),
                                'collapsible' => true,
                                'componentType' => \Magento\Ui\Component\Form\Fieldset::NAME,
                                'dataScope' => 'data.product',
                                'sortOrder' => 10
                            ],
                        ],
                    ],
                    'children' => $this->getFields(),
                ],
            ],
        );
        return $meta;
    }
    protected function getFields()
    {
        return [
            'from'    => [
                'arguments' => [
                    'data' => [
                        'config' => [
                            'label'         => __('From'),
                            'componentType' => Field::NAME,
                            'formElement'   => Date::NAME,
                            'dataScope'     => 'from',
                            'default'         => $this->getFromDate(),
                            'dataType'      => Text::NAME,
                            'sortOrder'     => 10,
                        ],
                    ],
                ],
            ],
            'to' => [
                'arguments' => [
                    'data' => [
                        'config' => [
                            'label'         => __('To'),
                            'componentType' => Field::NAME,
                            'formElement'   => Date::NAME,
                            'dataScope'     => 'to',
                            'dataType'      => Text::NAME,
                            'default'         => $this->getToDate(),
                            'sortOrder'     => 20
                        ],
                    ],
                ],
            ],
            'result'=>[
                'arguments'=>[
                    'data'=>[
                        'config'=>[
                            'label'=>__('Total Sold Count :'),
                            'componentType'=>Field::NAME,
                            'formElement'   => Input::NAME,
                            'elementTmpl'=>'ui/form/element/text',
                            'sortOrder'=>40,
                            'value'=>$this->getProductsSold(),
                        ]
                    ]
                ]
            ],
            'button'=>[
                'arguments' => [
                    'data' => [
                        'config' => [
                            'title' => __('Get Count'),
                            'formElement' => 'container',
                            'additionalClasses' => 'admin__field-small',
                            'componentType' => 'container',
                            'component' => 'Magento_Ui/js/form/components/button',
                            'actions' => [
                                [
                                    'targetName' => 'product_form.product_form',
                                    'actionName' => 'save',
                                ],
                            ],
                            'sortOrder' => 30,
                        ],
                    ],
                ],
            ],
        ];
    }
    public function getProductsSold(){
        $request=$this->request->getParam('id');
        $productid=$this->productFactoy->create()->load($request);
        $from=$productid->getFrom();
        $to=$productid->getTo();
        if(!$to && !$from){
            $fromDate=null;
            $toDate=null;
            return 0;
        }
        else{
            $fromDate = date('Y-m-d 00:00:00', strtotime($from));
            $toDate=date('Y-m-d 23:59:59',strtotime($to));
            $customDataField=$this->collectionFactory->create()->addOrderedQty($fromDate,$toDate,true)->addAttributeToFilter('product_id',$request)->getFirstItem();
            return (int)$customDataField->getData('ordered_qty');
        }
    }
    public function getFromDate(){
        $request=$this->request->getParam('id');
        $productid=$this->productFactoy->create()->load($request);
        $from=$productid->getFrom();
        return $from;
    }
    public function getToDate(){
        $request=$this->request->getParam('id');
        $productid=$this->productFactoy->create()->load($request);
        $to=$productid->getTo();
        return $to;
    }
}
