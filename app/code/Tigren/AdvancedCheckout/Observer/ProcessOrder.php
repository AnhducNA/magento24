<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\AdvancedCheckout\Observer;

use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Model\Order;
use Zend_Log;
use Zend_Log_Exception;
use Zend_Log_Writer_Stream;

/**
 * Class ProcessOrder
 * @package Tigren\AdvancedCheckout\Observer
 */
class ProcessOrder implements ObserverInterface
{
    /**
     * @var Order
     */
    protected $_order;

    /**
     * @var CustomerFactory
     */
    protected $customerFactory;

    /**
     * @param Order $order
     */
    public function __construct(
        Order           $order,
        CustomerFactory $customerFactory
    ) {
        $this->_order = $order;
        $this->customerFactory = $customerFactory;
    }

    /**
     * @param Observer $observer
     * @return $this
     * @throws Zend_Log_Exception
     */
    public function execute(Observer $observer)
    {
        $writer = new Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
        $logger = new Zend_Log();
        $logger->addWriter($writer);
//        $logger->info(print_r('hihi', true));

        $order = $observer->getEvent()->getData('order');
        $quote = $observer->getEvent()->getQuote();
        $shippingAddress = $order->getShippingAddress();
        $email = $shippingAddress->getEmail();
        $firstName = $shippingAddress->getFirstName();
        $lastName = $shippingAddress->getLastName();

        $customer = $this->customerFactory->create();

        // Preparing data for new customer
        $customer->setEmail($email);
        $customer->setFirstname($firstName);
        $customer->setLastname($lastName);
        $customer->setPassword("password");

        // Save data
        $customer->save();

        $logger->info(print_r($email, true));
        $logger->info(print_r($order->getId(), true));

        return $this;
    }
}
