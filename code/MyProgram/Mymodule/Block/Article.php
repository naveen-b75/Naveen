<?php

namespace MyProgram\Mymodule\Block;

use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use Magento\Catalog\Model\ProductFactory;
use Magento\InventoryCatalog\Plugin\CatalogInventory\Api\StockRegistry\AdaptUpdateStockStatusBySkuPlugin;
use \MyProgram\Mymodule\Model\ResourceModel\View\CollectionFactory as ViewCollectionFactory;


class Article extends Template
{
    /**
     * @var ViewCollectionFactory
     */
    protected $viewCollectionFactory = null;

    /**
     * @var ProductFactory
     */
    protected $productFactory;

    /**
     * Constructor
     *
     * @param Context $context
     * @param ViewCollectionFactory $viewCollectionFactory
     * @param array $data
     */
    public function __construct(ProductFactory $productFactory,
        Context $context,
        ViewCollectionFactory $viewCollectionFactory,
        array $data = []
    ) {
        $this->viewCollectionFactory  = $viewCollectionFactory;
        $this->productFactory=$productFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return viewCollectionFactory
     */
    public function getCollection()
    {
        return $this->viewCollectionFactory->create();
    }

    /**
     * For a given post, returns its url

     * @return string
     */
    public function getArticleUrl($viewId) {
         return $this->getUrl('nothing-mobille.html', ['_secure' => true]);
    }

    /**
     * @return string
     */
    public function  postUrl(){
        return $this->getUrl('mymodule/index/save');
    }

    /**
     * @return string
     */

    public function getDeleteUrl($id) {

        return $this->getUrl('mymodule/index/delete',['param'=>$id]);
    }
    /**
     * @return string
     */
    public function editPage(){
        return $this->getUrl('mymodule/index/edit');
    }

    /**
     * @param $data
     */
    public function createSimpleProducts($data){
        try {
            $simpleProduct = $this->productFactory->create();
            $simpleProduct->setName($data['name']);
            $simpleProduct->setSku($data['sku']);
            $simpleProduct->setTypeId('simple');

            $simpleProduct->setAttributeSetId(4);

            $simpleProduct->setVisibility(4);
            $simpleProduct->setPrice($data['price']);

            $simpleProduct->setWeight($data['weight']);
            $simpleProduct->setImage($data['image']);
            $simpleProduct->setSmallImage($data['small_image']);
            $simpleProduct->setThumbnail($data['thumbnail']);
            $simpleProduct->setStockData(array(
                'use_config_manage_stock' => 0,
                'manage_stock' => 1,
                'min_sale_qty' => 1,
                'max_sale_qty' => 10,
                'is_in_stock' => 1,
                'qty' => $data['qty']
            ));
            $simpleProduct->save();

        }catch (\Exception $e){
            echo $e->getMessage();
        }
    }
    public function Grouped()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $product = $objectManager->create('Magento\Catalog\Model\Product');
        $sku = 'sku14';
        $product->setSku($sku);
        $product->setName('Grouped Product34');
        $product->setWeight(1);
        $product->setPrice(100);
        $product->setDescription('description');
        $product->setAttributeSetId(6);
        $product->setCategoryIds(array(22));
        $product->setStatus(1);
        $product->setVisibility(4);
        $product->setTaxClassId(1);
        $product->setTypeId('grouped');
        $product->setStoreId(1);
        $product->setWebsiteIds(array(1));
        $product->setVisibility(4);
        $product->setImage('/var/www/html/magento244/pub/media/catalog/product/a/p/apple5.jpeg');
        $product->setSmallImage('/var/www/html/magento244/pub/media/catalog/product/a/p/apple5.jpeg');
        $product->setThumbnail('/var/www/html/magento244/pub/media/catalog/product/a/p/apple5.jpeg');
        $product->setStockData(array(
                'use_config_manage_stock' => 0,
                'manage_stock' => 1,
                'min_sale_qty' => 1,
                'max_sale_qty' => 2,
                'is_in_stock' => 1,
                'qty' => 1000
            )
        );
        $product->save();
        $childrenIds = [2, 3, 4];
        $associated = [];
        $position = 0;
        foreach ($childrenIds as $productId) {
            $position++;
            $linkedProduct = $objectManager->get('\Magento\Catalog\Api\ProductRepositoryInterface')->getById($productId);
            $productLink = $objectManager->create('\Magento\Catalog\Api\Data\ProductLinkInterface');
            $productLink->setSku($product->getSku())
                ->setLinkType('associated')
                ->setLinkedProductSku($linkedProduct->getSku())
                ->setLinkedProductType($linkedProduct->getTypeId())
                ->setPosition($position)
                ->getExtensionAttributes()
                ->setQty(1);
            $associated[] = $productLink;
        }
        $product->setProductLinks($associated);
        $product->save();
        $categoryIds = array('2', '3');
        $category = $objectManager->get('Magento\Catalog\Api\CategoryLinkManagementInterface');
        $category->assignProductToCategories($sku, $categoryIds);
        if ($product->getId()) {
            echo "Product Created";
        }
    }

    public function createConfigProduct($data){
        $product=$this->productFactory->create();
        $product->setName($data['name']);
        $product->setSku($data['sku']);
    }

}