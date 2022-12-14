<?php
namespace Helloworld\Mymodule\Ui\Component\Listing\Columns;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

/**
 * Class Actions
 * @package Helloworld\Mymodule\Ui\Component\Listing\Columns
 */
class Actions extends Column{
    protected $urlBuilder;

    /**
     * Actions constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(ContextInterface $context, UiComponentFactory $uiComponentFactory,UrlInterface $urlBuilder, array $components = [], array $data = [])
    {
        $this->urlBuilder=$urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if(isset($dataSource['data']['items'])){
            foreach ($dataSource['data']['items'] as &$items){
               $items[$this->getData('name')]['edit']=[
                   'href'=>$this->urlBuilder->getUrl('helloworld/create/index',
                       ['id'=>$items['id']]),
                   'label'=>__('Edit'),
                   'hidden'=>false,
               ];
               $items[$this->getData('name')]['delete']=[
                   'href'=>$this->urlBuilder->getUrl('helloworld/create/delete',
                   ['id'=>$items['id']]),
                   'label'=>__('Delete'),
                   'confirm'=>[
                       'title'=>__('Delete %1', $items['name']),
                       'message'=>__('Are you sure you want to delete %1 ?', $items['name'])
                   ],
                   'post'=>true,
                   'hidden'=>false,
               ];
            }
        }
        return $dataSource;
    }
}