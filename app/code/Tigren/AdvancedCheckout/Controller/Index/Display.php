<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\AdvancedCheckout\Controller\Index;

use Magento\Catalog\Model\ProductRepository;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ObjectManager;

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
    protected $productCollectionFactory;

    /**
     * @param  Context  $context
     * @param  ProductRepository  $productRepository
     * @param  CollectionFactory  $productCollectionFactory
     */
    public function __construct(
        Context $context,
        ProductRepository $productRepository,
        CollectionFactory $productCollectionFactory
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $listProductInCart = $this->getListProductInCart();

        $collection = $this->productCollectionFactory->create();
        foreach ($collection as $product) {
//            echo '<pre>', print_r($product->getdata()); //For full product details.
//            echo $product->getSku()."<br>"; //print product sku.
            foreach ($listProductInCart as $item) {
                if ($item->getSku() == $product->getSku()) {
                    echo "<pre>";
                    print_r($product->getData());
//                    echo $item->getSku();
                }
            }
        }

    }

    /**
     * @return array
     */
    public function getListProductInCart()
    {
        $objectManager = ObjectManager::getInstance();
        $cart = $objectManager->get('\Magento\Checkout\Model\Cart');

        // retrieve quote items collection
        $itemsCollection = $cart->getQuote()->getItemsCollection();

        // get array of all items what can be display directly
        $itemsVisible = $cart->getQuote()->getAllVisibleItems();

        // retrieve quote items array
        $items = $cart->getQuote()->getAllItems();

        return $items;
    }

    /**
     * @param $sku
     *
     * @return array|mixed
     */
    public function getProductInCartBySku($sku)
    {
        $objectManager = ObjectManager::getInstance();
        $cart = $objectManager->get('\Magento\Checkout\Model\Cart');

        // retrieve quote items collection
        $itemsCollection = $cart->getQuote()->getItemsCollection();

        // get array of all items what can be display directly
        $itemsVisible = $cart->getQuote()->getAllVisibleItems();

        // retrieve quote items array
        $listProductInCart = $cart->getQuote()->getAllItems();
        $productBySku = [];
        foreach ($listProductInCart as $item) {
            if ($item->getSku() == $sku) {
                $productBySku = $item;
            }
        }

        return $productBySku;
    }
}
