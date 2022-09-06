<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Observer;

use Magento\Checkout\Model\Cart;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\View\Result\PageFactory;
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
    private $cart;
    private $pageFactory;
    private $ruleFactory;

    public function __construct(
        Context $context,
        Cart $cart,
        PageFactory $pageFactory,
        CollectionFactory $ruleFactory
    ) {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
        $this->ruleFactory = $ruleFactory;
        $this->cart = $cart;
    }

    /**
     * @param  Observer  $observer
     *
     * @return void
     * @throws Zend_Log_Exception
     */
    public function execute(Observer $observer)
    {

        $listProductInCart = $this->getProductInCart();
        foreach ($listProductInCart as $item) {
            $listRules = $this->getListRules();
            foreach ($listRules as $rule) {
                if ($item->getSku() == $rule['products']) {

                    //get the item just added to cart
                    $item = $observer->getEvent()->getData('quote_item');
                    $product = $observer->getEvent()->getData('product');
                    //(optional) get the parent item, if exists
                    $item = ($item->getParentItem() ? $item->getParentItem()
                        : $item);
                    // set your custom price
                    $price = 100;
                    $item->setCustomPrice($price);
                    $item->setOriginalCustomPrice($price);
                    $item->getProduct()->setIsSuperMode(true);
                }
            }
        }
    }

    public function getListRules()
    {
        $this->ruleFactory->create();
        $listRules = $this->ruleFactory->create()->getData();
    }

    public function getProductInCart()
    {

        // get quote items collection
        $itemsCollection = $this->cart->getQuote()->getItemsCollection();

        // get array of all items what can be display directly
        $itemsVisible = $this->cart->getQuote()->getAllVisibleItems();

        // get quote items array - get product in the Cart
        $items = $this->cart->getQuote()->getAllItems();

        return $items;
    }
}
