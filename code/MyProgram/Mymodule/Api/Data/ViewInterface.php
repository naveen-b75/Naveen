<?php
namespace MyProgram\Mymodule\Api\Data;

interface ViewInterface
{
    const ID = 'ID';
    const PRODUCT  = 'product';
    const DESCRIPTION = 'description';
    const CREATED_AT = 'created_at';
 
    public function getProduct();

    public function getDescription();

    public function getCreatedAt();

    public function getId();

    public function setProduct($product);

    public function setDescription($description);

    public function setCreatedAt($createdAt);

    public function setId($id);
}