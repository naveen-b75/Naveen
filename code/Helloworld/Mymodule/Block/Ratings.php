<?php
namespace Helloworld\Mymodule\Block;


use Magento\Framework\View\Element\Template;
use Magento\Review\Model\ResourceModel\Review\CollectionFactory;
use Magento\Sales\Model\ResourceModel\Report\Bestsellers\CollectionFactory as BestSeller;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as Products;
use Magento\Reports\Model\ResourceModel\Product\CollectionFactory as MostViewed;
use Magento\Catalog\Model\Product\Visibility;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory as OrderCollection;
use Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory as NewProducts;
use Magento\Wishlist\Model\ResourceModel\Item\CollectionFactory as Wishlist;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory as Customer;
use Magento\GroupedProduct\Model\Product\Type\Grouped;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory as CategoryCollection;
use Magento\Catalog\Model\ProductRepository;
use Magento\Directory\Model\Currency;
use Magento\Customer\Model\ResourceModel\Group\Collection;
use Magento\Theme\Block\Html\Header\Logo;
use Magento\Inventory\Model\ResourceModel\Stock\CollectionFactory as StockCollection;
use Magento\Sales\Model\Order;
use Magento\Customer\Model\CustomerFactory;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Sales\Model\Service\InvoiceService;
use Magento\Framework\Db\Transaction;
use Magento\Sales\Model\Order\Email\Sender\InvoiceSender;
use Magento\Catalog\Model\Product;
use Magento\Framework\Data\Form\FormKey;
use Magento\Quote\Model\QuoteFactory;
use Magento\Quote\Model\QuoteManagement;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Sales\Model\Service\OrderService;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Quote\Api\CartManagementInterface;
use Magento\Shipping\Model\ShipmentNotifier;
use Magento\Sales\Model\Convert\Order as OrderConverter;
use Magento\Catalog\Model\Product\Attribute\Source\Status;
use Magento\Catalog\Model\Product\Type;
use Magento\Catalog\Model\ProductFactory;
use Magento\CatalogInventory\Api\StockRegistryInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\InventoryApi\Api\Data\SourceItemInterfaceFactory;
use Magento\InventoryApi\Api\SourceItemsSaveInterface;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory as OrderFactory;
/**
 * Class Ratings
 * @package Helloworld\Mymodule\Block
 */

class Ratings extends Template{

    protected $orderFactory;
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;
    /**
     * @var MostViewed
     */
    protected $mostViewed;
    /**
     * @var BestSeller
     */
    protected $bestsellerFactory;
    /**
     * @var Products
     */
    protected $productFactory;
    /**
     * @var Customer
     */
    protected $customer;
    /**
     * @var Visibility
     */
    protected $visibility;
    /**
     * @var NewProducts
     */
    protected $newProducts;
    /**
     * @var OrderCollection
     */
    protected $orderCollection;
    /**
     * @var Wishlist
     */
    protected $wishlist;
    /**
     * @var Grouped
     */
    protected $grouped;
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;
    /**
     * @var CategoryCollection
     */
    protected $categoryCollection;
    /**
     * @var ProductRepository
     */
    protected $productRepository;
    /**
     * @var Currency
     */
    protected $currency;
    /**
     * @var Collection
     */
    protected $groupCollection;
    /**
     * @var Logo
     */
    protected $logo;
    /**
     * @var StockCollection
     */
    protected $stockCollection;
    /**
     * @var Order
     */
    protected $order;
    /**
     * @var CustomerFactory
     */
    protected $customerFactory;
    /**
     * @var OrderRepositoryInterface
     */
    protected $orderRepository;
    /**
     * @var Transaction
     */
    protected $transaction;
    /**
     * @var InvoiceService
     */
    protected $invoiceService;
    /**
     * @var InvoiceSender
     */
    protected $invoiceSender;
    /**
     * @var Product
     */
    protected $product;
    /**
     * @var FormKey
     */
    protected $formKey;
    /**
     * @var QuoteFactory
     */
    protected $quoteFactory;
    /**
     * @var QuoteManagement
     */
    protected $quoteManagement;
    /**
     * @var OrderService
     */
    protected $orderService;
    /**
     * @var CustomerRepositoryInterface
     */
    protected $customerRepository;
    /**
     * @var CartRepositoryInterface
     */
    protected $cartRepository;
    /**
     * @var CartManagementInterface
     */
    protected $cartManagementInterface;
    /**
     * @var ShipmentNotifier
     */
    protected $shipmentNotifier;
    /**
     * @var OrderConverter
     */
    protected $orderConvert;

