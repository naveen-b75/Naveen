<?php
namespace Helloworld\Commands\Console;

use Magento\Framework\App\Area;
use Symfony\Component\Console\Command\Command;
use Magento\Framework\App\State;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\Indexer\IndexerRegistry;
/**
 * Class Products
 * @package Helloworld\Commands\Console
 */
class Products extends Command{

    const PRODUCT_SKU ='product_sku';
    /**
     * @var Product
     */
    private $product;
    /**
     * @var State
     */
    private $state;
    /**
     * @var IndexerRegistry
     */
    private $indexRegistry;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * Products constructor.
     * @param State $state
     * @param IndexerRegistry $indexerRegistry
     * @param Product $product
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(State $state, IndexerRegistry $indexerRegistry,Product $product, CollectionFactory $collectionFactory)
    {
        $this->product=$product;
        $this->collectionFactory=$collectionFactory;
        $this->indexRegistry=$indexerRegistry;
        $this->state=$state;
        parent::__construct();
    }
    protected function configure()
    {
        $this->setName('product:by:sku');
        $this->setDescription('Get product by sku');
        $this->addArgument(self::PRODUCT_SKU,
            InputArgument::REQUIRED,
            'product_sku');
        parent::configure();
    }
    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Symfony\Component\Console\Exception\ExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->state->setAreaCode(Area::AREA_ADMINHTML);
        $productsku=$input->getArgument(self::PRODUCT_SKU);
        $out=explode(',',$productsku);
        foreach($out as $product){
            $data=$this->product->getIdBySku($product);
            if($data){
                $output->writeln("Product with sku '{$product}' is exits ");
            }else{
                $output->writeln("Product with sku '{$product}' is does't exit");
            }
            $allProductIds[]=$this->product->getIdBySku($product);
        }
       //print_r($allProductIds);
        $productId=$allProductIds;
        $indexList=[
            'catalog_category_product',
            'catalog_product_category',
            'catalog_product_attribute',
            'catalogrule_product',
            'catalog_product_price'
        ];
        foreach ($indexList as $index) {
            $categoryIndex = $this->indexRegistry->get($index);
            if (!$categoryIndex->isScheduled()){
                $categoryIndex->reindexList($productId);
                echo $index." re-indexed successfully. \n";
            }else{
                echo 'failed to reindex';
            }
        }

        $arguments=new ArrayInput(['command'=>'cache:flush']);
        $this->getApplication()->find('cache:flush')->run($arguments,$output);
    }
}