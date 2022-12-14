<?php

namespace Helloworld\Mymodule\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Model\QuoteAddressValidator;
use Magento\Quote\Api\Data\AddressInterface;
use Magento\Quote\Api\Data\CartInterface;

class QuoteAddressValidation extends QuoteAddressValidator{

    protected $addressInterface;

    protected $cartInterface;

    public function __construct(\Magento\Customer\Api\AddressRepositoryInterface $addressRepository, \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository, \Magento\Customer\Model\Session $customerSession)
    {
        parent::__construct($addressRepository, $customerRepository, $customerSession);
    }

    private function doValidate(AddressInterface $address, ?int $customerId):void {
        if($customerId){
            $customer= $this->customerRepository->getById($customerId);
            if(!$customer->getId()){
                throw new NoSuchEntityException(__('Invalid Customer'));
            }
           /* try{
                $this->addressRepository->getById($address->getCustomerAddressId());
            }catch (NoSuchEntityException $e){
                throw new NoSuchEntityException(__('Invalid Address'));
            }*/

            $applicableAddressId=array_map(function($address){

                return $address->getId();
            },$this->customerRepository->getById($customerId)->getAddresses());

           /* if(!in_array($address->getCustomerAddressId(),$applicableAddressId)){
                throw new NoSuchEntityException(__('Invalid Customer Address'));
            }*/
        }
    }

    public function validate(AddressInterface $addressData)
    {
        $this->doValidate($addressData,$addressData->getCustomerId());
        return true;
    }

    public function validateForCart(CartInterface $cart, AddressInterface $address): void
    {
       $this->doValidate($address, $cart->getCustomerId() ? $cart->getCustomer()->getId() : null);
    }
}