    protected $productModelFactory;

    protected $stockRegistry;

    protected $productRepositoryInterface;

    protected $sourceItemInterfaceFactory;

    protected $sourceItemsSave;

    /**
     * Ratings constructor.
     * @param Template\Context $context
     * @param Grouped $grouped
     * @param MostViewed $mostViewed
     * @param Wishlist $wishlist
     * @param OrderCollection $orderCollection
     * @param NewProducts $newProducts
     * @param Visibility $visibility
     * @param Products $productFactory
     * @param BestSeller $bestsellerFactory
     * @param CollectionFactory $collectionFactory
     * @param Customer $customer
     * @param StoreManagerInterface $storeManager
     * @param CategoryCollection $categoryCollection
     * @param ProductRepository $productRepository
     * @param Currency $currency
     * @param Logo $logo
     * @param Collection $groupCollection
     * @param StockCollection $stockCollection
     * @param Order $order
     * @param CustomerFactory $customerFactory
     * @param OrderRepositoryInterface $orderRepository
     * @param InvoiceSender $invoiceSender
     * @param Transaction $transaction
     * @param InvoiceService $invoiceService
     * @param Product $product
     * @param QuoteManagement $quoteManagement
     * @param QuoteFactory $quoteFactory
     * @param FormKey $formKey
     * @param OrderService $orderService
     * @param CustomerRepositoryInterface $customerRepository
     * @param CartRepositoryInterface $cartRepository
     * @param CartManagementInterface $cartManagement
     * @param ShipmentNotifier $shipmentNotifier
     * @param OrderConverter $orderConvert
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        OrderFactory $orderFactory,
        Grouped $grouped,MostViewed $mostViewed ,
        Wishlist $wishlist,
        OrderCollection $orderCollection,
        NewProducts $newProducts,Visibility $visibility,
        Products $productFactory,
        BestSeller $bestsellerFactory,
        CollectionFactory $collectionFactory,
        Customer $customer,
        StoreManagerInterface $storeManager,
        CategoryCollection $categoryCollection,
        ProductRepository $productRepository,
        Currency $currency,
        Logo $logo,
        Collection $groupCollection,
        StockCollection $stockCollection,
        Order $order,
        CustomerFactory $customerFactory,
        OrderRepositoryInterface $orderRepository,
        InvoiceSender $invoiceSender,
        Transaction $transaction,
        InvoiceService $invoiceService,
        Product $product,
        QuoteManagement $quoteManagement,
        QuoteFactory $quoteFactory,
        FormKey $formKey,
        OrderService $orderService,
        CustomerRepositoryInterface $customerRepository,
        CartRepositoryInterface $cartRepository,
        CartManagementInterface $cartManagement,
        ShipmentNotifier $shipmentNotifier,
        OrderConverter $orderConvert,
        ProductFactory $productModelFactory,
        StockRegistryInterface $stockRegistry,
        ProductRepositoryInterface $productRepositoryInterface,
        SourceItemInterfaceFactory $sourceItemInterfaceFactory,
        SourceItemsSaveInterface $sourceItemsSave,
        array $data = [])
    {
        $this->storeManager=$storeManager;
        $this->grouped=$grouped;
        $this->collectionFactory=$collectionFactory;
        $this->newProducts=$newProducts;
        $this->productFactory=$productFactory;
        $this->bestsellerFactory=$bestsellerFactory;
        $this->mostViewed=$mostViewed;
        $this->orderCollection=$orderCollection;
        $this->visibility=$visibility;
        $this->wishlist=$wishlist;
        $this->customer=$customer;
        $this->productRepository=$productRepository;
        $this->categoryCollection=$categoryCollection;
        $this->currency=$currency;
        $this->groupCollection=$groupCollection;
        $this->logo=$logo;
        $this->stockCollection=$stockCollection;
        $this->order=$order;
        $this->customerFactory=$customerFactory;
        $this->orderRepository=$orderRepository;
        $this->invoiceSender=$invoiceSender;
        $this->invoiceService=$invoiceService;
        $this->transaction=$transaction;
        $this->product=$product;
        $this->quoteFactory=$quoteFactory;
        $this->quoteManagement=$quoteManagement;
        $this->formKey=$formKey;
        $this->customerRepository=$customerRepository;
        $this->orderService=$orderService;
        $this->cartRepository=$cartRepository;
        $this->cartManagementInterface=$cartManagement;
        $this->orderConvert=$orderConvert;
        $this->shipmentNotifier=$shipmentNotifier;
        $this->productModelFactory=$productModelFactory;
        $this->stockRegistry=$stockRegistry;
        $this->productRepositoryInterface=$productRepositoryInterface;
        $this->sourceItemInterfaceFactory=$sourceItemInterfaceFactory;
        $this->sourceItemsSave=$sourceItemsSave;
        $this->orderFactory=$orderFactory;
        parent::__construct($context, $data);
    }
    /** calling reviews collection factory and adding filters */
    public function getReviews(){
        $collectionFactory=$this->collectionFactory->create()
            ->addFieldToSelect('*')
            ->addStatusFilter(\Magento\Review\Model\Review::STATUS_APPROVED)
            ->setDateOrder()
            ->addRateVotes();
        return $collectionFactory;
    }

