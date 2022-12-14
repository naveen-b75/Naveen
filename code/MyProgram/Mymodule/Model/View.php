<?php

namespace MyProgram\Mymodule\Model;

use \Magento\Framework\Model\AbstractModel;
use \Magento\Framework\DataObject\IdentityInterface;
use \MyProgram\Mymodule\Api\Data\ViewInterface;


class View extends AbstractModel
{

    const CACHE_TAG = 'myprogram_mymodule_view';

    protected function _construct()
    {
        $this->_init(\MyProgram\Mymodule\Model\ResourceModel\View::class);
    }


   /* public function getProduct()
    {
        return $this->getData(self::PRODUCT);
    }

    public function getDescription()
    {
        return $this->getData(self::DESCRIPTION);
    }

    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    public function getId()
    {
        return $this->getData(self::ID);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function setProduct($product)
    {
        return $this->setData(self::PRODUCT, $product);
    }

    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }*/
}