<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Observer;

use DateTime;
use Magento\Customer\Model\Session;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Tigren\CustomerGroupCatalog\Model\ResourceModel\Rule\Collection;
use Tigren\CustomerGroupCatalog\Model\ResourceModel\Rule\CollectionFactory;
use Zend_Log;
use Zend_Log_Exception;
use Zend_Log_Writer_Stream;

/**
 * Class CustomPrice
 *
 * @package Tigren\CustomerGroupCatalog\Observer
 */
class CustomPrice implements ObserverInterface
{
    /**
     * @var CollectionFactory
     */
    private $ruleCollectionFactory;

    /**
     * @var Session
     */
    private $session;

    /**
     * @param CollectionFactory $ruleCollectionFactory
     * @param Session $session
     */
    public function __construct(
        CollectionFactory $ruleCollectionFactory,
        Session           $session,
    ) {
        $this->ruleCollectionFactory = $ruleCollectionFactory;
        $this->session = $session;
    }

    /**
     * @param Observer $observer
     *
     * @return void
     * @throws LocalizedException
     * @throws NoSuchEntityException
     * @throws Zend_Log_Exception
     */
    public function execute(Observer $observer)
    {
        $writer = new Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
        $logger = new Zend_Log();
        $logger->addWriter($writer);
//        $logger->info(print_r('hihi', true));

        $customerGroupId = $this->session->getCustomerGroupId();

        $item = $observer->getEvent()->getData('quote_item');

        $product = $observer->getEvent()->getData('product');
        $rule = $this->getListRules($product->getSku(), $customerGroupId)
            ->getFirstItem();
//        $logger->info(print_r($rule->getData(), true));
        $discount = $rule->getData('discount_amount');
//        $logger->info(print_r($rule->getData(), true));
        //(optional) get the parent item, if exists
        $item = ($item->getParentItem() ? $item->getParentItem() : $item);
        //set your price here
        $discountPrice = (100 - $discount) * $product->getPrice() / 100;
//        $logger->info(print_r($discountPrice, true));

        $item->setCustomPrice($discountPrice);
        $item->setOriginalCustomPrice($discountPrice);
        $item->getProduct()->setIsSuperMode(true);
    }

    /**
     * @param $sku
     * @param $customerGroupId
     * @return Collection
     */
    public function getListRules($sku, $customerGroupId)
    {
        $nowTime = new DateTime();
        $ruleCollection
            = $this->ruleCollectionFactory->create();
        $ruleCollection->addFieldToFilter('products', ['like' => '%' . $sku . '%'])
            ->addFieldToFilter(
                'customer_group_ids',
                ['like' => '%' . $customerGroupId . '%']
            )
            ->addFieldToFilter(
                'from_date',
                ['lteq' => $nowTime->format('Y-m-d H:i:s')]
            )
            ->addFieldToFilter(
                'to_date',
                ['gteq' => $nowTime->format('Y-m-d H:i:s')]
            );
        $ruleCollection->setPageSize(1);

        return $ruleCollection;
    }
}