    /**
     * @return \Magento\Sales\Model\ResourceModel\Report\Bestsellers\Collection
     */
    public function getBestsellers(){
        $bestSeller=$this->bestsellerFactory->create()
            ->setModel('Magento\Catalog\Model\Product')
            ->setPeriod('month');
        /*$productId=[];
        foreach ($bestSeller as $items){
            $productId[]=$items->getProductId();
        }
        $productFactory=$this->productFactory->create()->addIdFilter($productId)
            ->addMinimalPrice()
            ->addFinalPrice()
            ->addTaxPercents()
            ->addAttributeToSelect('*');*/
        return $bestSeller;

    }

    /**
     * @return \Magento\Framework\DataObject[]
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getMostViewedProducts(){
        $storeId=$this->_storeManager->getStore()->getId();
        $products=$this->mostViewed->create()
            ->addAttributeToSelect('*')
            ->addViewsCount()
            ->setStoreId($storeId)
            ->addStoreFilter($storeId);
        $name=$products->getItems();

        return $name;
    }

    /**
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getFeaturedProducts(){
        $storeId=$this->_storeManager->getStore()->getId();
        $products=$this->productFactory->create()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('status','1')
            ->addStoreFilter($storeId)
            ->addAttributeToFilter('is_featured','1')
            ->setPageSize(10)
            ->setVisibility($this->visibility->getVisibleInCatalogIds());
        return $products;

    }

    /**
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection|\Magento\Framework\Data\Collection\AbstractDb
     */
    public function getNewProducts(){
        $date=date('y-m-d');
        $newProducts=$this->productFactory->create()
            ->addFieldToSelect('*')
            ->addAttributeToFilter(
                'news_from_date',
                $date
            )
            ;
        return $newProducts;
    }
    /**
     * @return \Magento\Sales\Model\ResourceModel\Order\Collection
     */
    public function getOrders(){
        $orders=$this->orderCollection->create()
            ->addFieldToSelect('*');
        return $orders;
    }
    /**
     * @return string
     */
    public function getStartOfDayDate()
    {
        $date = '2022-10-21 00:06:02';
        return  $date;
    }
    /**
     * @return string
     */
    public function getEndOfDayDate()
    {
        $date = '2022-10-30 00:06:02';
        return  $date;
    }
    /**
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    public function getSaleProducts(){
        $products=$this->productFactory->create()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('special_from_date',['date'=>true,'to'=>$this->getStartOfDayDate()],'left')
            ->addAttributeToFilter('special_to_date',
                ['or'=>[0 =>['date'=>true,'from'=>$this->getEndOfDayDate()],
                1=>['is'=>new \Zend_Db_Expr('null')],]],'left');
        return $products;
    }
    /**
     * @return \Magento\Wishlist\Model\ResourceModel\Item\Collection
     */
    public function getWishlistProducts(){
        $wishlist=$this->wishlist->create();
        return $wishlist;
    }
    /**
     * @return \Magento\Customer\Model\ResourceModel\Customer\Collection
     */
    public function customer(){
        $customer=$this->customer->create();
        return $customer;
    }
    /**
     * @param $id
     * @return array
     */
    public function getGroupedProducts($id){
        return $this->grouped->getParentIdsByChild($id);
    }
    /**
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getUrlSecure(){
        return $this->storeManager->getStore()->isFrontUrlSecure();
    }
    /**
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getCurrentUrlSecure(){
        return $this->storeManager->getStore()->isCurrentlySecure();
    }
    /**
     * @param $id
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getProductCategory($id){
        $product=$this->productRepository->getById($id);
        $productCategoryIds=$product->getCategoryIds();
        return $productCategoryIds;
    }

    /**
     * @param $id
     * @return \Magento\Catalog\Model\ResourceModel\Category\Collection
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getCategoryCollection($id){
        $categoryCollection=$this->categoryCollection->create()
            ->addAttributeToSelect('*')
            ->addIsActiveFilter()
            ->addAttributeToFilter('entity_id',$id);
        return $categoryCollection;
    }

    /**
     * @return \Magento\Store\Api\Data\StoreInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function currentStore(){
        return $this->storeManager->getStore();
    }

    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getBaseCurrencyCode(){
        return $this->currentStore()->getBaseCurrencyCode();
    }

    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getCurrentCurrencyCode(){
        return $this->currentStore()->getCurrentCurrencyCode();
    }

    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getDefaultCurrency(){
        return $this->currentStore()->getDefaulgCurrencyCode();
    }

    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getCurrentCurrencyRate(){
        return $this->currentStore()->getCurrentCurrencyRate();
    }

    /**
     * @return string
     */
    public function getCurrentCurrencySymbol(){
        return $this->currency->getCurrencySymbol();
    }

