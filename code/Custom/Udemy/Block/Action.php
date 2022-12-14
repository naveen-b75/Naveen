<?php
namespace Custom\Udemy\Block;

use Custom\Udemy\Model\ResourceModel\View\CollectionFactory as viewCollection;
use Magento\Framework\View\Element\Template;


class Action extends Template{

    private $collectionFactory;


    public function __construct(Template\Context $context,viewCollection $collectionFactory, array $data = [])
    {
        $this->collectionFactory=$collectionFactory;

        parent::__construct($context, $data);
    }
    /**
     * @return \Mastering\SampleModule\Model\Item[]
     */
    public function getItems()
    {
        return $this->collectionFactory->create()->getItems();
    }

}