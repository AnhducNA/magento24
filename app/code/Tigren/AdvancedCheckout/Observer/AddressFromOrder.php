<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\AdvancedCheckout\Observer;

use Magento\Framework\Exception\LocalizedException;
use Magento\Sales\Model\ResourceModel\Order\Address\CollectionFactory;

class AddressFromOrder extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context                   $context,
        \Magento\Sales\Api\OrderRepositoryInterface                        $orderRepository,
        CollectionFactory $addressCollection,
        array                                                              $data = []
    ) {
        $this->orderRepository = $orderRepository;
        $this->addressCollection = $addressCollection;
        parent::__construct($context, $data);
    }

    /**
     * @param int $id The order ID.
     */
    public function getOrderData($id)
    {
        try {
            $order = $this->orderRepository->get($id);
        } catch (NoSuchEntityException $e) {
            throw new LocalizedException(__('This order no longer exists.'));
        }
    }

    /* get Shipping address data of specific order */
    public function getShippingAddress($orderId)
    {
        $order = $this->getOrderData($orderId);
        /* check order is not virtual */
        if (!$order->getIsVirtual()) {
            $orderShippingId = $order->getShippingAddressId();
            $address = $this->addressCollection->create()->addFieldToFilter('entity_id', [$orderShippingId])->getFirstItem();
            return $address;
        }
        return null;
    }

    /* get Billing address data of specific order */
    public function getBillingAddress($orderId)
    {
        $order = $this->getOrderData($orderId);
        $orderBillingId = $order->getBillingAddressId();
        $address = $this->addressCollection->create()->addFieldToFilter('entity_id', [$orderBillingId])->getFirstItem();
        return $address;
    }
}