    /**
     * @return array
     */
    public function getCustomerGroups(){
        return $this->groupCollection->toOptionArray();
    }

    /**
     * @return string
     */
    public function getLogoSrc(){
        return $this->logo->getLogoSrc();
    }

    /**
     * @return string
     */
    public function getLogoAlt(){
        return $this->logo->getLogoAlt();
    }

    /**
     * @return int
     */
    public function getLogoWidth(){
        return $this->logo->getLogoWidth();
    }

    /**
     * @return int
     */
    public function getLogoHeight(){
        return $this->logo->getLogoHeight();
    }

    /**
     * @param $id
     * @return array
     */
    public function getOrderOptions($id){
        return $this->order->load($id)->getAllVisibleItems();
    }

    /**
     * @param $data
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function createCustomer($data){
        $store=$this->storeManager->getStore();
        $storeId=$store->getId();
        $websiteId=$this->storeManager->getStore()->getWebsiteId();
        $customer=$this->customerFactory->create();
        $customer->setWebsiteId($websiteId);
        $customer->loadByEmail($data['customer']['email']);
        if(!$customer->getId()){
            $customer->setWebsiteId($websiteId)
                ->setStore($store)
                ->setFirstname($data['customer']['firstname'])
                ->setLastname($data['customer']['lastname'])
                ->setEmail($data['customer']['email'])
                ->setPassword($data['customer']['password']);
            try {
                $customer->save();
            }catch (\Exception $e){
                echo $e->getMessage();
            }
        }
    }

    /**
     * @param $id
     * @return \Magento\Customer\Model\Customer
     */
    public function getCustomer($id){
        return $this->customerFactory->create()->load($id);
    }

