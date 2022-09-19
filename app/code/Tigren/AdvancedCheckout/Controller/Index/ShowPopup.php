<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\AdvancedCheckout\Controller\Index;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ProductRepository;
use Magento\Checkout\Model\Cart;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class ShowPopup
 *
 * @package Tigren\AdvancedCheckout\Controller\Index
 */
class ShowPopup extends Action
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var Cart
     */
    protected $cart;

    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @param  Context  $context
     * @param  ProductRepository  $productRepository
     * @param  Cart  $cart
     * @param  JsonFactory  $resultJsonFactory
     */
    public function __construct(
        Context $context,
        ProductRepository $productRepository,
        Cart $cart,
        JsonFactory $resultJsonFactory
    ) {
        $this->productRepository = $productRepository;
        $this->cart = $cart;
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }

    /**
     * @return Json
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $response = ['isShowPopup' => false];

        $sku = $this->getRequest()->getParam('sku');
        $product = $this->getProductBySku($sku);
        $allow = $product->getCustomAttribute('allow_multi_order')
            ? $product->getCustomAttribute('allow_multi_order')->getValue()
            : 0;
        $isExistedInCart = $this->productExistedInCart($sku);

        if ($isExistedInCart && $allow == 0) {
            $response = [
                'isShowPopup' => true,
            ];
        }
        $resultJson = $this->resultJsonFactory->create();

        return $resultJson->setData($response);

    }

    /**
     * @param $sku
     *
     * @return ProductInterface|Product
     * @throws NoSuchEntityException
     */
    public function getProductBySku($sku)
    {
        return $this->productRepository->get($sku);
    }

    /**
     * @param $sku
     *
     * @return bool
     */
    public function productExistedInCart($sku)
    {
        $isExist = false;
        $itemsVisible = $this->cart->getQuote()->getAllVisibleItems();
        foreach ($itemsVisible as $item) {
            if ($sku == $item->getSku()) {
                $isExist = true;
            }
        }

        return $isExist;
    }
}
