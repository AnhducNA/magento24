<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\AdvancedCheckout\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Model\Order;
use Zend_Log;
use Zend_Log_Writer_Stream;

/**
 * Class CustomPrice
 *
 * @package Tigren\CustomerGroupCatalog\Observer
 */
class ProcessOrder implements ObserverInterface
{
    protected $_order;

    public function __construct(
        Order $order
    ) {
        $this->_order = $order;
    }

    public function execute(Observer $observer)
    {
        $writer = new Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
        $logger = new Zend_Log();
        $logger->addWriter($writer);
        $logger->info(print_r('hihi', true));

        $order = $observer->getOrder();
        $quote = $observer->getQuote();

        $logger->info(print_r($order->getId(), true));

        $billingAddress = $this->_order->getBillingAddress();
        $shippingAddress = $this->_order->getShippingAddress();
//        $logger->info(print_r($billingAddress, true));

        return $this;
    }
}