    /**
     * @param $id
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function createInvoice($id){
        $order=$this->orderRepository->get($id);

        if($order->canInvoice()){
            $invoice=$this->invoiceService->prepareInvoice($order);
            $invoice->register();
            $invoice->save();
            $transaction=$this->transaction->addObject($invoice)->addObject($invoice->getOrder());
            $transaction->save();
            $this->invoiceSender->send($invoice);
            $order->addCommentToStatusHistory(__('Notified Customer about the order #%1',$invoice->getId()))->setIsCustomerNotified(true)->save();
        }
    }

    /**
     * @param $orderData
     * @return array
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function createOrder($orderData) {
        $store=$this->storeManager->getStore();
        $websiteId = $this->storeManager->getStore()->getWebsiteId();
        $customer=$this->customerFactory->create();
        $customer->setWebsiteId($websiteId);
        $customer->loadByEmail($orderData['email']);
        if(!$customer->getEntityId()){
            $customer->setWebsiteId($websiteId)
                ->setStore($store)
                ->setFirstname($orderData['shipping_address']['firstname'])
                ->setLastname($orderData['shipping_address']['lastname'])
                ->setEmail($orderData['email'])
                ->setPassword($orderData['email']);
            $customer->save();
        }

        $cartId = $this->cartManagementInterface->createEmptyCart();
        $quote = $this->cartRepository->get($cartId);
        $quote->setStore($store);
        $customer= $this->customerRepository->getById($customer->getEntityId());
        $quote->setCurrency();
        $quote->assignCustomer($customer); //Assign quote to customer
        foreach($orderData['items'] as $item){
            $product=$this->product->load($item['product_id']);
            $product->setPrice($item['price']);
            $quote->addProduct($product, intval($item['qty']));
        }
        $quote->getBillingAddress()->addData($orderData['shipping_address']);
        $quote->getShippingAddress()->addData($orderData['shipping_address']);
        $shippingAddress=$quote->getShippingAddress();
        $shippingAddress = $quote->getShippingAddress();
        try{
        $shippingAddress->setCollectShippingRates(true)
            ->collectShippingRates()
            ->setShippingMethod('flatrate_flatrate');
        $quote->setPaymentMethod('checkmo');
        $quote->setInventoryProcessed(false);
        // Set Sales Order Payment
        $quote->getPayment()->importData(['method' => 'checkmo']);
        $quote->save();
        // Collect Totals
        $quote->collectTotals();
        // Create Order From Quote
        $quote = $this->cartRepository->get($quote->getId());
        $orderId = $this->cartManagementInterface->placeOrder($quote->getId());
        $order = $this->order->load($orderId);
        $order->setEmailSent(0);
        $increment_id = $order->getRealOrderId();
        if($order->getEntityId()){
            $result['order_id']= $order->getRealOrderId();
        }else{
            $result=['error'=>1,'msg'=>'Failed to create'];
        }
        }catch (\Exception $e){
            $result=['error'=>1,'msg'=>'Failed to create'];
        }
        return $result;
    }

    /**
     * @param $id
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function createShipment($id){
        $order=$this->orderRepository->get($id);
        if($order->canShip()) {
            $orderShipment = $this->orderConvert->toShipment($order);

            foreach ($order->getAllItems() as $orderItem){
                if(!$orderItem->getQtyToShip() || $orderItem->getIsVirtual()){
                    continue;
                }
                $qty=$orderItem->getQtyToShip();
                $shipmentItem=$this->orderConvert->itemToShipmentItem($orderItem)->setQty($qty);
                $orderShipment->addItem($shipmentItem);
            }
           $orderShipment->register();
            $orderShipment->getOrder()->setIsInProcess(true);
            try{
                $orderShipment->save();
                $orderShipment->getOrder()->save();
                $this->shipmentNotifier->notify($orderShipment);
                $orderShipment->save();
            }catch (\Exception $e){
                echo $e->getMessage();
            }
        }
    }

    public function getAllOrders(){
        return $this->orderFactory->create()
            ->addAttributeToSelect('*');
    }


}