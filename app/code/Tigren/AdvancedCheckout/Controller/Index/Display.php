<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\AdvancedCheckout\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Sales\Model\ResourceModel\Order\Address\CollectionFactory;

/**
 * Class Display
 *
 * @package Tigren\AdvancedCheckout\Controller\Index
 */
class Display extends Action
{
    /**
     * @var CollectionFactory
     */
    protected $addressFactory;
    /**
     * @var OrderRepositoryInterface
     */
    protected $orderRepository;

    /**
     * @param Context $context
     * @param OrderRepositoryInterface $orderRepository
     * @param CollectionFactory $addressFactory
     */
    public function __construct(
        Context                  $context,
        OrderRepositoryInterface $orderRepository,
        CollectionFactory        $addressFactory
    ) {
        $this->orderRepository = $orderRepository;
        $this->addressFactory = $addressFactory;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface|void
     */
    public function execute()
    {
        $collection = $this->addressFactory->create()->addFieldToFilter(
            'address_type',
            ['like' => '%' . 'shipping' . '%']
        );
        echo "<pre>";
        print_r($collection->getData());
//        $order = $this->orderRepository->get(0);
//        echo $order->getId();
//        print_r($order);
        // TODO: Implement execute() method.
    }
}
