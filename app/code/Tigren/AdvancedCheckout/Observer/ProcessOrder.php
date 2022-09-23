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
     * @param CustomerFactory $customerFactory
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
     */
    public function execute(Observer $observer)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->get('Magento\Customer\Model\Session');
        if (!($customerSession->isLoggedIn())) {
            $order = $observer->getEvent()->getData('order');
            $shippingAddress = $order->getShippingAddress();
            $email = $shippingAddress->getEmail();
            $firstName = $shippingAddress->getFirstName();
            $lastName = $shippingAddress->getLastName();

            $customer = $this->customerFactory->create();

            $customer->setEmail($email);
            $customer->setFirstname($firstName);
            $customer->setLastname($lastName);
            $customer->setPassword("password");
            $customer->save();
        }
        return $this;
    }
}
